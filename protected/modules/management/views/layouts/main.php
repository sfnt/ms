<?php
$menus = Yii::app()->getDb()->createCommand()
		->from(AdminMenu::model()->tableName())
		->select('*')
		->order('listorder DESC,id ASC');

if($this->getModule()->getIsSuperUser()) {
	//$menus->where('display=1');
} else {
	$menus->where('id in('.implode(",", $this->getModule()->getRoleMenuIds()).')');
}
$menus = $menus->queryAll();
$t_menus = array();
$t_menuKeys = array();
foreach ($menus as $key => $menu) {
	$t_menus[$menu['id']] = $menu;
}
unset($menus);

foreach ($t_menus as $key => $menu) {
	$t_menuKeys[$menu['parentid']][$key] = $key;
}
$topmenus = $t_menuKeys[0];

$patharray = array(
	'modules' => $this->getModule()->getId(),
	'controller' => $this->getId(),
	'action' => $this->action->getId()
);
$current_menuid=0;
foreach ($t_menus as $key => $val) {
    $parentid = $val['parentid'];
    $mid = $val['id'];
    $t=array(
        'modules' =>$val['modules'],
    	'controller' => $val['controller'],
    	'action' => $val['action']
    );
    
    if(!array_diff_assoc($t,$patharray)){
        $current_menuid = $mid;
        //break;
    }
}
//print_r($t_menus);
$parentid = -1;
$bread = array();
$breadcrumb = array();

if(isset($t_menus[$current_menuid])){
    $parentid = $t_menus[$current_menuid]['parentid'];
    
    $bread[] = array(
        'id'=>$current_menuid,
        'name'=>$t_menus[$current_menuid]['name'],
        'path'=>array(
            'modules' => $t_menus[$current_menuid]['modules'],
			'controller' => $t_menus[$current_menuid]['controller'],
			'action' => $t_menus[$current_menuid]['action']
        )
    );
    while($parentid>0){
        if(isset($t_menus[$parentid])){
            array_splice($bread,0,0,array(array(
                'id'=>$parentid,
                'name'=>$t_menus[$parentid]['name'],
                'path'=>array(
                    'modules' => $t_menus[$parentid]['modules'],
    				'controller' => $t_menus[$parentid]['controller'],
    				'action' => $t_menus[$parentid]['action']
                )
            )));
            $parentid = $t_menus[$parentid]['parentid'];
        }
    }
    $breadcrumb = $bread;
}
if(!$breadcrumb){
    $breadcrumb[0] = array(
        'id'=>1,
    );
}

?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8"/>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <!-- Le styles -->
    <link href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-cerulean.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-app.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/jquery-ui-1.8.21.custom.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/jquery.cleditor.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/uniform.default.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/chosen.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/global.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/dialog.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/fix.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/form.css" type="text/css" rel="stylesheet"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/html5shiv.js"></script>
    <![endif]-->
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
    <!-- header -->
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="#"><?php echo CHtml::encode(Yii::app()->name); ?></a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
            			<?php
            			foreach ($topmenus as $mid):
            				?>
            				<li class="<?php if ($t_menus[$mid]['id'] == $breadcrumb[0]['id']): ?>active<?php endif; ?>">
            							<a href="<?php echo $this->createUrl('/' . $t_menus[$mid]['modules'] . '/' . $t_menus[$mid]['controller'] . '/' . $t_menus[$mid]['action']); ?>"><?php echo Yii::t('menus',$t_menus[$mid]['name']); ?></a>
            					</li>
            			<?php endforeach; ?>
            		</ul>
                </div>
                <?php $this->renderPartial(SystemHelper::getSystemViewsPath().'/widget/user_drop'); ?>
            </div>
        </div>
    </div>
    <!-- header end -->
    
    <!-- content -->
    <div class="container-fluid">
        <div class="row-fluid">
			<div class="">
				<?php $this->renderPartial(SystemHelper::getSystemViewsPath().'/widget/menu',array('menus'=>$t_menus,'menus_key'=>$t_menuKeys,'breadcrumb'=>$breadcrumb)); ?>
            </div>
			<!-- right content-->
			<div id="content">
				<div>
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
			'tagName'=>'ul',
			'activeLinkTemplate'=>'<li><a href="{url}">{label}</a></li>',
			'inactiveLinkTemplate'=>'<li>{label}</li>',
			'homeLink'=>'<li><a href="'.Yii::app()->createUrl('/management/mydashboard').'">'.Yii::t('system','My dashboard').'</a></li>',
			'separator'=>'<li><span class="divider">/</span></li>',
			'htmlOptions'=>array('class'=>'breadcrumb'),
		)); ?><!-- breadcrumbs -->
	<?php endif?>
				</div>
				<?php echo $content; ?>
			</div>
			<!-- right content end-->
        </div>
    </div>
    <!-- content end-->

    <!-- footer -->
    <footer>
        <p><?php echo CHtml::link ( '中文' , $this->langurl('zh_cn')) . ' | ' . CHtml::link ( 'English' ,$this->langurl('en')) ;?></p>
        <p>© <a href="http://www.sfnt.net" target="_blank">sfnt.net</a> 2013</p>
        <p>Powered by: <a href="http://www.sfnt.net" target="_blank">sfnt.net</a></p>
    </footer>
    <!-- footer end-->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/highcharts.js" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/bootstrap.js" type="text/javascript"></script>
    <!-- <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/jquery.uniform.min.js" type="text/javascript"></script>-->
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/jquery.chosen.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/jquery.form.js" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/lhgdialog/lhgdialog.min.js?skin=default" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/jquery.cleditor.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/common.js" type="text/javascript"></script>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/application.js" type="text/javascript"></script>
</body>
</html>