<?php

class AdminUserController extends ManagementController
{
	
	/**
	 * 首页列表.
	 */
	public function actionIndex()
	{	
		
		$model=new Manager('search');
        $model->with(array('role'));
		$model->unsetAttributes();  // 清理默认值
		if(isset($_GET['Manager'])){
			$model->attributes=$_GET['Manager'];
        }
        if(isset($_GET['role'])&& is_numeric($_GET['role'])){
            $model->role_id=intval($_GET['role']);
        }
		$this->render('index',array(
			'model'=>$model,
		));
	}

	/**
	 * 创建
	 */
	public function actionCreate()
	{
		$model=new Manager;
        $model->scenario = 'create';
		// AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['Manager']))
		{
			$model->attributes=$_POST['Manager'];
            $model->createtime = time();
            $model->createoperator = $this->getUser()->id;
            $model->createip = UtilHelper::getOnlineIP();
            $model->salt = UtilHelper::getRndString(Yii::app()->params['saltlenght']);
			if($model->validate() && $model->save()){
				Yii::app()->manager->setFlash('success',Yii::t('system','Profile saved.'));
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
			else
				Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * 修改
	 * @param integer $id 主键
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$model->setScenario('update');
		//AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['Manager']))
		{	
			$model->attributes=$_POST['Manager'];
			if($model->validate()&&$model->update()){
				Yii::app()->manager->setFlash('success',Yii::t('system','Profile saved.'));
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
            }
			else
				Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
			//if($model->save())
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * 删除
	* @param integer $id 主键
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			
			$this->loadModel($id)->delete();

			// 如果是 AJAX 操作返回
			if (Yii::app()->request->isAjaxRequest) {
				$this->success('删除成功！');
			} else {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		}
		else
			throw new CHttpException(400,'非法访问！');
	}

	

	

	/**
	 * 载入
	 * @param integer $id 主键
	 */
	public function loadModel($id)
	{
		$model=Manager::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'内容不存在！.');
		return $model;
	}

	/**
	 * Ajax验证
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='admin-user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
