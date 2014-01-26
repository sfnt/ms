<?php
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/jquery-ui-timepicker-addon.js',CClientScript::POS_END);

if (Yii::app()->manager->hasFlash('success'))
	echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
elseif (Yii::app()->manager->hasFlash('failure'))
	echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'datetime-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
<fieldset>
	<?php 
        echo $form->errorSummary($model);
        echo $form->hiddenField($model,'dayid');
        echo $form->hiddenField($model,'creatorid');
        echo $form->hiddenField($model,'creattime');
        echo $form->hiddenField($model,'starttime');
        echo $form->hiddenField($model,'endtime');
    ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'dayid',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $model->day->date_day; ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'partname',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'partname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'partname'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'roomid',array('class'=>'control-label')); ?>
		<div class="controls radiobuttonlist">
		<?php echo $form->dropDownList($model,'roomid',MetRoom::getDataList());?>
		<?php echo $form->error($model,'roomid'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'start',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'start',array('size'=>50,'maxlength'=>50,'id'=>'pickstart')); ?>
		<?php echo $form->error($model,'start'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'end',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'end',array('size'=>50,'maxlength'=>50,'id'=>'pickend')); ?>
		<?php echo $form->error($model,'end'); ?>
		</div>
	</div>
	<div class="form-actions">
		<?php echo CHtml::submitButton(($model->isNewRecord ? Yii::t('system','Submit') : Yii::t('system','Save')), array('class'=>'btn btn-primary')); ?>
        <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
	</div>
</fieldset>
<?php 
$this->endWidget(); 
$fstime = date('Y/m/d',strtotime($model->day->date_day)-24*3600);
$fetime = date('Y/m/d',strtotime($model->day->date_day)+24*3600);
?>
<script type="text/javascript">
<!--
	$(function() {
        $( "#pickstart" ).datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss',
            minDate : new Date('<?php echo $fstime;?>'),
            maxDate : new Date('<?php echo $fetime;?>')
        });
        
        $( "#pickend" ).datetimepicker({
            dateFormat: 'yy-mm-dd',
            timeFormat: 'HH:mm:ss',
            minDate : new Date('<?php echo $fstime;?>'),
            maxDate : new Date('<?php echo $fetime;?>')
        });
        
    });
-->
</script>