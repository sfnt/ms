<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<fieldset>
	<?php echo $form->errorSummary($model);
    ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php 
        if($model->isNewRecord){
            echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50));
        }
        else{
            echo $model->username;
        }
        ?>
		<?php echo $form->error($model,'username'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'nickname',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'nickname',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'nickname'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'email'); ?>
		</div>
	</div>
<?php
	if($model->isNewRecord){
?>
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
<?php
	}
?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'title'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'gender',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->dropDownList($model,'gender',EnumHelper::Gender()); ?>
		<?php echo $form->error($model,'gender'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'regtype',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->dropDownList($model,'regtype',EnumHelper::RegType()); ?>
		<?php echo $form->error($model,'regtype'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'status',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->dropDownList($model,'status',EnumHelper::UserStatus()); ?>
		<?php echo $form->error($model,'status'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'regtime',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $model->regtime?date('Y-m-d H:i:s',$model->regtime):'-' ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'lastlogintime',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $model->lastlogintime?date('Y-m-d H:i:s',$model->lastlogintime):'-' ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'regip',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $model->regip?$model->regip:'-' ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'lastloginip',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $model->lastloginip?$model->lastloginip:'-' ?>
		</div>
	</div>
    <?php echo $form->hiddenField($model,'regtime'); ?>
    <?php echo $form->hiddenField($model,'lastlogintime'); ?>
    <?php echo $form->hiddenField($model,'regip'); ?>
    <?php echo $form->hiddenField($model,'lastloginip'); ?>


	<div class="form-actions">
		<?php echo CHtml::submitButton(($model->isNewRecord ? Yii::t('system','Submit') : Yii::t('system','Save')), array('class'=>'btn btn-primary')); ?>
        <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
	</div>
</fieldset>
<?php $this->endWidget(); ?>
