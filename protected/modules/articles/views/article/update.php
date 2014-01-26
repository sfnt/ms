<?php
$this->breadcrumbs=array(
	Yii::t('menus','Article')=>array('index'),
	Yii::t('menus','Modify Article'),
);

?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Modify Article');?></h2>
<div class="row-fluid content-box"><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>