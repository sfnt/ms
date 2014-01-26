<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-user-form',
	'enableAjaxValidation'=>true,
)); ?>
<table width="100%" class="table_form table">
      <tbody>
	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'username'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'username'); ?>
        </div>
        </td>
	</tr>

	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'newPassword'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->passwordField($model,'newPassword',array('size'=>40,'maxlength'=>40,'value'=>'', 'autocomplete'=>"off")); ?>
			
		<?php echo $form->error($model,'newPassword'); ?>
        </div>
        </td>
	</tr>
    <tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'repeatPassword'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->passwordField($model,'repeatPassword',array('size'=>40,'maxlength'=>40,'value'=>'', 'autocomplete'=>"off")); ?>
			
		<?php echo $form->error($model,'repeatPassword'); ?>
        </div>
        </td>
	</tr>

	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'realname'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->textField($model,'realname',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'realname'); ?>
        </div>
        </td>
	</tr>

	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'role_id'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->dropDownList($model,'role_id',  AdminRole::getDataList(), array('prompt'=>'')); ?>
		<?php echo $form->error($model,'role_id'); ?>
        </div>
        </td>
	</tr>
    
    <tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'email'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'email'); ?>
        </div>
        </td>
	</tr>
    
    <tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'phone'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
        </div>
        </td>
	</tr>
    
    <tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'mobilephone'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->textField($model,'mobilephone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'mobilephone'); ?>
        </div>
        </td>
	</tr>
    
	<tr>
          <th width="100" align="right">
		<?php echo $form->labelEx($model,'status'); ?>
        </th>
        <td >
        <div class="row">
		<?php echo $form->radioButtonList($model,'status', EnumHelper::IsDisabled(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?>
		<?php echo $form->error($model,'status'); ?>
        </div>
        </td>
	</tr>

	

</tbody>
      <tfoot>
        <tr class="title">
          <td colspan="2">
          <?php echo CHtml::submitButton(($model->isNewRecord ? Yii::t('system','Submit') : Yii::t('system','Save')), array('class'=>'btn btn-primary')); ?>
          <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
          </td>
        </tr>
      </tfoot>
    </table>
	

<?php $this->endWidget(); ?>

</div>