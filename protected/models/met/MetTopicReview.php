<?php

/**
 * This is the model class for table "met_topic_review".
 *
 * The followings are the available columns in table 'met_topic_review':
 * @property integer $id
 * @property string $title
 * @property integer $posterid
 * @property integer $topicid
 * @property integer $rate
 * @property string $content
 * @property integer $creattime
 */
class MetTopicReview extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MetTopicReview the static model class
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
		return 'met_topic_review';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('posterid, topicid, creattime', 'required'),
			array('posterid, topicid, rate, creattime', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, posterid, topicid, rate, content, creattime', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'posterid' => 'Posterid',
			'topicid' => 'Topicid',
			'rate' => 'Rate',
			'content' => 'Content',
			'creattime' => 'Creattime',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('posterid',$this->posterid);
		$criteria->compare('topicid',$this->topicid);
		$criteria->compare('rate',$this->rate);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('creattime',$this->creattime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}