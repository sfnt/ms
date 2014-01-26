<?php
$this->breadcrumbs=array(
	Yii::t('menus','Menu Management')=>array('index'),
	Yii::t('menus','Create Menu'),
);

$this->menu=array(
	array('label'=>Yii::t('menus','Menu Management'), 'url'=>array('index')),
);
?>
<h2 class="margin-top-18"><?php echo Yii::t('menus','Create Menu');?></h2>
<div class="row-fluid content-box">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>