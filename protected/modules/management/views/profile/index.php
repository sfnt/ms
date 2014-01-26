<!-- right content-->
<?php
	Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
    $this->breadcrumbs=array(
    	Yii::t('system','profile'),
    );

?>
<h2 class="margin-top-18"><?php echo Yii::t('system','profile');?></h2>
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
            <?php echo $form->labelEx($model,'username',array('class'=>'control-label')); ?>
            <div class="controls">
                <div style="margin-top: 5px;"><?php echo $model->username; ?></div>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'realname',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'realname',array('class'=>'width200','size'=>50,'maxlength'=>50)); ?>
            </div>
            <div class="controls"><span style="color: red;"><?php echo $form->error($model,'realname'); ?></span></div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'email',array('class'=>'width200','size'=>50,'maxlength'=>50)); ?>
            </div>
            <div class="controls"><span style="color: red;"><?php echo $form->error($model,'email'); ?></span></div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'phone',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'phone',array('class'=>'width200','size'=>50,'maxlength'=>50)); ?>
            </div>
            <div class="controls"><span style="color: red;"><?php echo $form->error($model,'phone'); ?></span></div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'mobilephone',array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'mobilephone',array('class'=>'width200','size'=>50,'maxlength'=>50)); ?>
            </div>
            <div class="controls"><span style="color: red;"><?php echo $form->error($model,'mobilephone'); ?></span></div>
        </div>
        <div class="form-actions">
            <?php echo CHtml::submitButton(Yii::t('system','Save'), array('class'=>'btn btn-primary')); ?>
        </div>
    </fieldset>
</form>
<?php $this->endWidget(); ?>
</div>
<!-- right content end-->