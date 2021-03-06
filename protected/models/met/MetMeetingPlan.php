<?php

/**
 * This is the model class for table "met_meeting_plan".
 *
 * The followings are the available columns in table 'met_meeting_plan':
 * @property integer $id
 * @property string $name
 * @property integer $creatorid
 * @property integer $createtime
 * @property integer $updatetime
 * @property integer $status
 */
class MetMeetingPlan extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'met_meeting_plan';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, creatorid', 'required'),
			array('creatorid, createtime, updatetime, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, creatorid, createtime, updatetime, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('system','ID'),
			'name' => Yii::t('meeting','Plan Name'),
			'creatorid' => Yii::t('system','create operator'),
			'createtime' => Yii::t('system','create time'),
			'updatetime' => Yii::t('system','update time'),
			'status' => Yii::t('system','Status'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('creatorid',$this->creatorid);
		$criteria->compare('createtime',$this->createtime);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MetMeetingPlan the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public static $dataList = null;
	public static function getDataList($id = null) {
		if(self::$dataList == null) {
			$criteria = new CDbCriteria();
			$criteria->select = 'id,name';
			$criteria->compare('status', 1);
            $criteria->order = "id DESC";
			self::$dataList = CHtml::listData(self::model()->findAll($criteria), 'id', 'name');
		}
		if($id==null) {
			return self::$dataList;
		} else {
			if(isset(self::$dataList[$id]))
				return self::$dataList[$id];
			else
				return FALSE;
		}
	}
}
