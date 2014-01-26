<?php
class UsersController extends FrontUsersController{
    public function actionIndex(){
        $model=new MetUser('search');
		$criteria=new CDbCriteria;
        /*
		if (Yii::app()->teacher->isadmin != '是') {
			$criteria->alias = 'student';
			$criteria->join='LEFT JOIN sa_studentcourse ON sa_studentcourse.studentid=student.id';
			$criteria->condition='sa_studentcourse.teacherid='. Yii::app()->teacher->id;
		}
		if (isset($_GET['Student']['username']) && !empty($_GET['Student']['username'])) {
			$model->username = $_GET['Student']['username'];
			$criteria->compare('username',$model->username,true);
		}

		if (isset($_GET['Student']['realname']) && !empty($_GET['Student']['realname'])) {
			$model->realname = $_GET['Student']['realname'];
			$criteria->compare('realname',$model->realname,true);
		}

		if (isset($_GET['Student']['status']) && !empty($_GET['Student']['status'])) {
			$model->status = $_GET['Student']['status'];
			$criteria->compare('status',$model->status);
		}
*/
		$criteria->order = 'regtime DESC, id DESC';

		$dataProvider=new CActiveDataProvider('MetUser',array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=>20,
			)
		));

		$this->render('index',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
		));
    }
    public function actionCreate()
	{
		$model=new MetUser;
        $model->scenario = 'create';
        $model->regtype=1;
		// AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['MetUser']))
		{
			$model->attributes=$_POST['MetUser'];
            $time = time();
            $model->regtime = $time;
            $model->regip = UtilHelper::getOnlineIP();
            
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
        $model->scenario = 'update';
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['MetUser']))
		{
			$model->attributes = $_POST['MetUser'];
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
    
    public function actionChangePassword($id){
        $model=$this->loadModel($id);
        $model->scenario = 'changepassword';
        $this->performAjaxValidation($model);
        if(isset($_POST['MetUser']))
		{
			$model->attributes = $_POST['MetUser'];
			if($model->save()){
                Yii::app()->manager->setFlash('success',Yii::t('system','New password saved.'));
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
            else{
                Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
            }
		}

		$this->render('changepassword',array(
			'model'=>$model,
		));
    }
    
    public function loadModel($id)
	{
		$model=MetUser::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>