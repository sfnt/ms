<?php
class ArticlesController extends ManagementController{
    public function init(){
        $this->layout = SystemHelper::getSystemViewsPath().'/layouts/main';
        parent::init();
        
        //$this->pageTitle = Yii::app()->name;
    }
}
?>