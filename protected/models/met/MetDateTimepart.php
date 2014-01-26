<?php

/**
 * This is the model class for table "met_date_timepart".
 *
 * The followings are the available columns in table 'met_date_timepart':
 * @property integer $id
 * @property integer $dayid
 * @property string $partname
 * @property integer $starttime
 * @property integer $endtime
 * @property integer $creatorid
 * @property integer $creattime
 */
class MetDateTimepart extends CActiveRecord
{
    public $start;
    public $end;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'met_date_timepart';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dayid, roomid, partname, starttime, endtime, creatorid, start, end', 'required'),
            array('start, end', 'checktime'),
			array('dayid, starttime, endtime, creatorid, creattime', 'numerical', 'integerOnly'=>true),
			array('partname', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dayid, partname, starttime, endtime, creatorid, creattime', 'safe', 'on'=>'search'),
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
            'day' => array(self::BELONGS_TO, 'MetDateDay', 'dayid'),
            'room' => array(self::BELONGS_TO, 'MetRoom', 'dayid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('system','ID'),
			'dayid' => Yii::t('meeting','Date'),
            'roomid' => Yii::t('meeting','Room'),
			'partname' => Yii::t('meeting','Time Period'),
			'starttime' => Yii::t('meeting','Start Time'),
			'endtime' => Yii::t('meeting','End Time'),
			'creatorid' => Yii::t('system','create operator'),
			'creattime' => Yii::t('system','create time'),
            'start' => Yii::t('meeting','Start Time'),
			'end' => Yii::t('meeting','End Time'),
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
		$criteria->compare('dayid',$this->dayid);
        $criteria->compare('roomid',$this->roomid);
		$criteria->compare('partname',$this->partname,true);
		$criteria->compare('starttime',$this->starttime);
		$criteria->compare('endtime',$this->endtime);
		$criteria->compare('creatorid',$this->creatorid);
		$criteria->compare('creattime',$this->creattime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetDateTimepart the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function checktime($attribute,$params){
        $time = 0;
        try{
            $time = strtotime($this->$attribute);
        }
        catch(Exception $e){
            $this->addError($attribute, Yii::t('system','Date or Time format is not correct.'));
            return;
        }
        if(!$time && $time<=0){
            $this->addError($attribute, Yii::t('system','Date or Time format is not correct.'));
        }
    }
}
