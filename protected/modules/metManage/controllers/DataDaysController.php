<?php
class DataDaysController extends MetController{
    public function actionIndex(){
        $model=new MetDateDay('search');
        $model->with(array('plan','creator'));
        $model->unsetAttributes();  // 清理默认值
        
		if(isset($_GET['MetDateDay'])){
			$model->attributes=$_GET['MetDateDay'];
        }
        $this->render('index',array('model'=>$model));
    }
    
    public function loadModel($id)
	{
		$model=MetDateDay::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='dateDay-form')
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
		$model=new MetDateDay;

		// AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['MetDateDay']))
		{
			$model->attributes=$_POST['MetDateDay'];
            $time = time();
            $model->createtime = $time;
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

		if(isset($_POST['MetDateDay']))
		{
			$model->attributes=$_POST['MetDateDay'];
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