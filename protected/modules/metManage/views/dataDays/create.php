<?php
$this->breadcrumbs=array(
	Yii::t('menus','Meeting Date')=>array('index'),
	Yii::t('menus','Create Meeting Date'),
);

?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Create Meeting Date');?></h2>
<div class="row-fluid content-box">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>