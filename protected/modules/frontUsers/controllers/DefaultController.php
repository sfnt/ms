<?php
class DefaultController extends FrontUsersController{
    public function actionIndex(){
        $this->render('index');
    }
}
?>