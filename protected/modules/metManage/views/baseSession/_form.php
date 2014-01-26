<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'baseSession-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
<fieldset>
	<?php 
        echo $form->errorSummary($model);
        echo $form->hiddenField($model,'creatorid');
        echo $form->hiddenField($model,'createtime');
        echo $form->hiddenField($model,'updatetime');
    ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'status',array('class'=>'control-label')); ?>
		<div class="controls radiobuttonlist">
		<?php echo $form->radioButtonList($model,'status', EnumHelper::IsDisabled(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?>
		<?php echo $form->error($model,'status'); ?>
		</div>
	</div>
	<div class="form-actions">
		<?php echo CHtml::submitButton(($model->isNewRecord ? Yii::t('system','Submit') : Yii::t('system','Save')), array('class'=>'btn btn-primary')); ?>
        <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>