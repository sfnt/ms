<?php
$this->breadcrumbs=array(
	Yii::t('menus','Language Packages')=>array('index'),
	Yii::t('menus','Modify Language Package'),
);

?>
<h2 class="margin-top-18"><?php echo Yii::t('menus','Modify Language Package');?> <?php echo $selectedLan;?> - <?php echo $file;?></h2>
<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<div class="row-fluid content-box">
<?php 

$content = array();
$content1 = array();
$content2 = array();
$content3 = array();
foreach($baseContent as $k=>$v){
    if(isset($fileContent[$k])){
        $content1[$k]=array('text'=>$fileContent[$k],'in'=>'both');
    }
    else{
        $content2[$k]=array('text'=>$v,'in'=>'base');
    }
}
foreach($fileContent as $k=>$v){
    if(!isset($baseContent[$k])){
        $content3[$k]=array('text'=>$v,'in'=>'select');
    }
}

$content = array_merge_recursive($content1,$content2,$content3);
//print_r($content);exit();

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'package-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>
    <table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="table_0" aria-describedby="table_0" style="margin-bottom: 50px;width:99%;">
        <thead>
    		<tr role="row">
    			<th role="columnheader" tabindex="0" aria-controls="table_0" style="width:50%"><? echo Yii::t('files','Source');?></th>
    			<th role="columnheader" tabindex="0" aria-controls="table_0" style="width:50%"><? echo Yii::t('files','Translate');?></th>
    		</tr>
    	</thead>
        <tbody>
<?php
	foreach($content as $key=>$value){
	   if($value['in']=='both'){
	       echo '<tr>';
	   }
	   else if($value['in']=='base'){
	       echo '<tr class="error">';
	   }
       else if($value['in']=='select'){
	       echo '<tr class="warning">';
	   }
       echo '<td>'.$key.'</td>';
       echo '<td>'.CHtml::textField('trans['.$key.']',$value['text'],array('style'=>'width:99%')).'</td>';
       echo '</tr>';
	}
?>
            <tr>
                <td colspan="2">
        <?php echo CHtml::submitButton(Yii::t('system','Save'), array('class'=>'btn btn-primary')); ?>
        <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index','package'=>$selectedLan),array('class'=>'btn')); ?>
                </td>
            </tr>
        </tbody>
    </table>
</fieldset>
<?php $this->endWidget(); ?>