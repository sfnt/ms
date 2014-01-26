<?php

class ProfileController extends ManagementController
{
    /**
     * 修改个人信息
     */
	public function actionIndex()
	{
        $manager=$this->loadModel(Yii::app()->manager->id);

		$manager->scenario = 'update';

        // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($manager);

        if(isset($_POST['Manager']))
        {
            $manager->attributes=$_POST['Manager'];
            
            if($manager->validate()&&$manager->update())
				Yii::app()->manager->setFlash('success',Yii::t('system','Profile saved.'));
			else
				Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
        }

        $this->render('index',array(
            'model'=>$manager,
        ));
	}
    
    
    /**
     * 修改密码
     */
    public function actionChangePassword(){
        $model=$this->loadModel(Yii::app()->manager->id);
		$model->scenario = 'changepassword';

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if(isset($_POST['Manager']))
        {
			$model->oldPassword = $_POST['Manager']['oldPassword'];
			$model->newPassword = $_POST['Manager']['newPassword'];
			$model->repeatPassword = $_POST['Manager']['repeatPassword'];
			if($model->save()) {
				Yii::app()->manager->setFlash('success',Yii::t('system','New password saved.'));
				$model->oldPassword = null;
				$model->newPassword = null;
				$model->repeatPassword = null;
			} else
				Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
        }

        $this->render('changepassword',array(
            'model'=>$model,
        ));
    }

    /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Manager::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('system','Data not exist.'));
		return $model;
	}
    
    /**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='manager-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}