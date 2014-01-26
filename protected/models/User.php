<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
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
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, nickname, pwd, email, regtime, regtype, lastlogintime, regip, lastloginip', 'required'),
			array('gender, regtime, regtype, lastlogintime, status', 'numerical', 'integerOnly'=>true),
			array('username, nickname, pwd, regip, lastloginip', 'length', 'max'=>50),
			array('title', 'length', 'max'=>100),
			array('email', 'length', 'max'=>150),
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
			'id' => 'ID',
			'username' => 'Username',
			'nickname' => 'Nickname',
			'title' => 'Title',
			'pwd' => 'Pwd',
			'email' => 'Email',
			'gender' => 'Gender',
			'regtime' => 'Regtime',
			'regtype' => 'Regtype',
			'lastlogintime' => 'Lastlogintime',
			'regip' => 'Regip',
			'lastloginip' => 'Lastloginip',
			'status' => 'Status',
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
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
