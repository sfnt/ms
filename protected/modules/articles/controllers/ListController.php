<?php
class ListController extends ArticlesController{
    public function actionIndex(){
        $this->redirect(array('/articles/article/index'));
        //$this->render('index');
    }
}
?>