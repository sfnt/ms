<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
$this->breadcrumbs=array(
	Yii::t('menus','Meeting Time Periods'),
);
?>
<h2 class="margin-top-18"><?php echo Yii::t('menus','Meeting Time Periods');?></h2>
<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<div class="row-fluid content-box">
    <div class="table-wrapper">
        <div class="row-fluid">
			<div class="span12">
                <div class="dataTables_filter">
<?php
    $planid = isset($_GET['plan'])?$_GET['plan']:'';
    $plans = array(''=>Yii::t('meeting','All Plans'));
    foreach(MetMeetingPlan::getDataList() as $k=>$v){
        $plans[$k]=$v;
    }
	echo CHtml::dropDownList('selectPlan',$planid,$plans,array('id'=>'selectPlan'));
?>
                </div>
			</div>
		</div>
        <?php 
             $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$model->search(),
            'itemView'=>'_view',
            'ajaxUpdate'=>true,
            'template'=>'<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="table_0" aria-describedby="table_0" style="margin-bottom: 50px;width:99%;">
                            <thead>
            					<tr role="row">
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('meetingid')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('date_day')).'</th>
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.Yii::t('system','manage action').'</th>
            					</tr>
            				</thead>
                            <tbody>{items}</tbody>
                        </table><div class="pagination pagination-centered">{pager}</div>',
            'pagerCssClass'=>'',//定义pager的div容器的class
            'pager'=>array(
                'class'=>'CLinkPager',
                'firstPageLabel'=>Yii::t('list','First'),//定义首页按钮的显示文字
                'lastPageLabel'=>Yii::t('list','Last'),//定义末页按钮的显示文字
                'nextPageLabel'=>Yii::t('list','Next'),//定义下一页按钮的显示文字
                'prevPageLabel'=>Yii::t('list','Prev'),//定义上一页按钮的显示文字
				'header'=>'',
            ),
        ));
        ?>
    </div>
</div>
<script type="text/javascript">
<!--
    $(document).ready(function(){
        $('.del').click(function(){return confirm('<?php echo Yii::t('system','Are you sure to delete this data?');?>');});
	});
    $('#selectPlan').change(function(){
	       var url = '<?php echo $this->createUrl('index',array('plan'=>'___'));?>';
           url = url.replace('___',$('#selectPlan').val());
	       location.href = url;
        });
<?php
	if(isset($_GET['plan'])){
	   echo "$('#selectPlan').val('".$_GET['plan']."');";
	}
?>
-->
</script>