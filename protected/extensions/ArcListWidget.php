<?php
class ArcListWidget extends CWidget{
    
    private $_columnId = 0;
    public function setColumnId($value) {$this->_columnId = $value;}
	public function getColumnId() {return $this->_columnId;}
    
    private $_length = 0;
    public function setLength($value) {$this->_length = $value;}
	public function getLength() {return $this->_length;}
    
    private $_limit = 10;
    public function setLimit($value) {$this->_limit = $value;}
	public function getLimit() {return $this->_limit;}
    
    private $_offset = 0;
    public function setOffset($value) {$this->_offset = $value;}
	public function getOffset() {return $this->_offset;}
    
    private $_showSub = false;
    public function setShowSub($value) {$this->_showSub = $value;}
	public function getShowSub() {return $this->_showSub;}
    
    private $_orderBy = 't.publishtime DESC';
    public function setOrderBy($value) {$this->_orderBy = $value;}
	public function getOrderBy() {return $this->_orderBy;}
    
    private $_htmlOptions = array();
    public function setHtmlOptions($value) {$this->_htmlOptions = $value;}
	public function getHtmlOptions() {return $this->_htmlOptions;}
    
    private $_itemHtmlOptions = array();
    public function setItemHtmlOptions($value) {$this->_itemHtmlOptions = $value;}
	public function getItemHtmlOptions() {return $this->_itemHtmlOptions;}
    
    private $_linkHtmlOptions = array();
    public function setLinkHtmlOptions($value) {$this->_linkHtmlOptions = $value;}
	public function getLinkHtmlOptions() {return $this->_linkHtmlOptions;}
    
    private $_itemTemplate = '';
    public function setItemTemplate($value) {$this->_itemTemplate = $value;}
	public function getItemTemplate() {return $this->_itemTemplate;}
    
    private $_template = '';
    public function setTemplate($value) {$this->_template = $value;}
	public function getTemplate() {return $this->_template;}
    
    private $_noflag = '';
    public function setNoflag($value) {$this->_noflag = $value;}
	public function getNoflag() {return $this->_noflag;}
    
    private $_flag = '';
    public function setFlag($value) {$this->_flag = $value;}
	public function getFlag() {return $this->_flag;}
    
    private $_criteria = null;
    public function setCriteria($value) {$this->_criteria = $value;}
	public function getCriteria() {return $this->_criteria;}
    
    private $_actionPath = '/article/view';
    public function setActionPath($value) {$this->_actionPath = $value;}
	public function getActionPath() {return $this->_actionPath;}
    
    private $_categoryPath = '/column/view';
    public function setCategoryPath($value) {$this->_categoryPath = $value;}
	public function getCategoryPath() {return $this->_categoryPath;}
    
    private $_picWidth = 0;
    public function setPicWidth($value) {$this->_picWidth = $value;}
	public function getPicWidth() {return $this->_picWidth;}
    
    private $_picHeight = 0;
    public function setPicHeight($value) {$this->_picHeight = $value;}
	public function getPicHeight() {return $this->_picHeight;}
    
    private $_subDay = 0;
    public function setSubDay($value) {$this->_subDay = $value;}
	public function getSubDay() {return $this->_subDay;}
    
    
    private $_data;
    public function init() {  
        parent::init();  
        
        if(!$this->_criteria){
            $this->_criteria = new CDbCriteria;
        }
        $criteria = $this->_criteria;
        $condition = '';
        
        
        
        if($this->_columnId>0){
            $condition = 't.columnid=:columnid';
            $criteria->params[':columnid'] = $this->_columnId;
        }
        
        if($this->_showSub){
            $subIds = Column::getChildIds($this->_columnId);
            if($subIds){
                if($condition){
                    $condition .= ' OR ';
                }
                $condition .= 't.columnid in ('.Column::getChildIds($this->_columnId).')';
            }
            
        }
        $flag_condition = '';
        if(!empty($this->_noflag))
        {
            if(!preg_match('#,#', $this->_noflag))
            {
                if($flag_condition){
                    $flag_condition .= ' AND ';
                }
                $flag_condition .= " FIND_IN_SET('$this->_noflag', t.flag)<1 ";
            }
            else
            {
                $noflags = explode(',', $this->_noflag);
                foreach($noflags as $noflag) {
                    if(trim($noflag)=='') continue;
                    if($flag_condition){
                        $flag_condition .= ' AND ';
                    }
                    $flag_condition .= " FIND_IN_SET('$noflag', t.flag)<1 ";
                }
            }
        }
        
        if(!empty($this->_flag))
        {
            if(!preg_match('#,#', $this->_flag))
            {
                if($flag_condition){
                    $flag_condition .= ' AND ';
                }
                $flag_condition .= " FIND_IN_SET('$this->_flag', t.flag)>0 ";
            }
            else
            {
                $flags = explode(',', $this->_flag);
                foreach($flags as $flag) {
                    if(trim($flag)=='') continue;
                    if($flag_condition){
                        $flag_condition .= ' AND ';
                    }
                    $flag_condition .= " FIND_IN_SET('$flag', t.flag)>0 ";
                }
            }
        }
        
        if($criteria->condition!=''){
            $criteria->condition = '('.$criteria->condition.') AND ('.$condition.')';
            
        }
        else{
            $criteria->condition = $condition;
        }
        if($criteria->condition!=''){
            if($flag_condition){
                $criteria->condition = '('.$criteria->condition.') AND ('.$flag_condition.')';
            }
        }
        else{
            $criteria->condition = $flag_condition;
        }
        
        if($this->_subDay>0){
            $timeDepart = $this->_subDay * 24 * 3600;
            if($criteria->condition!=''){
                $criteria->condition = '('.$criteria->condition.') AND (t.publishtime>=:subTime)';
            }
            else{
                $criteria->condition = '(t.publishtime>=:subTime)';
            }
            $criteria->params[':subTime'] = time()-$timeDepart;
        }
        
        if($this->_limit>0){
            $criteria->limit=$this->_limit;
        }
        if($this->_offset>0){
            $criteria->offset=$this->_offset;
        }
        
        if($this->_orderBy){
            $criteria->order = $this->_orderBy;
        }
        
        $this->_criteria = $criteria;
    }  
     public function run() {  
        parent::run(); 
        $this->_data = Article::model()->findAll($this->_criteria);
        if(empty($this->_data)){
            return;
        }
        //print_r($this->_criteria);
        if($this->_template){
            $this->renderContent();
        }
        else{
            echo CHtml::openTag('ul',$this->_htmlOptions)."\n";
            $this->renderItems();
            echo CHtml::closeTag('ul');
        }
        
    }
    public function renderContent()
	{
		ob_start();
		echo preg_replace_callback("/{(\w+)}/",array($this,'renderSection'),$this->_template);
		ob_end_flush();
	}

