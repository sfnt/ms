<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-role-form',
	'enableAjaxValidation'=>true,
)); ?>
<table width="100%" class="table_form table">
      <tbody>
	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'name'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'name'); ?>
        </div>
        </td>
	</tr>

	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'description'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
        </div>
        </td>
	</tr>

	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'disabled'); ?>
        </th>
        <td >
        <div class="row">
		
		<?php echo $form->radioButtonList($model,'disabled', EnumHelper::IsDisplay(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?>
		<?php echo $form->error($model,'disabled'); ?>
        </div>
        </td>
	</tr>

</tbody>
      <tfoot>
        <tr class="title">
          <td colspan="2">
          <?php echo CHtml::submitButton(($model->isNewRecord ? Yii::t('system','Submit') : Yii::t('system','Save')), array('class'=>'btn btn-primary')); ?>
          <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
          
        </tr>
      </tfoot>
    </table>
	

<?php $this->endWidget(); ?>

</div>