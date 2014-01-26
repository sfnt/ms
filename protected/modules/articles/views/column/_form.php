<?php 
Yii::app()->clientScript->registerScriptFile($this->module->articleAssetsUrl.'/js/jquery-ui-timepicker-addon.js',CClientScript::POS_END);

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'column-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
<fieldset>
	<?php echo $form->errorSummary($model);
    ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'name',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'name'); ?>
		</div>
	</div>
		<?php echo $form->hiddenField($model,'level'); ?>
        <?php echo $form->hiddenField($model,'rootid'); ?>
	<div class="control-group formitem">
		<?php echo $form->labelEx($model,'parentid',array('class'=>'control-label')); ?>
        <div class="controls">
		<select name="Column[parentid]" id="Column_parentid">
          <?php echo Column::getSelectTree(Yii::t('articles','Root category'),$model->parentid);?>
        </select>
		<?php echo $form->error($model,'parentid'); ?>
        </div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'template',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php //echo $form->textField($model,'template',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
        <?php echo $form->dropDownList($model,'template',EnumHelper::ColumnTemplate()); ?>
		<?php echo $form->error($model,'template'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'content_template',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php //echo $form->textField($model,'content_template',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
        <?php echo $form->dropDownList($model,'content_template',EnumHelper::ContentTemplate()); ?>
		<?php echo $form->error($model,'content_template'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'listorder',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'listorder',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'listorder'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'publish_status',array('class'=>'control-label')); ?>
		<div class="controls radiobuttonlist">
		<?php echo $form->radioButtonList($model,'publish_status', EnumHelper::IsDisplay(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?>
		<?php echo $form->error($model,'publish_status'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'need_login',array('class'=>'control-label')); ?>
		<div class="controls radiobuttonlist">
		<?php echo $form->radioButtonList($model,'need_login', EnumHelper::YesNo(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?>
		<?php echo $form->error($model,'need_login'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'with_list',array('class'=>'control-label')); ?>
		<div class="controls radiobuttonlist">
		<?php echo $form->radioButtonList($model,'with_list', EnumHelper::YesNo(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?>
		<?php echo $form->error($model,'with_list'); ?>
		</div>
	</div>
    <?php echo $form->hiddenField($model,'creattime'); ?>
    <?php echo $form->hiddenField($model,'updatetime'); ?>
    <?php echo $form->hiddenField($model,'publishtime'); ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'publishtime',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php 
            $publishtime_str = '';
            if($model->isNewRecord || !$model->publishtime){
                $publishtime_str = date('Y-m-d H:i:s',time());
            }else{
                $publishtime_str = date('Y-m-d H:i:s',$model->publishtime);
            }
            echo CHtml::textField('publishtime',$publishtime_str,array('size'=>50,'maxlength'=>50,'class'=>'width150','id'=>'publishtime')); 
        ?>
		<?php echo $form->error($model,'publishtime'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'gotourl',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'gotourl',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'gotourl'); ?>
		</div>
	</div>
    <div class="control-group formitem">
    <?php echo $form->labelEx($model,'content',array('class'=>'control-label')); ?>
    </div>
	<div class="control-group formitem">
        <div>
		<?php //echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
        <?php 
        /*
        $this->widget('application.extensions.fckeditor.FCKEditorWidget',array(
            "model"=>$model,                # Data-Model
            "attribute"=>'content',         # Attribute in the Data-Model
            "height"=>'400px',
            "width"=>'100%',
            //"toolbarSet"=>'Basic',          # EXISTING(!) Toolbar (see: fckeditor.js)
            "fckeditor"=>Yii::app()->basePath."/../fckeditor/fckeditor.php",
                                            # Path to fckeditor.php
            "fckBasePath"=>Yii::app()->baseUrl."/fckeditor/",
                                            # Realtive Path to the Editor (from Web-Root)
            "config" => array(
                    //"EditorAreaCSS"=>Yii::app()->baseUrl.'/css/index.css',
                    'DefaultLanguage'=>str_replace('_','-',Yii::app()->language),
                    'AutoDetectLanguage'=>false,
                ),
                                            # Additional Parameter (Can't configure a Toolbar dynamicly)
        ) ); 
        */
$this->widget('application.extensions.extckeditor.ExtCKEditor', array(
'model'=>$model,
'attribute'=>'content', // model atribute
'language'=>str_replace('_','-',Yii::app()->language), /* default lang, If not declared the language of the project will be used in case of using multiple languages */
'editorTemplate'=>'full', // Toolbar settings (full, basic, advanced)
'filePath'=>Yii::app()->basePath.'/../'.Yii::app()->params['upload_dir'],
'fileURL'=>Yii::app()->baseUrl.Yii::app()->params['upload_dir'],
'width'=>'98%',
'height'=>'500px',
));
        ?>

		<?php echo $form->error($model,'content'); ?>
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
        $( "#publishtime" ).datetimepicker({
            dateFormat: 'yy-mm-dd',
        	timeFormat: 'HH:mm:ss',
        });
    });
-->
</script>