<?php

/**
 * This is the model class for table "sa_teacher".
 *
 * The followings are the available columns in table 'sa_teacher':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $realname
 * @property string $email
 * @property string $phone
 * @property string $mobilephone
 * @property string $isadmin
 * @property integer $createtime
 * @property integer $createoperator
 * @property string $createip
 * @property integer $updatetime
 * @property integer $updateoperator
 * @property string $updateip
 * @property integer $lastlogintime
 * @property string $lastloginip
 * @property string $salt
 * @property string $status
 */
class Manager extends CActiveRecord
{
	public $isadminEnum = array(
			1,//yes
			0,//no
		); 
	public $statusEnum = array(
			1,//active
			0,//deactive
		); 
	public $repeatPassword;
	public $newPassword = null;
	public $oldPassword = null;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Teacher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{manager}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, realname, email, createtime, salt, role_id', 'required'),
			array('username','unique', 'message'=>Yii::t('system','User name already exists.')),
			array('newPassword, repeatPassword', 'required','on'=>'create'),
			array('oldPassword, newPassword, repeatPassword', 'required','on'=>'changepassword'),
			array('role_id, createtime, createoperator, updatetime, updateoperator, lastlogintime', 'numerical', 'integerOnly'=>true),
            array('oldPassword','length','min'=>6,'max'=>12,'allowEmpty'=>false,'on'=>'changepassword'),
            array('oldPassword','authenticate','on'=>'changepassword'),
            array('newPassword','length','min'=>6,'max'=>12,'allowEmpty'=>false,'on'=>'create,changepassword'),
            array('newPassword','length','min'=>6,'max'=>12,'allowEmpty'=>true,'on'=>'update'),
			array('repeatPassword', 'compare', 'compareAttribute'=>'newPassword', 'message'=>Yii::t('system','Password and repeat password is not consistent.')),
			array('repeatPassword', 'safe'),
			array('username', 'length', 'max'=>20),
			array('password, realname, email, phone, mobilephone', 'length', 'max'=>50),
			array('createip, updateip, lastloginip', 'length', 'max'=>16),
			array('salt', 'length', 'max'=>4),
            array('email', 'email'),
			array('status', 'length', 'max'=>6),
			array('status', 'in', 'range'=>$this->statusEnum), // enum
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, realname, email, phone, mobilephone, role_id, createtime, createoperator, createip, updatetime, updateoperator, updateip, lastlogintime, lastloginip, salt, status', 'safe', 'on'=>'search'),
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
            'role' => array(self::BELONGS_TO, 'AdminRole', 'role_id'),
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
			'password' => Yii::t('system','password'),
			'oldPassword' => Yii::t('system','old password'),
			'newPassword' => Yii::t('system','new password'),
			'repeatPassword' => Yii::t('system','repeat password'),
			'realname' => Yii::t('system','name'),
			'email' => Yii::t('system','email'),
			'phone' => Yii::t('system','phone'),
			'mobilephone' => Yii::t('system','mobile phone'),
			'role_id' => Yii::t('system','role'),
			'createtime' => Yii::t('system','create time'),
			'createoperator' => Yii::t('system','create operator'),
			'createip' => Yii::t('system','create ip'),
			'updatetime' => Yii::t('system','update time'),
			'updateoperator' => Yii::t('system','update operator'),
			'updateip' => Yii::t('system','update ip'),
			'lastlogintime' => Yii::t('system','last login time'),
			'lastloginip' => Yii::t('system','last login ip'),
			'salt' => Yii::t('system','salt'),
			'status' => Yii::t('system','status'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('mobilephone',$this->mobilephone,true);
		$criteria->compare('role_id',$this->role_id);
		$criteria->compare('createtime',$this->createtime);
		$criteria->compare('createoperator',$this->createoperator);
		$criteria->compare('createip',$this->createip,true);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('updateoperator',$this->updateoperator);
		$criteria->compare('updateip',$this->updateip,true);
		$criteria->compare('lastlogintime',$this->lastlogintime);
		$criteria->compare('lastloginip',$this->lastloginip,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	  * perform one-way encryption on the password before we store it in the database
	  */
	protected function beforeSave() {
		if (!empty($this->newPassword))
			$this->password = UtilHelper::encryptPwd($this->newPassword, $this->salt);
		return true;
	}
	/**
	  * 原密码校验
	  */
    public function authenticate($attribute,$params)  
    {  
		if ($this->password != UtilHelper::encryptPwd($this->oldPassword, $this->salt))
            $this->addError('oldPassword', Yii::t('system','Invalid old password.'));  
    }
}