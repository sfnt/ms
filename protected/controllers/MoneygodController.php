<?php
class MoneygodController extends Controller{
    public $layout = 'mg';
    public $params = array();
    function init(){
        parent::init();
        Yii::app()->name = Yii::t('app',Yii::app()->name);
    }
    public function actionIndex(){
        $this->render('index');
    }
    public function actionCategory($id){
        $column = Column::model()->findByPk($id);
        if($column){
            if($column->gotourl){
                $this->redirect($column->gotourl);
                Yii::app()->end();
            }
            $this->params = array(
                'columnid'=>$id,
                'rootColumnId'=>($column->level==0?$column->id:$column->rootid),
            );
            $this->render($column->template,array(
                'column'=>$column,
            ));
        }else{
            echo 'error';
        }
    }
    public function actionArticle($id){
        $article = Article::model()->with('column')->findByPk($id);
        if($article){
            $column = $article->column;
            $this->params = array(
                'columnid'=>$column->id,
                'rootColumnId'=>($column->level==0?$column->id:$column->rootid),
            );
            if(preg_match("#j#", $article->flag) && $article->redirecturl){
                $this->redirect($article->redirecturl);
                Yii::app()->end();
            }
            $this->render($column->content_template,array(
                'column'=>$column,
                'article'=>$article,
            ));
        }else{
            echo 'error';
        }
    }
    public function actionClick($article){
        
        $a = Article::model()->findByPk($article);
        if($a){
            echo 'document.write("'.$a->click_num.'");';
        }
        $a->click_num++;
        $a->save();
    }
}
?>