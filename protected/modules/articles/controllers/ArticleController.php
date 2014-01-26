<?php

class ArticleController extends ArticlesController
{
	
	/**
	 * 首页列表.
	 */
	public function actionIndex()
	{
        $condition = '';
        $params = array();
        if(isset($_GET['column'])&& is_numeric($_GET['column']) && intval($_GET['column'])){
            $columnid = intval($_GET['column']);
            if($condition!=''){
                $condition .= ' AND ';
            }
            $cids = Column::getChildIds($columnid);
            $addChildWhere = '';
            if($cids){
                $addChildWhere = ' OR t.columnid in('.$cids.') ';
            }
            $condition .= '(t.columnid=:columnid '.$addChildWhere.')';
            $params[':columnid'] = $columnid;
        }
        $dataProvider=new CActiveDataProvider('Article', array(
            'criteria'=>array(
                'condition'=>$condition,
                'params'=>$params,
                'order'=>'t.creattime DESC,t.id DESC',
                'with'=>array('column','admin'),
            ),
            'pagination'=>array(
                'pageSize'=>25,
            ),
        ));
        
		$model=new Article('search');
        $model->with(array('column'));
        
		$model->unsetAttributes();  // 清理默认值
		if(isset($_GET['Article'])){
			$model->attributes=$_GET['Article'];
        }
        
		$this->render('index',array(
			'model'=>$model,
            'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * 创建
	 */
	public function actionCreate()
	{
		$model=new Article;

		// AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['Article']))
		{
			$model->attributes=$_POST['Article'];
            $time = time();
            $model->creattime = $time;
            $model->updatetime = $time;
            $model->publishtime = $time;
            $model->adminid = Yii::app()->manager->id;
            if(isset($_POST['publishtime']) && $_POST['publishtime']){
                $model->publishtime = strtotime($_POST['publishtime']);
            }
            if(isset($_POST['flag'])){
                $f = '';
                foreach($_POST['flag'] as $k=>$v){
                    if($f!=''){
                        $f.=',';
                    }
                    $f.=$k;
                }
                $model->flag = $f;
            }else{
                $model->flag = '';
            }
            if($model->is_redirect && !preg_match("#j#", $model->flag))
            {
                $model->flag = ($model->flag=='' ? 'j' : $model->flag.',j');
            }
            $firstP = StringHelper::getFirstPic($model->content);
            if($firstP && !preg_match("#p#", $model->flag)){
                $model->flag = ($model->flag=='' ? 'p' : $model->flag.',p');
            }
            $model->with_pic = ($firstP!=''?1:0);
            $model->title_pic_path = $firstP;
            
			if($model->save())
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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

		//AJAX 表单验证
		$this->performAjaxValidation($model);

		if(isset($_POST['Article']))
		{
			$model->attributes=$_POST['Article'];
            $model->updatetime = time();
            if(isset($_POST['publishtime']) && $_POST['publishtime']){
                $model->publishtime = strtotime($_POST['publishtime']);
            }
            if(isset($_POST['flag'])){
                $f = '';
                foreach($_POST['flag'] as $k=>$v){
                    if($f!=''){
                        $f.=',';
                    }
                    $f.=$k;
                }
                $model->flag = $f;
            }else{
                $model->flag = '';
            }
            if($model->is_redirect && !preg_match("#j#", $model->flag))
            {
                $model->flag = ($model->flag=='' ? 'j' : $model->flag.',j');
            }
            $firstP = StringHelper::getFirstPic($model->content);
            $model->with_pic = ($firstP!=''?1:0);
            $model->title_pic_path = $firstP;
            
            if($firstP && !preg_match("#p#", $model->flag)){
                $model->flag = ($model->flag=='' ? 'p' : $model->flag.',p');
            }
			if($model->save())
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
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
        $article = $this->loadModel($id);
		if($article)
		{
			if($article->delete())
				Yii::app()->manager->setFlash('success',Yii::t('system','Successfully delete data!'));
			else
				Yii::app()->manager->setFlash('failure',Yii::t('system','Delete failed!'));
    
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
			
		}
		else
			throw new CHttpException(400,Yii::t('system','Not allowed to access.'));
	}

	

	

	/**
	 * 载入
	 * @param integer $id 主键
	 */
	public function loadModel($id)
	{
		$model=Article::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='article-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
