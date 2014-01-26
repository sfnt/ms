<?php
$this->breadcrumbs=array(
	Yii::t('menus','Meeting Plan')=>array('index'),
	Yii::t('menus','Modify Meeting Plan'),
);

?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Modify Meeting Plan');?></h2>
<div class="row-fluid content-box"><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>