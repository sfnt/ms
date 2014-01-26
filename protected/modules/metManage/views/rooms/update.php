<?php
$this->breadcrumbs=array(
	Yii::t('menus','Meeting Rooms')=>array('index'),
	Yii::t('menus','Modify Meeting Room'),
);

?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Modify Meeting Room');?></h2>
<div class="row-fluid content-box"><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>