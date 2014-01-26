<?php
$this->breadcrumbs=array(
	Yii::t('menus','Category')=>array('index'),
	Yii::t('menus','Create Category'),
);

?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Create Category');?></h2>
<div class="row-fluid content-box">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>