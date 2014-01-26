<?php
$this->breadcrumbs=array(
	Yii::t('menus','Meeting Time Periods')=>array('index'),
	Yii::t('menus','Create Time Period'),
);

?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Create Time Period');?></h2>
<div class="row-fluid content-box">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>