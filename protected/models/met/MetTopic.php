<?php

/**
 * This is the model class for table "met_topic".
 *
 * The followings are the available columns in table 'met_topic':
 * @property integer $id
 * @property integer $catrory_id
 * @property string $title
 * @property string $subtitle
 * @property integer $posterid
 * @property string $author
 * @property string $from
 * @property integer $topictype
 * @property integer $parentid
 * @property integer $creattime
 * @property integer $updatetime
 * @property integer $status
 * @property integer $reviewstatus
 * @property double $reviewscore
 * @property integer $reviewtime
 * @property string $content
 */
class MetTopic extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MetTopic the static model class
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
		return 'met_topic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('catrory_id, title, posterid, author, from, reviewtime, content', 'required'),
			array('catrory_id, posterid, topictype, parentid, creattime, updatetime, status, reviewstatus, reviewtime', 'numerical', 'integerOnly'=>true),
			array('reviewscore', 'numerical'),
			array('title, subtitle, author, from', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, catrory_id, title, subtitle, posterid, author, from, topictype, parentid, creattime, updatetime, status, reviewstatus, reviewscore, reviewtime, content', 'safe', 'on'=>'search'),
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
            'authors'=>array(self::MANY_MANY,'MetAuthor',MetTopicAuthors::model()->tableName().'(topicid,authorid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'catrory_id' => 'Catrory',
			'title' => 'Title',
			'subtitle' => 'Subtitle',
			'posterid' => 'Posterid',
			'author' => 'Author',
			'from' => 'From',
			'topictype' => 'Topictype',
			'parentid' => 'Parentid',
			'creattime' => 'Creattime',
			'updatetime' => 'Updatetime',
			'status' => 'Status',
			'reviewstatus' => 'Reviewstatus',
			'reviewscore' => 'Reviewscore',
			'reviewtime' => 'Reviewtime',
			'content' => 'Content',
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
		$criteria->compare('catrory_id',$this->catrory_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('subtitle',$this->subtitle,true);
		$criteria->compare('posterid',$this->posterid);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('topictype',$this->topictype);
		$criteria->compare('parentid',$this->parentid);
		$criteria->compare('creattime',$this->creattime);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('status',$this->status);
		$criteria->compare('reviewstatus',$this->reviewstatus);
		$criteria->compare('reviewscore',$this->reviewscore);
		$criteria->compare('reviewtime',$this->reviewtime);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}