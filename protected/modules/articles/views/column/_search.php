<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'level'); ?>
		<?php echo $form->textField($model,'level'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rootid'); ?>
		<?php echo $form->textField($model,'rootid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'parentid'); ?>
		<?php echo $form->textField($model,'parentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'template'); ?>
		<?php echo $form->textField($model,'template',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content_template'); ?>
		<?php echo $form->textField($model,'content_template',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'listorder'); ?>
		<?php echo $form->textField($model,'listorder'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publish_status'); ?>
		<?php echo $form->textField($model,'publish_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'with_list'); ?>
		<?php echo $form->textField($model,'with_list'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'creattime'); ?>
		<?php echo $form->textField($model,'creattime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updatetime'); ?>
		<?php echo $form->textField($model,'updatetime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'publishtime'); ?>
		<?php echo $form->textField($model,'publishtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gotourl'); ?>
		<?php echo $form->textField($model,'gotourl',array('size'=>60,'maxlength'=>200)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'need_login'); ?>
		<?php echo $form->textField($model,'need_login'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->