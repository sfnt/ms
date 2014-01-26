<?php 
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/jquery-ui-timepicker-addon.js',CClientScript::POS_END);

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>true,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
<fieldset>
	<?php echo $form->errorSummary($model);
    ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'title'); ?>
		</div>
	</div>
	<div class="control-group formitem">
		<?php echo $form->labelEx($model,'columnid',array('class'=>'control-label')); ?>
        <div class="controls">
		<select name="Article[columnid]" id="Article_columnid">
          <?php echo Column::getSelectTree(Yii::t('articles','Select category'),$model->columnid,'');?>
        </select>
		<?php echo $form->error($model,'columnid'); ?>
        </div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'shorttitle',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'shorttitle',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'shorttitle'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'color',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'color',array('size'=>7,'maxlength'=>7,'id'=>'color','style'=>'width:65px;')); ?>
        <?php echo CHtml::button(Yii::t('articles','Select Color'),array('id'=>'selectColor','class'=>'btn'));?>
		<?php echo $form->error($model,'color'); ?>
		</div>
	</div>
    
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'author',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'author',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'author'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'from',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'from',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'from'); ?>
		</div>
	</div>
    
    <?php echo $form->hiddenField($model,'with_pic'); ?>
    <?php echo $form->hiddenField($model,'title_pic_path'); ?>
    <?php echo $form->hiddenField($model,'posterid'); ?>
    <?php echo $form->hiddenField($model,'adminid'); ?>
    <?php echo $form->hiddenField($model,'status'); ?>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'keywords',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'keywords',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'keywords'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'description',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textArea($model,'description',array('style'=>'width:300px;height:100px;')); ?>
		<?php echo $form->error($model,'description'); ?>
		</div>
	</div>
    
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'flag',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php 
        echo CHtml::checkBox('flag[t]',preg_match("#t#", $model->flag),array('style'=>'vertical-align:baseline;')).Yii::t('articles','Top').'&nbsp';
        echo CHtml::checkBox('flag[h]',preg_match("#h#", $model->flag),array('style'=>'vertical-align:baseline;')).Yii::t('articles','Hot').'&nbsp';
        echo CHtml::checkBox('flag[p]',preg_match("#p#", $model->flag),array('style'=>'vertical-align:baseline;')).Yii::t('articles','Picture').'&nbsp';
        echo CHtml::checkBox('flag[c]',preg_match("#c#", $model->flag),array('style'=>'vertical-align:baseline;')).Yii::t('articles','Commend').'&nbsp';
        echo CHtml::checkBox('flag[b]',preg_match("#b#", $model->flag),array('style'=>'vertical-align:baseline;')).Yii::t('articles','Bold').'&nbsp';
        //echo CHtml::checkBox('flag[j]',preg_match("#j#", $model->flag),array('style'=>'vertical-align:baseline;')).Yii::t('articles','Redirect').'&nbsp';
        echo CHtml::checkBox('flag[s]',preg_match("#s#", $model->flag),array('style'=>'vertical-align:baseline;')).Yii::t('articles','Marquee').'&nbsp';
        
        
        echo $form->hiddenField($model,'flag'); 
        ?>
		<?php echo $form->error($model,'flag'); ?>
		</div>
	</div>
    <div class="control-group formitem">
    <?php echo $form->labelEx($model,'content',array('class'=>'control-label')); ?>
    </div>
	<div class="control-group formitem">
        <div>
		<?php //echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
        <?php 
