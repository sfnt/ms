<?php

class ColumnController extends ArticlesController
{

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($parentid = 0)
	{
		$model=new Column;

		// AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['Column']))
		{
			$model->attributes=$_POST['Column'];
            $time = time();
            $model->creattime = $time;
            $model->updatetime = $time;
            $model->publishtime = $time;
            if(isset($_POST['publishtime']) && $_POST['publishtime']){
                $model->publishtime = strtotime($_POST['publishtime']);
            }
            if($model->parentid>0){
                $parent = Column::model()->findByPk($model->parentid);
                if($parent)
                {
                    $model->level = $parent->level + 1;
                    if($parent->level==0){
                        $model->rootid = $parent->id;
                    }
                    else{
                        $model->rootid = $parent->rootid;
                    }
                }
                else
                {
                    $model->parentid = 0;
                    $model->level = 0;
                    $model->rootid = 0;
                }
            }
            else{
                $model->parentid = 0;
                $model->level = 0;
                $model->rootid = 0;
            }
            
			if($model->save())
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}
        if ($parentid)
			$model->parentid = $parentid;
        $model->template = 'column';
        $model->content_template = 'article';
		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		//AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['Column']))
		{
			$model->attributes=$_POST['Column'];
            $time = time();
            //$model->creattime = $time;
            $model->updatetime = $time;
            //$model->publishtime = $time;
            if(isset($_POST['publishtime']) && $_POST['publishtime']){
                $model->publishtime = strtotime($_POST['publishtime']);
            }
            if($model->parentid>0){
                $parent = Column::model()->findByPk($model->parentid);
                if($parent)
                {
                    $model->level = $parent->level + 1;
                    if($parent->level==0){
                        $model->rootid = $parent->id;
                    }
                    else{
                        $model->rootid = $parent->rootid;
                    }
                }
                else
                {
                    $model->parentid = 0;
                    $model->level = 0;
                    $model->rootid = 0;
                }
            }
            else{
                $model->parentid = 0;
                $model->level = 0;
                $model->rootid = 0;
            }
			if($model->save())
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$menus = Column::getTreeDATA('*', false);
        $tree = new Tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $array = array();
        $enum_display = EnumHelper::IsDisplay();
        $enum_template = EnumHelper::ColumnTemplate();
        $enum_contentTemplate = EnumHelper::ContentTemplate();
        foreach ($menus as $r) {
                                    
            $r['str_manage'] = CHtml::link('<i class="icon-plus icon-white"></i>'.Yii::t('articles','Add subcategory'), array('create', 'parentid'=>$r['id']),array('class'=>'btn btn-info')).'&nbsp;'.
            CHtml::link('<i class="icon-edit icon-white"></i>'.Yii::t('system','modify'), array('update', 'id'=>$r['id']),array('class'=>'btn btn-info'))
            .'&nbsp;'.
            CHtml::link('<i class="icon-trash icon-white"></i>'.Yii::t('system','delete'), array('delete', 'id'=>$r['id']),array('class'=>'btn btn-info btn-del')).'&nbsp;';
            
            $r['publish_status'] = $enum_display[$r['publish_status']];
            $r['template'] = $enum_template[$r['template']];
            $r['content_template'] = $enum_contentTemplate[$r['content_template']];
			$array[] = $r;
		}
        
        $str = "<tr>
					<td><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input-text-c'></td>
					<td >\$spacer\$name</td>
					<td >\$template</td>
                    <td >\$content_template</td>
                    <td >\$publish_status</td>
					<td >\$str_manage</td>
				</tr>";
		$tree->init($array);
		$this->render('index', array(
			'menuTree' => $tree->get_tree('0', $str)
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Column::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='column-form')
		{
            if(isset($_POST['publishtime']) && $_POST['publishtime']){
                $model->publishtime = strtotime($_POST['publishtime']);
            }
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    
	public function actionListorder(){
	   $listorders = $_POST['listorders'];
       $connection=Yii::app()->db;
       $transaction=$connection->beginTransaction();
	   $success = true;
       $sql="UPDATE ".Column::model()->tableName()." SET listorder=:listorder WHERE id=:id";
	   $command=$connection->createCommand($sql);
       try
	   {
           foreach($listorders as $key=>$value)
           {
                $command->bindParam(":listorder",$value,PDO::PARAM_INT);
                $command->bindParam(":id",$key,PDO::PARAM_INT);
                $command->execute();
           }
           $transaction->commit();
       }
       catch(Exception $e) // 如果有一条查询失败，则会抛出异常
		{
			$transaction->rollBack();
			$success = FALSE;
		}
        if($success){
            if (Yii::app()->request->isAjaxRequest) {
				$this->success(Yii::t('system','Successfully set new order!'));
			} else {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
        }
        else{
            if (Yii::app()->getRequest()->isAjaxRequest) {
				$result = array();
				$result['status'] = 0;
				$result['info'] = Yii::t('system','Set new order failed.');
				$result['data'] = null;
				header('Content-Type:text/html; charset=utf-8');
				exit(json_encode($result));
			} else {
				throw new CHttpException(505, Yii::t('system','Set new order failed.'));
			}
        }
	}
}
