<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'dateDay-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
<fieldset>
	<?php 
        echo $form->errorSummary($model);
        echo $form->hiddenField($model,'creatorid');
        echo $form->hiddenField($model,'createtime');
    ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'date_day',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'date_day',array('size'=>50,'maxlength'=>50,'id'=>'pickday')); ?>
		<?php echo $form->error($model,'date_day'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'meetingid',array('class'=>'control-label')); ?>
		<div class="controls radiobuttonlist">
		<?php echo $form->dropDownList($model,'meetingid',MetMeetingPlan::getDataList());?>
		<?php echo $form->error($model,'meetingid'); ?>
		</div>
	</div>
	<div class="form-actions">
		<?php echo CHtml::submitButton(($model->isNewRecord ? Yii::t('system','Submit') : Yii::t('system','Save')), array('class'=>'btn btn-primary')); ?>
        <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>
<script type="text/javascript">
<!--
	$(function() {
        $( "#pickday" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true
        });
    });
-->
</script>