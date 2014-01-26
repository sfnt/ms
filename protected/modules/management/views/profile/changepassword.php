<!-- right content-->
<?php
	Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
    $this->breadcrumbs=array(
    	Yii::t('system','modify password'),
    );
?>
<h2 class="margin-top-18"><?php echo Yii::t('system','modify password');?></h2>
<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<div class="row-fluid content-box">
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'manager-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'form-horizontal')
));
CHtml::$afterRequiredLabel = '';

?>	
    <fieldset>
        <div class="control-group">
            <?php echo $form->labelEx($model,'oldPassword',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model,'oldPassword',array('class'=>'width200','size'=>50,'maxlength'=>50)); ?>
            </div>
            <div class="controls"><span style="color: red;"><?php echo $form->error($model,'oldPassword'); ?></span></div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'newPassword',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model,'newPassword',array('class'=>'width200','size'=>50,'maxlength'=>50)); ?>
            </div>
            <div class="controls"><span style="color: red;"><?php echo $form->error($model,'newPassword'); ?></span></div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'repeatPassword',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->passwordField($model,'repeatPassword',array('class'=>'width200','size'=>50,'maxlength'=>50)); ?>
            </div>
            <div class="controls"><span style="color: red;"><?php echo $form->error($model,'repeatPassword'); ?></span></div>
        </div>
        <div class="form-actions">
            <?php echo CHtml::submitButton(Yii::t('system','Save'), array('class'=>'btn btn-primary')); ?>
        </div>
    </fieldset>
</form>
<?php $this->endWidget(); ?>
</div>
<!-- right content end-->