	protected function renderSection($matches)
	{
		$method='render'.$matches[1];
		if(method_exists($this,$method))
		{
			$this->$method();
			$html=ob_get_contents();
			ob_clean();
			return $html;
		}
		else
			return $matches[0];
	}
    public function renderItems(){
        
        foreach($this->_data as $article){
            if($this->_length>0){
                if(mb_strlen($article->title,'utf-8')>$this->_length){
                    $article->title = mb_substr($article->title,0,$this->_length-2,'utf-8').'...';
                }
                if(mb_strlen($article->shorttitle,'utf-8')>$this->_length){
                    $article->shorttitle = mb_substr($article->shorttitle,0,$this->_length-2,'utf-8').'...';
                }
            }
            $reTitle = $article->title;
            $reShortTitle = $article->shorttitle;
            if($article->color){
                $article->title = '<font color="'.$article->color.'">'.$article->title.'</font>';
                $article->shorttitle = '<font color="'.$article->color.'">'.$article->shorttitle.'</font>';
            }
            if($article->with_pic && $this->_picWidth>0 && $this->picHeight>0 ){
                $article->title_pic_path = ImageHelper::thumb($article->title_pic_path,$this->_picWidth,$this->picHeight);
            }
            if($this->_itemTemplate){
                $out = $this->_itemTemplate;
                if(preg_match("{Link}", $out)){
                    $out = str_replace('{Link}',Yii::app()->createUrl($this->_actionPath,array('id'=>$article->id)),$out);
                }
                if(preg_match("{Title}", $out)){
                    $out = str_replace('{Title}',$article->title,$out);
                }
                if(preg_match("{ShortTitle}", $out)){
                    $out = str_replace('{ShortTitle}',$article->shorttitle,$out);
                }
                if(preg_match("{ReTitle}", $out)){
                    $out = str_replace('{ReTitle}',$reTitle,$out);
                }
                if(preg_match("{ReShortTitle}", $out)){
                    $out = str_replace('{ReShortTitle}',$reShortTitle,$out);
                }
                if(preg_match("{Author}", $out)){
                    $out = str_replace('{Author}',$article->author,$out);
                }
                if(preg_match("{From}", $out)){
                    $out = str_replace('{From}',$article->from,$out);
                }
                if(preg_match("{Date}", $out)){
                    $out = str_replace('{Date}',date('Y-m-d',$article->publishtime),$out);
                }
                if(preg_match("{Time}", $out)){
                    $out = str_replace('{Time}',date('H:i:s',$article->publishtime),$out);
                }
                if(preg_match("{Click}", $out)){
                    $out = str_replace('{Click}',$article->click_num,$out);
                }
                if(preg_match("{CategoryName}", $out)){
                    $out = str_replace('{CategoryName}',$article->column->name,$out);
                }
                if(preg_match("{CategoryLink}", $out)){
                    $out = str_replace('{CategoryLink}',Yii::app()->createUrl($this->_categoryPath,array('id'=>$article->columnid)),$out);
                }
                if(preg_match("{Body}", $out)){
                    $out = str_replace('{Body}',$article->content,$out);
                }
                if(preg_match("{PicPath}", $out)){
                    $out = str_replace('{PicPath}',$article->title_pic_path,$out);
                }
                if(preg_match("{PicWidth}", $out)){
                    $out = str_replace('{PicWidth}',$this->_picWidth,$out);
                }
                if(preg_match("{PicHeight}", $out)){
                    $out = str_replace('{PicHeight}',$this->_picHeight,$out);
                }
                echo $out;
            }else{
                echo CHtml::openTag('li',$this->_itemHtmlOptions)."\n";
                echo CHtml::link($article->title,array($this->_actionPath,'id'=>$article->id),$this->_linkHtmlOptions)."\n";
                echo CHtml::closeTag('li');
            }
        }
        
    }
}
?>