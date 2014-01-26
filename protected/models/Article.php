<?php

/**
 * This is the model class for table "{{article}}".
 *
 * The followings are the available columns in table '{{article}}':
 * @property integer $id
 * @property integer $columnid
 * @property string $title
 * @property string $shorttitle
 * @property string $color
 * @property string $author
 * @property string $from
 * @property integer $creattime
 * @property integer $updatetime
 * @property integer $publishtime
 * @property integer $click_num
 * @property integer $money
 * @property string $flag
 * @property integer $with_pic
 * @property string $title_pic_path
 * @property integer $posterid
 * @property integer $status
 * @property string $keywords
 * @property string $description
 * @property string $content
 * @property string $filename
 * @property integer $is_redirect
 * @property string $redirecturl
 */
class Article extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return '{{article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, columnid, content', 'required'),
			array('columnid, creattime, updatetime, publishtime, click_num, money, with_pic, posterid, adminid, status, is_redirect', 'numerical', 'integerOnly'=>true),
			array('title, title_pic_path', 'length', 'max'=>200),
			array('shorttitle', 'length', 'max'=>36),
			array('color', 'length', 'max'=>7),
			array('author, from, keywords', 'length', 'max'=>50),
			array('description', 'length', 'max'=>250),
			array('filename', 'length', 'max'=>40),
			array('redirecturl', 'length', 'max'=>255),
			array('flag', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, columnid, title, shorttitle, color, author, from, creattime, updatetime, publishtime, click_num, money, flag, with_pic, title_pic_path, posterid, adminid, status, keywords, description, content, filename, is_redirect, redirecturl', 'safe', 'on'=>'search'),
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
            'column' => array(self::BELONGS_TO, 'Column', 'columnid'),
            'admin' => array(self::BELONGS_TO, 'Manager', 'adminid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('system','ID'),
			'columnid' => Yii::t('articles','Category'),
			'title' => Yii::t('articles','Title'),
			'shorttitle' => Yii::t('articles','Short Title'),
			'color' => Yii::t('articles','Title Color'),
			'author' => Yii::t('articles','Author'),
			'from' => Yii::t('articles','From'),
			'creattime' => Yii::t('system','create time'),
			'updatetime' => Yii::t('system','update time'),
			'publishtime' => Yii::t('articles','publish time'),
			'click_num' => Yii::t('articles','Click Num'),
			'money' => Yii::t('articles','Sell Price'),
			'flag' => Yii::t('articles','Flag'),
			'with_pic' => Yii::t('articles','With Picture'),
			'title_pic_path' => Yii::t('articles','Picture Path'),
			'posterid' => Yii::t('articles','Poster'),
            'adminid' => Yii::t('articles','Editor'),
			'status' => Yii::t('system','Status'),
			'keywords' => Yii::t('articles','Keywords'),
			'description' => Yii::t('articles','Description'),
			'content' => Yii::t('articles','Content'),
			'filename' => Yii::t('articles','File Name'),
			'is_redirect' => Yii::t('articles','Is Redirect'),
			'redirecturl' => Yii::t('articles','Redirect URL'),
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
		$criteria->compare('columnid',$this->columnid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('shorttitle',$this->shorttitle,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('author',$this->author,true);
		$criteria->compare('from',$this->from,true);
		$criteria->compare('creattime',$this->creattime);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('publishtime',$this->publishtime);
		$criteria->compare('click_num',$this->click_num);
		$criteria->compare('money',$this->money);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('with_pic',$this->with_pic);
		$criteria->compare('title_pic_path',$this->title_pic_path,true);
		$criteria->compare('posterid',$this->posterid);
        $criteria->compare('adminid',$this->adminid);
		$criteria->compare('status',$this->status);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('filename',$this->filename,true);
		$criteria->compare('is_redirect',$this->is_redirect);
		$criteria->compare('redirecturl',$this->redirecturl,true);
        $criteria->order = 't.publishtime desc';
        
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}