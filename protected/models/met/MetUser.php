<?php

/**
 * This is the model class for table "met_user".
 *
 * The followings are the available columns in table 'met_user':
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $title
 * @property string $pwd
 * @property string $email
 * @property integer $gender
 * @property integer $regtime
 * @property integer $regtype
 * @property integer $lastlogintime
 * @property string $regip
 * @property string $lastloginip
 * @property integer $status
 */
class MetUser extends CActiveRecord
{
    public $repeatPassword;
	public $newPassword = null;
	public $oldPassword = null;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'met_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, nickname, email, regtype', 'required'),
			array('gender, regtime, regtype, lastlogintime, status', 'numerical', 'integerOnly'=>true),
			array('username, nickname, pwd, regip, lastloginip', 'length', 'max'=>50),
			array('title', 'length', 'max'=>100),
			array('email', 'length', 'max'=>150),
            array('username', 'length', 'max'=>20),
            array('username', 'length', 'min'=>4),
            array('email', 'email'),
            array('email','checkemail', 'on'=>'create'),
            array('username','checkname', 'on'=>'create'),
            array('newPassword, repeatPassword', 'required','on'=>'create'),
			array('oldPassword, newPassword, repeatPassword', 'required','on'=>'changepassword'),
            array('oldPassword','checkoldpass', 'on'=>'changepassword'),
            array('repeatPassword', 'compare', 'compareAttribute'=>'newPassword', 'message'=>Yii::t('system','Password and repeat password is not consistent.')),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, nickname, title, pwd, email, gender, regtime, regtype, lastlogintime, regip, lastloginip, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('system','ID'),
			'username' => Yii::t('system','username'),
			'nickname' => Yii::t('system','name'),
			'title' => Yii::t('users','Title'),
			'pwd' => Yii::t('system','password'),
			'email' => Yii::t('system','email'),
			'gender' => Yii::t('users','Gender'),
			'regtime' => Yii::t('users','Registration Time'),
			'regtype' => Yii::t('users','Registration Type'),
			'lastlogintime' => Yii::t('system','last login time'),
			'regip' => Yii::t('users','Registration IP'),
			'lastloginip' => Yii::t('users','Last Login IP'),
			'status' => Yii::t('system','Status'),
            'newPassword' => Yii::t('system','new password'),
            'repeatPassword' => Yii::t('system','repeat password'),
            'oldPassword' => Yii::t('system','old password'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pwd',$this->pwd,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('gender',$this->gender);
		$criteria->compare('regtime',$this->regtime);
		$criteria->compare('regtype',$this->regtype);
		$criteria->compare('lastlogintime',$this->lastlogintime);
		$criteria->compare('regip',$this->regip,true);
		$criteria->compare('lastloginip',$this->lastloginip,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function checkname($attribute,$params)  
    {  
        if(!preg_match('/^[a-zA-Z\d_]{4,20}$/i', $this->username)){
            $this->addError($attribute, Yii::t('system','User names can only consist of letters, 0-9, and "_".'));
            return;
        }
        if(self::model()->exists('username=:username',array(':username'=>$this->username))){
            $this->addError($attribute, Yii::t('system','User name already exists.'));
            return;
        }
        /*
        //ucenter  
        Yii::import('application.vendors.*');  
        include_once 'ucenter.php';

        $flag = uc_user_checkname($this->$attribute);  
          
        switch($flag)  
        {  
            case -1:  
                $this->addError($attribute, '用户名不合法');  
                break;  
            case -2:  
                $this->addError($attribute,'包含不允许注册的词语');  
                break;  
            case -3:  
				if($data = uc_get_user($this->$attribute)) {
					list($uid, $username, $email) = $data;
					if ($uid != $this->id) {
						$this->addError($attribute,'用户名已经存在');
					}
				}
                break;
        }
        */
    }

    public function checkemail($attribute,$params)  
    {  
        if(self::model()->exists('email=:email',array(':email'=>$this->email))){
            $this->addError($attribute, Yii::t('system','Email already exists.'));
            return;
        }
        /*
        //ucenter  
        Yii::import('application.vendors.*');  
        include_once 'ucenter.php';

        $flag = uc_user_checkemail($this->$attribute);  
          
        switch($flag)  
        {  
            case -4:  
                $this->addError($attribute, 'Email 格式有误');  
                break;  
            case -5:  
                $this->addError($attribute,'Email 不允许注册');  
                break;  
            case -6:  
				if($data = uc_get_user($this->id)) {
					list($uid, $username, $email) = $data;
					if ($email != $this->$attribute) {
						$this->addError($attribute,'Email 已经存在');
					}
				}
                break;
        }
        */
    }
    public function checkoldpass($attribute,$params){
        if(UtilHelper::encryptPwd($this->oldPassword, $this->username)!=$this->pwd){
            $this->addError($attribute, Yii::t('system','Old password is not currect.'));
        }
    }
    protected function beforeSave() {
		if (!empty($this->newPassword))
			$this->pwd = UtilHelper::encryptPwd($this->newPassword, $this->username);
		if($this->isNewRecord) {
			if (empty($this->lastlogintime)) $this->lastlogintime = 0;
			if (empty($this->lastloginip)) $this->lastloginip = '';
            if (empty($this->regtime)) $this->regtime = time();
            if (empty($this->regip)) $this->regip = UtilHelper::getOnlineIP();
		}
		return true;
	}
}
