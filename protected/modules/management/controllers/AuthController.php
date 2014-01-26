<?php

class AuthController extends Controller
{
	public $layout = 'login';
	/**
	 * Displays the login page
	 */
	
	public function actionLogin()
	{	
		$model=new ManagerLoginForm;
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='adminlogin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['ManagerLoginForm']))
		{
			$model->attributes=$_POST['ManagerLoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
				Yii::app()->manager->setFlash('success','登录成功，正在返回登录前页面');
				$this->redirect(array('/management/mydashboard')); 
                Yii::app()->end();
			}
		}
		// display the login form
		$this->render('login',array('model'=>$model));/**/
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->manager->logout();
		$this->redirect(array('/management/auth/login')); 
        Yii::app()->end();
	}
}