<?php
class FrontUsersController extends ManagementController{
    public function init(){
        $this->layout = SystemHelper::getSystemViewsPath().'/layouts/main';
        parent::init();
    }
}
?>