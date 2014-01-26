<div class="form">
  <?php 
  
  $form=$this->beginWidget('CActiveForm', array(
	'id'=>'admin-menu-form',
	'enableAjaxValidation'=>true,
)); ?>
    <table width="100%" class="table_form table">
      <tbody>
        <tr>
          <th width="100" align="right"><?php echo $form->labelEx($model,'parentid'); ?></th>
          <td><select name="AdminMenu[parentid]" id="AdminMenu_parentid">
      <?php echo AdminMenu::getSelectTree(Yii::t('system','Top menu'),$model->parentid);?>
    </select>
    <?php echo $form->error($model,'parentid'); ?> </td>
        </tr>
        <tr>
          <th width="100" align="right"><?php echo $form->labelEx($model,'name'); ?> </th>
          <td><?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?> <?php echo $form->error($model,'name'); ?> </td>
        </tr>
        <tr>
          <th width="100" align="right"><?php echo $form->labelEx($model,'modules'); ?> </th>
          <td><?php echo $form->textField($model,'modules',array('size'=>50,'maxlength'=>50)); ?> <?php echo $form->error($model,'modules'); ?></td>
        </tr>
        <tr>
          <th width="100" align="right"><?php echo $form->labelEx($model,'controller'); ?> </th>
          <td><?php echo $form->textField($model,'controller',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'controller'); ?></td>
        </tr>
        <tr>
          <th width="100" align="right"><?php echo $form->labelEx($model,'action'); ?></th>
          <td> <?php echo $form->textField($model,'action',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'action'); ?> </td>
        </tr>
        <tr>
          <th align="right"><?php echo $form->labelEx($model,'data'); ?> </th>
          <td><?php echo $form->textField($model,'data',array('size'=>60,'maxlength'=>100)); ?> <?php echo $form->error($model,'data'); ?> </td>
        </tr>
        <tr>
          <th align="right"><?php echo $form->labelEx($model,'ico'); ?></th>
          <td><?php echo $form->textField($model,'ico',array('size'=>20,'maxlength'=>20)); ?> <?php echo $form->error($model,'ico'); ?></td>
        </tr>
        <tr>
          <th align="right"><?php echo $form->labelEx($model,'display'); ?></th>
          <td valign="middle"><?php echo $form->radioButtonList($model,'display', EnumHelper::IsDisplay(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?><?php echo $form->error($model,'display'); ?> </td>
        </tr>
		<?php if($model->isNewRecord):?>
        <tr>
          <th align="right">CRUD</th>
          <td valign="middle"><?php echo CHtml::checkBox('crud', FALSE) ?></td>
        </tr>
		<?php endif;?>
      </tbody>
      <tfoot>
        <tr class="title">
          <td colspan="2"><input type="hidden" value="" name="id">
            <?php echo CHtml::submitButton(($model->isNewRecord ? Yii::t('system','Submit') : Yii::t('system','Save')), array('class'=>'btn btn-primary')); ?>
            
            <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
            </td>
        </tr>
      </tfoot>
    </table>
 
  <?php $this->endWidget(); ?>
</div>
<!-- form -->