<?php
$this->breadcrumbs=array(
	Yii::t('menus','Menu Management')=>array('index'),
	Yii::t('menus','Create Role'),
);

$this->menu=array(
);
?>
<h2 class="margin-top-18"><?php echo Yii::t('menus','Create Role');?></h2>
<div class="row-fluid content-box">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>