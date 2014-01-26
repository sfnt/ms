<?php
$this->breadcrumbs=array(
	Yii::t('menus','Menu Management')=>array('index'),
	Yii::t('menus','Create Manager'),
);

$this->menu=array(
);
?>
<h2 class="margin-top-18"><?php echo Yii::t('menus','Create Manager');?></h2>
<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<div class="row-fluid content-box">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>