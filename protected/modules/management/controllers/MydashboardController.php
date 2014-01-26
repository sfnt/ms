<?php

class MydashboardController extends ManagementController
{
	/**
	 * Displays the login page
	 */
	
	public function actionIndex()
	{	
        Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl .'/js/dashboard.js');
		$this->render('index');
	}
}