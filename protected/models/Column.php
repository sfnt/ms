<?php

/**
 * This is the model class for table "{{column}}".
 *
 * The followings are the available columns in table '{{column}}':
 * @property integer $id
 * @property string $name
 * @property integer $level
 * @property integer $rootid
 * @property integer $parentid
 * @property string $template
 * @property string $content_template
 * @property integer $listorder
 * @property integer $publish_status
 * @property integer $with_list
 * @property integer $creattime
 * @property integer $updatetime
 * @property integer $publishtime
 * @property string $gotourl
 * @property string $content
 * @property integer $need_login
 */
class Column extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Column the static model class
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
		return '{{column}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('name,parentid,template,content_template', 'required'),
			array('level, rootid, parentid, listorder, publish_status, with_list, creattime, updatetime, publishtime, need_login', 'numerical', 'integerOnly'=>true),
			array('name, template, content_template', 'length', 'max'=>50),
			array('gotourl', 'length', 'max'=>200),
			array('content', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, level, rootid, parentid, template, content_template, listorder, publish_status, with_list, creattime, updatetime, publishtime, gotourl, content, need_login', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('articles','Category name'),
			'level' => Yii::t('articles','Category level'),
			'rootid' => Yii::t('articles','Root category'),
			'parentid' => Yii::t('articles','Parent category'),
			'template' => Yii::t('articles','Template'),
			'content_template' => Yii::t('articles','Content template'),
			'listorder' => Yii::t('system','order'),
			'publish_status' => Yii::t('system','display'),
			'with_list' => Yii::t('articles','With list'),
			'creattime' => Yii::t('system','create time'),
			'updatetime' => Yii::t('system','update time'),
			'publishtime' => Yii::t('articles','publish time'),
			'gotourl' => Yii::t('articles','link url'),
			'content' => Yii::t('articles','Content'),
			'need_login' => Yii::t('articles','Need Login'),
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('rootid',$this->rootid);
		$criteria->compare('parentid',$this->parentid);
		$criteria->compare('template',$this->template,true);
		$criteria->compare('content_template',$this->content_template,true);
		$criteria->compare('listorder',$this->listorder);
		$criteria->compare('publish_status',$this->publish_status);
		$criteria->compare('with_list',$this->with_list);
		$criteria->compare('creattime',$this->creattime);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('publishtime',$this->publishtime);
		$criteria->compare('gotourl',$this->gotourl,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('need_login',$this->need_login);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * 删除前
     */
    public function beforeDelete() {
        if(!parent::beforeDelete())
            return FALSE;
        
        $count = self::model()->count('parentid=:parentid', array('parentid'=>$this->id));
        if($count != 0)
            throw new CDbException(Yii::t('articles','This category have one or more subcategories, please remove all subcategories before delete.'));
        return true;    
    }
    protected static $_menus = array();
    //后台菜单
    public static function getTreeDATA($select = null,$cache = TRUE) {
        $cacheId = 'column'.($select !== null?'_'.$select:'');
        
        if($cache) {
           
            $menus = Yii::app()->getCache()->get($cacheId);
            
            if($menus)
                return $menus;
        }
        if(self::$_menus){
            //print_R(self::$_menus);exit();
            return self::$_menus;
        }
        $model = self::model()->getDbConnection()->createCommand()
                ->from(self::model()->tableName())
                //->where('publish_status=1')
                ->order('listorder DESC,id ASC');

        if ($select !== null)
            $model->select($select);
        else
            $model->select ('id,parentid,name,rootid,level,publish_status');
        
        $menus = $model->queryAll();
       
        $array = array();
        foreach($menus as $menu) {
            $menu['name']=Yii::t('columns',$menu['name']);
            $array[$menu['id']] = $menu;
        } 
        $menus = $array;
        self::$_menus = $menus;
        if($cache)  Yii::app()->getCache()->set($cacheId,$menus);
        return $menus;
    }
    public static function getArrayTree($pid=0){
        $menus = self::getTreeDATA(null, FALSE);
        $levelArr = array();
        foreach($menus as $r){
            if(!isset($levelArr[$r['level']])){
                $levelArr[$r['level']] = array();
            }
            $levelArr[$r['level']][$r['id']] = $r;
        }
        $levelNum = count($levelArr)-1;
        
        $tempArr = array();
        for($i=$levelNum;$i>=0;$i--){
            foreach($levelArr[$i] as $r){
                if(isset($tempArr[$r['id']])){
                    $r['child'] = $tempArr[$r['id']]['child'];
                    unset($tempArr[$r['id']]);
                }
                if($pid==$r['id']){
                    return $r;
                }
                if(!isset($tempArr[$r['parentid']])){
                    $tempArr[$r['parentid']] = array();
                    $tempArr[$r['parentid']]['child'] = array();
                }
                $tempArr[$r['parentid']]['child'][$r['id']] = $r;
            }
        }
        if(isset($tempArr[0])){
            return $tempArr[0]['child'];
        }
        else{
            return $tempArr();
        }
    }
    public static function getParentArr($pid){
        $menus = self::getTreeDATA(null, FALSE);
        if(isset($menus[$pid])){
            $tempMenus = array();
            $ret = array();
            $ret[$menus[$pid]['level']] = $menus[$pid];
            foreach($menus as $k=>$v){
                if(($menus[$pid]['rootid']==$v['rootid'] || 0==$v['rootid']) && $menus[$pid]['level']>$v['level']){
                    $tempMenus[$k]=$v;
                }
            }
            $parentid = $menus[$pid]['parentid'];
            while($parentid>0){
                if(isset($tempMenus[$parentid])){
                    $ret[$tempMenus[$parentid]['level']] = $tempMenus[$parentid];
                    $parentid = $tempMenus[$parentid]['parentid'];
                }
            }
            return $ret;
        }
        else{
            return array();
        }
    }
    
    public static function getSelectTree($empty = NULL, $pid = 0 ,$empty_value='0') {

        $menus = self::getTreeDATA(null, FALSE);
        $tree = new Tree();
        $array = array();
        foreach ($menus as $r) {
            $r['selected'] = ($pid != 0 && $pid === $r['id']) ? 'selected' : '';
            $array[] = $r;
        }
        // print_r($array);
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);

        if ($empty !== NULL)
            return '<option value="'.$empty_value.'">' . $empty . '</option>' . $tree->get_tree('0', $str);
        else
            return $tree->get_tree('0', $str);
    }
    
    public static function getChildIds($id){
        //echo 'test'.$id;
        $menus = self::getTreeDATA(null, FALSE);
        $ids = '';
        
        $c = self::getArrayTree($id);
        if(isset($c['child'])){
            foreach($c['child'] as $key=>$v){
                if($v['publish_status']!=1)
                {
                    continue;
                }
                if($ids!=''){
                    $ids.=',';
                }
                $ids .= $key;
                $childs = self::getChildIds($key);
                
                if($childs!=''){
                    $ids .= ',';
                    $ids .= $childs;
                }
            }
        }
        return $ids;
    }
    
    public static $dataList = null;

	public static function getDataList($city_id = null) {
        $tree = new Tree();
		if(self::$dataList == null) {
			$menus = self::getTreeDATA(null, FALSE);
            
            $tree->init($menus);
			self::$dataList = $tree->get_tree_data('0');
		}
		if($city_id==null) {
			return self::$dataList;
		} else {
			if(isset(self::$dataList[$city_id]))
                {
                    $ret = self::$dataList[$city_id];
                    $ret = str_replace($tree->icon,'',$ret);
				    return $ret;
                }
			else
				return FALSE;
		}
	}
    public function checkparentid($attribute,$params){
        
        if($this->parentid == $this->id){
            $this->addError($attribute, Yii::t('articles','Make the parent of one category to be itself is not allowed!'));
        }
    }
    
}