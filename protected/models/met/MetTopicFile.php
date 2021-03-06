<?php

/**
 * This is the model class for table "met_topic_file".
 *
 * The followings are the available columns in table 'met_topic_file':
 * @property integer $id
 * @property integer $topicid
 * @property integer $uploaderid
 * @property string $filename
 * @property string $filepath
 * @property string $filetype
 * @property integer $filesize
 * @property integer $status
 * @property integer $creattime
 * @property integer $lasttime
 */
class MetTopicFile extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MetTopicFile the static model class
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
		return 'met_topic_file';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topicid, uploaderid, filename, filepath', 'required'),
			array('topicid, uploaderid, filesize, status, creattime, lasttime', 'numerical', 'integerOnly'=>true),
			array('filename, filepath', 'length', 'max'=>250),
			array('filetype', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, topicid, uploaderid, filename, filepath, filetype, filesize, status, creattime, lasttime', 'safe', 'on'=>'search'),
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
			'topicid' => 'Topicid',
			'uploaderid' => 'Uploaderid',
			'filename' => 'Filename',
			'filepath' => 'Filepath',
			'filetype' => 'Filetype',
			'filesize' => 'Filesize',
			'status' => 'Status',
			'creattime' => 'Creattime',
			'lasttime' => 'Lasttime',
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
		$criteria->compare('topicid',$this->topicid);
		$criteria->compare('uploaderid',$this->uploaderid);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('filepath',$this->filepath,true);
		$criteria->compare('filetype',$this->filetype,true);
		$criteria->compare('filesize',$this->filesize);
		$criteria->compare('status',$this->status);
		$criteria->compare('creattime',$this->creattime);
		$criteria->compare('lasttime',$this->lasttime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}