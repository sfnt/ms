<?php

/**
 * This is the model class for table "met_invite_log".
 *
 * The followings are the available columns in table 'met_invite_log':
 * @property integer $id
 * @property string $email
 * @property string $nickname
 * @property string $title
 * @property integer $topicid
 * @property integer $inviterid
 * @property string $code
 * @property integer $logtype
 * @property integer $status
 * @property integer $invitetime
 * @property integer $isclicked
 * @property integer $clicktime
 * @property integer $registered
 * @property integer $regtime
 */
class MetInviteLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MetInviteLog the static model class
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
		return 'met_invite_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, nickname, inviterid, code, clicktime', 'required'),
			array('topicid, inviterid, logtype, status, invitetime, isclicked, clicktime, registered, regtime', 'numerical', 'integerOnly'=>true),
			array('email', 'length', 'max'=>150),
			array('nickname, code', 'length', 'max'=>50),
			array('title', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, nickname, title, topicid, inviterid, code, logtype, status, invitetime, isclicked, clicktime, registered, regtime', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'nickname' => 'Nickname',
			'title' => 'Title',
			'topicid' => 'Topicid',
			'inviterid' => 'Inviterid',
			'code' => 'Code',
			'logtype' => 'Logtype',
			'status' => 'Status',
			'invitetime' => 'Invitetime',
			'isclicked' => 'Isclicked',
			'clicktime' => 'Clicktime',
			'registered' => 'Registered',
			'regtime' => 'Regtime',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('topicid',$this->topicid);
		$criteria->compare('inviterid',$this->inviterid);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('logtype',$this->logtype);
		$criteria->compare('status',$this->status);
		$criteria->compare('invitetime',$this->invitetime);
		$criteria->compare('isclicked',$this->isclicked);
		$criteria->compare('clicktime',$this->clicktime);
		$criteria->compare('registered',$this->registered);
		$criteria->compare('regtime',$this->regtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}