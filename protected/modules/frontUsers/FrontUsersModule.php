<?php

class FrontUsersModule extends CWebModule
{
	//public $defaultController='list';
    private $_assetsUrl;
    private $_selfAssetsUrl;
	private $_isSuperUser = false;
    private $_roleMenuIds;
    
	public function init()
	{
        parent::init();
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'management.models.*',
			'management.components.*',
            'frontUsers.models.*',
			'frontUsers.models.forms.*',
			'frontUsers.components.*',
		));

       Yii::app()->setComponents(array(  
               'errorHandler'=>array(  
                       'class'=>'CErrorHandler',  
                       'errorAction'=>'management/site/error',  
               ),  
               'manager'=>array(  
                       'class'=>'ManagerWebUser',              //后台登录类实例
                       'stateKeyPrefix'=>'sfnt_admin_',    //后台session前缀
                       'loginUrl'=>Yii::app()->createUrl('management/auth/login'),
               ),  
       ), false);
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
            Yii::app()->name = Yii::t('app',Yii::app()->name);
            $controller->pageTitle = Yii::app()->name . ' - '.Yii::t('system','SFNT Content Management System');
			// this method is called before any module controller action is performed
			// you may place customized code here
            $route=$controller->id.'/'.$action->id;
            
            if(Yii::app()->manager->isGuest){
                Yii::app()->manager->loginRequired(); 
            }
            if(in_array(self::getUser()->id, SystemHelper::getSuperuserIDs())) {
				$this->_isSuperUser = true;
				return TRUE;
			}
            $array = array(
				'modules' => $controller->getModule()->getId(),
				'controller' => $controller->id,
				'action' => $action->id
			);
            $menus = Yii::app()->getDb()->createCommand()
					->from("{{admin_role_priv}} as p")
					->select("id,parentid,name,modules,controller,action")
					->leftJoin("{{admin_menu}} as m", 'm.id=p.menu_id')
					->where('p.role_id=:rid', array("rid" => self::getUser()->role_id))
					->queryAll();
			foreach ($menus as $key => $val) {
				$this->_roleMenuIds[] = $val['id'];
				unset($val['id']);
                unset($val['parentid']);
                unset($val['name']);
				$menus[$key] = $val;
			}
            if (!in_array($array, $menus)) {
				if (Yii::app()->getRequest()->isAjaxRequest) {
					$result = array();
					$result['status'] = 0;
					$result['info'] = Yii::t('system',"You are not allowed to access this page.");
					$result['data'] = null;
					header('Content-Type:text/html; charset=utf-8');
					exit(json_encode($result));
				} else {
					throw new CHttpException(505, Yii::t('system',"You are not allowed to access this page."));
				}
			}
            
			return true;
		}
		else
			return false;
	}  
    public function getSelfAssetsUrl() {
		if ($this->$_selfAssetsUrl === null)
			$this->$_selfAssetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('frontUsers.assets'),true, -1, YII_DEBUG);
		return $this->$_selfAssetsUrl;
	}
    public function setSelfAssetsUrl($value) {
		$this->$_selfAssetsUrl = $value;
	}
	public function getAssetsUrl() {
		if ($this->_assetsUrl === null)
			$this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('management.assets'),true, -1, YII_DEBUG);
		return $this->_assetsUrl;
	}
    
	public function setAssetsUrl($value) {
		$this->_assetsUrl = $value;
	}
	public static function getUser() {
		return Yii::app()->manager;
	}
	public function getRoleMenuIds() {
		return $this->_roleMenuIds;
	}
    public function getIsSuperUser() {
		return $this->_isSuperUser;
	}
}
