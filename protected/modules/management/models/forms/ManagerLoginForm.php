<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class ManagerLoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>Yii::t('system','username'),
			'password'=>Yii::t('system','password'),
			'rememberMe'=>Yii::t('system','remember me'),
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new ManagerIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate()) {
				if($this->_identity->errorCode === ManagerIdentity::ERROR_USERNAME_ISBLOCK)
					$this->addError('username',Yii::t('system','sorry, your account is blocked for two hours, please try again later.'));
				elseif ($this->_identity->errorCode === ManagerIdentity::ERROR_PASSWORD_INVALID) {
					$usertype = EnumHelper::UserType();
					$block = new Blocklist;
					$block->username = $this->username;
					$block->usertype = $usertype['BACKEND'];
					$block->logintime = time();
					$block->save();
					$this->addError('password',Yii::t('system','invalid username or password.'));
				} elseif ($this->_identity->errorCode === ManagerIdentity::ERROR_USERNAME_INVALID) {
					$this->addError('username',Yii::t('system','invalid username.'));
				}
			}
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new ManagerIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===ManagerIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->manager->login($this->_identity,$duration);
			//Teacher::model()->updateByPk($this->_identity->id, array('lastlogintime'=>strtotime("now"),'lastloginip'=>Yii::app()->request->userHostAddress)); 
			return true;
		} else {
			return false;
		}
	}
}
