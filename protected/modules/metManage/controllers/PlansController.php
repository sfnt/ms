<?php
class PlansController extends MetController{
    public function actionIndex(){
        $model=new MetMeetingPlan('search');
        $model->unsetAttributes();  // 清理默认值
        
		if(isset($_GET['MetMeetingPlan'])){
			$model->attributes=$_GET['MetMeetingPlan'];
        }
        $this->render('index',array('model'=>$model));
    }
    
    public function loadModel($id)
	{
		$model=MetMeetingPlan::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='baseSession-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionDelete($id){
        $model = $this->loadModel($id);
        $model->delete();
        echo 'ok';
    }
    
    public function actionCreate()
	{
		$model=new MetMeetingPlan;

		// AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['MetMeetingPlan']))
		{
			$model->attributes=$_POST['MetMeetingPlan'];
            $time = time();
            $model->createtime = $time;
            $model->updatetime = $time;
            $model->creatorid = Yii::app()->manager->id;
			if($model->save()){
                Yii::app()->manager->setFlash('success',Yii::t('system','Save successfully.'));
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
            else{
                Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
            }
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		//AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['MetMeetingPlan']))
		{
			$model->attributes=$_POST['MetMeetingPlan'];
            $model->updatetime = time();
			if($model->save()){
                Yii::app()->manager->setFlash('success',Yii::t('system','Save successfully.'));
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
            else{
                Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
}
?>