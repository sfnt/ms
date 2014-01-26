<?php
class TopicsController extends MetController{
    public function actionIndex(){
        $model=new MetTopic('search');
        $model->unsetAttributes();  // 清理默认值
        
		if(isset($_GET['MetTopic'])){
			$model->attributes=$_GET['MetTopic'];
        }
        $this->render('index',array('model'=>$model));
    }
    
    public function loadModel($id)
	{
		$model=MetTopic::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('system','Data not exist.'));
		return $model;
	}

	/**
	 * Ajax验证
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='topic-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
    
}
?>