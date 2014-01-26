<?php
$this->breadcrumbs=array(
	Yii::t('menus','User Management')=>array('index'),
	Yii::t('system','modify password'),
);

?>

<h2 class="margin-top-18"><?php echo Yii::t('system','modify password');?></h2>
<div class="row-fluid content-box">
<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
<fieldset>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'oldPassword',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'oldPassword',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'oldPassword'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'newPassword',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'newPassword',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'newPassword'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'repeatPassword',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->passwordField($model,'repeatPassword',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'repeatPassword'); ?>
		</div>
	</div>
    <div class="form-actions">
		<?php echo CHtml::submitButton(Yii::t('system','Submit'), array('class'=>'btn btn-primary')); ?>
        <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>
</div>