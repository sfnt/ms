<?php

/**
 * This is the model class for table "met_date_day".
 *
 * The followings are the available columns in table 'met_date_day':
 * @property integer $id
 * @property string $date_day
 * @property integer $meetingid
 * @property integer $creatorid
 * @property integer $createtime
 */
class MetDateDay extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'met_date_day';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date_day, meetingid, creatorid', 'required'),
			array('meetingid, creatorid, createtime', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, date_day, meetingid, creatorid, createtime', 'safe', 'on'=>'search'),
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
            'creator' => array(self::BELONGS_TO, 'Manager', 'creatorid'),
            'plan' => array(self::BELONGS_TO, 'MetMeetingPlan', 'meetingid'),
            'timeParts' => array(self::HAS_MANY, 'MetDateTimepart', 'dayid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('system','ID'),
			'date_day' => Yii::t('meeting','Date'),
			'meetingid' => Yii::t('meeting','Meeting Plan'),
			'creatorid' => Yii::t('system','create operator'),
			'createtime' => Yii::t('system','create time'),
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
		$criteria->compare('date_day',$this->date_day,true);
		$criteria->compare('meetingid',$this->meetingid);
		$criteria->compare('creatorid',$this->creatorid);
		$criteria->compare('createtime',$this->createtime);
        $criteria->order = 'date_day ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetDateDay the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
