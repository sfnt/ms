<?php

/**
 * This is the model class for table "sa_blocklist".
 *
 * The followings are the available columns in table 'sa_blocklist':
 * @property string $id
 * @property string $username
 * @property string $usertype
 * @property integer $logintime
 */
class Blocklist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blocklist the static model class
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
		return '{{blocklist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, usertype, logintime', 'required'),
			array('logintime', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('usertype', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, usertype, logintime', 'safe', 'on'=>'search'),
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
			'usertype' => Yii::t('system','user type'),
			'logintime' => Yii::t('system','login time'),
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
		$criteria->compare('usertype',$this->usertype,true);
		$criteria->compare('logintime',$this->logintime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}