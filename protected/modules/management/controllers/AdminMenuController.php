<?php

class AdminMenuController extends ManagementController {

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($parentid = 0) {
		$model = new AdminMenu;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if (isset($_POST['AdminMenu'])) {
			$model->attributes = $_POST['AdminMenu'];
            if(!$model->parentid || $model->parentid==''){
                $model->parentid = $parentid;
            }
			if ($model->save()) {
				if (Yii::app()->request->getPost('crud', FALSE)) {
					foreach (array('create' => 'Create', 'update' => 'Modify', 'delete' => 'Delete') as $k => $act) {
						$data = $model->attributes;
						unset($data['id']);
						$data['action'] = $k;
						$data['name'] = $act;
						$data['display'] = 0;
						$data['parentid'] = $model->id;
						$menuObj =  new AdminMenu;
						$menuObj->setAttributes($data);
						$menuObj->save();
					}
				}
				$this->redirect(array('index'));
			}
		}
		if ($parentid)
			$model->parentid = $parentid;
		$this->render('create', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = $this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['AdminMenu'])) {
			$model->attributes = $_POST['AdminMenu'];
            if($model->parentid==''){
                $model->parentid=0;
            }
			if ($model->save())
				$this->redirect(array('index'));
		}

		$this->render('update', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		if (Yii::app()->request->isPostRequest) {
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if (Yii::app()->request->isAjaxRequest) {
				$this->success(Yii::t('system','Successfully delete data!'));
			} else {
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			}
		}
		else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * 管理页面
	 */
	public function actionIndex() {
		$menus = AdminMenu::getTreeDATA('*', false);

		$tree = new Tree();
		$tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $enum_display = EnumHelper::IsDisplay();
		foreach ($menus as $r) {
            //$r['name'] = Yii::t('menus',$r['name']);
			$r['str_manage'] = CHtml::link('<i class="icon-plus icon-white"></i>'.Yii::t('system','Add submenu'), array('create', 'parentid'=>$r['id']),array('class'=>'btn btn-info')).'&nbsp;'.
            CHtml::link('<i class="icon-edit icon-white"></i>'.Yii::t('system','modify'), array('update', 'id'=>$r['id']),array('class'=>'btn btn-info'))
            .'&nbsp;'.
            CHtml::link('<i class="icon-trash icon-white"></i>'.Yii::t('system','delete'), array('delete', 'id'=>$r['id']),array('class'=>'btn btn-info btn-del')).'&nbsp;';
            $r['display'] = $enum_display[$r['display']];
			$array[] = $r;
            
		}
		$str = "<tr>
					<td><input name='listorders[\$id]' type='text' size='3' value='\$listorder' class='input-text-c'></td>
					<td >\$spacer\$name</td>
					<td ><a href='\".Yii::app()->createUrl(\$modules.'/'.\$controller.'/'.\$action).\"'>\".Yii::app()->createUrl(\$modules.'/'.\$controller.'/'.\$action).\"</td>
                    <td style='text-align:center'>\".\$display.\"</td>
					<td>\$str_manage</td>
				</tr>";
		$tree->init($array);
		$this->render('index', array(
			'menuTree' => $tree->get_tree('0', $str)
		));
	}

	/**
	 * 排序 
	 */
	public function actionListorder() {
		$orders = Yii::app()->getRequest()->getPost('listorders');
		foreach ($orders as $k => $v) {
			AdminMenu::model()->updateByPk($k, array('listorder' => $v));
		}
		$this->success(Yii::t('system','Successfully set new order!'));
	}
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id) {
		$model = AdminMenu::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model) {
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-menu-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
