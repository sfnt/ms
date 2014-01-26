<?php
class DateTimepartController extends MetController{
    public function actionIndex(){
        $model=new MetDateDay('search');
        $model->with(array('plan','creator','timeParts','timeParts.room'));
        $model->unsetAttributes();  // 清理默认值
        
		if(isset($_GET['MetDateDay'])){
			$model->attributes=$_GET['MetDateDay'];
        }
        $this->render('index',array('model'=>$model));
    }
    
    public function loadModel($id)
	{
		$model=MetDateTimepart::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='datetime-form')
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
    public function actionCreate($dayid)
	{
		$model=new MetDateTimepart;
        $model->dayid = $dayid;
        $time = time();
        $model->creattime = $time;
        $model->creatorid = Yii::app()->manager->id;
        $model->starttime = $time;
        $model->endtime = $time;
        $model->start = $model->day->date_day;
        $model->end = $model->day->date_day;
		// AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['MetDateTimepart']))
		{
			$model->attributes=$_POST['MetDateTimepart'];
            //$time = time();
            $model->creattime = $time;
            $model->creatorid = Yii::app()->manager->id;
            $model->starttime = strtotime($model->start);
            $model->endtime = strtotime($model->end);
            
            $checkTime = MetDateTimepart::model()->exists('((starttime>=:start AND starttime<:end) OR (endtime>:start AND endtime<=:end) OR (starttime<=:start AND endtime>=:end)) AND roomid=:roomid',array(':start'=>$model->starttime,':end'=>$model->endtime,':roomid'=>$model->roomid));
            if($checkTime){
                Yii::app()->manager->setFlash('failure',Yii::t('system','Can not save timepart when there have another one in the same room at the specified time.'));
            }else{
                if($model->save()){
                    Yii::app()->manager->setFlash('success',Yii::t('system','Save successfully.'));
    				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
                else{
                    Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
                }
            }
			
		}
		$this->render('create',array(
			'model'=>$model,
		));
	}
    public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
        $model->start = date('Y-m-d H:i:s',$model->starttime);
        $model->end = date('Y-m-d H:i:s',$model->endtime);
		//AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['MetDateTimepart']))
		{
			$model->attributes=$_POST['MetDateTimepart'];
            $model->starttime = strtotime($model->start);
            $model->endtime = strtotime($model->end);
            $checkTime = MetDateTimepart::model()->exists('((starttime>=:start AND starttime<:end) OR (endtime>:start AND endtime<=:end) OR (starttime<=:start AND endtime>=:end)) AND roomid=:roomid AND id<>:id',array(':start'=>$model->starttime,':end'=>$model->endtime,':roomid'=>$model->roomid,':id'=>$model->id));
            
			if($checkTime){
                Yii::app()->manager->setFlash('failure',Yii::t('system','Can not save timepart when there have another one in the same room at the specified time.'));
            }else{
                if($model->save()){
                    Yii::app()->manager->setFlash('success',Yii::t('system','Save successfully.'));
    				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
                }
                else{
                    Yii::app()->manager->setFlash('failure',Yii::t('system','Save failed.'));
                }
            }
		}
		$this->render('update',array(
			'model'=>$model,
		));
	}
}
?>