$this->widget('application.extensions.extckeditor.ExtCKEditor', array(
'model'=>$model,
'attribute'=>'content', // model atribute
'language'=>str_replace('_','-',Yii::app()->language), /* default lang, If not declared the language of the project will be used in case of using multiple languages */
'editorTemplate'=>'full', // Toolbar settings (full, basic, advanced)
'filePath'=>Yii::app()->basePath.'/../'.Yii::app()->params['upload_dir'],
'fileURL'=>Yii::app()->baseUrl.'/'.Yii::app()->params['upload_dir'],
'width'=>'98%',
'height'=>'500px',
));
        ?>

		<?php echo $form->error($model,'content'); ?>
        </div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'filename',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'filename',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'filename'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'is_redirect',array('class'=>'control-label')); ?>
		<div class="controls radiobuttonlist">
		<?php echo $form->radioButtonList($model,'is_redirect', EnumHelper::YesNo(),array('template'=>"<label class=\"radio\">{input}{label}</label>")); ?>
		<?php echo $form->error($model,'is_redirect'); ?>
		</div>
	</div>
    <div class="control-group formitem" id="div_redirecturl">
		<?php echo $form->labelEx($model,'redirecturl',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'redirecturl',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'redirecturl'); ?>
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
		<?php echo $form->labelEx($model,'click_num',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'click_num',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'click_num'); ?>
		</div>
	</div>
    <div class="control-group formitem">
		<?php echo $form->labelEx($model,'money',array('class'=>'control-label')); ?>
		<div class="controls">
		<?php echo $form->textField($model,'money',array('size'=>50,'maxlength'=>50,'class'=>'width150')); ?>
		<?php echo $form->error($model,'money'); ?>
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
        $('#selectColor').click(function(){
            $('#colorTable').modal('show');
        });
        $('[name="Article[is_redirect]"][type="radio"]')
            .change(function(){checkJump();})
            .click(function(){checkJump();});
        checkJump();
    });
    function ColorSel(c, oname)
    {
    	var tobj = $('#'+oname);
		tobj.val(c);
		$('#colorTable').modal('hide');
    	return true;
    } 
    function checkJump(){
        if($('[name="Article[is_redirect]"][type="radio"][value="1"]')[0].checked){
            $('#div_redirecturl').removeClass('hide');
        }
        else{
            $('#div_redirecturl').addClass('hide');
        }
    }
-->
</script>
<div id="colorTable" class="modal hide fade" tabindex="-1" role="dialog">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><?php echo Yii::t('articles','Select Color');?></h3>
    </div>
    <div class="modal-body">
    <p>
        <table width="100" cellpadding="5" style="CURSOR: pointer; border-spacing:3px; border:none;">
          <tr> 
            <td bgcolor="#FF0000" onClick="ColorSel('#FF0000', 'color');" width="20%">&nbsp;</td>
            <td bgcolor="#0000FF" onClick="ColorSel('#0000FF', 'color');" width="20%">&nbsp;</td>
            <td bgcolor="#006600" onClick="ColorSel('#006600', 'color');" width="20%">&nbsp;</td>
            <td bgcolor="#333333" onClick="ColorSel('#333333', 'color');" width="20%">&nbsp;</td>
            <td bgcolor="#FFFF00" onClick="ColorSel('#FFFF00', 'color');" width="20%">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#CC0000" onClick="ColorSel('#CC0000', 'color');">&nbsp;</td>
            <td bgcolor="#0033CC" onClick="ColorSel('#0033CC', 'color');">&nbsp;</td>
            <td bgcolor="#339900" onClick="ColorSel('#339900', 'color');">&nbsp;</td>
            <td bgcolor="#D1DDAA" onClick="ColorSel('#D1DDAA', 'color');">&nbsp;</td>
            <td bgcolor="#FFCC33" onClick="ColorSel('#FFCC33', 'color');">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#990000" onClick="ColorSel('#990000', 'color');">&nbsp;</td>
            <td bgcolor="#000099" onClick="ColorSel('#000099', 'color');">&nbsp;</td>
            <td bgcolor="#33CC00" onClick="ColorSel('#33CC00', 'color');">&nbsp;</td>
            <td bgcolor="#999999" onClick="ColorSel('#999999', 'color');">&nbsp;</td>
            <td bgcolor="#FF6633" onClick="ColorSel('#FF6633', 'color');">&nbsp;</td>
          </tr>
          <tr> 
            <td bgcolor="#660000" onClick="ColorSel('#660000', 'color');">&nbsp;</td>
            <td bgcolor="#330099" onClick="ColorSel('#330099', 'color');">&nbsp;</td>
            <td bgcolor="#66FF00" onClick="ColorSel('#66FF00', 'color');">&nbsp;</td>
            <td bgcolor="#CCCCCC" onClick="ColorSel('#CCCCCC', 'color');">&nbsp;</td>
            <td bgcolor="#FFFFFF" onClick="ColorSel('', 'color');" align="center" style='font-size:9pt'>N</td>
          </tr>
        </table>
    </p>
    </div>
    
</div>