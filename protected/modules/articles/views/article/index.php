<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
$this->breadcrumbs=array(
	Yii::t('menus','Article Management'),
);
?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Article Management');?></h2>
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
                    <div>
                    <?php echo CHtml::link('<i class="icon-plus icon-white"></i>'.Yii::t('menus','Create Article'), array('create'),array('class'=>'btn btn-success')); ?>
                    <hr style="width:99%;" />
                    </div>
                    <select style="padding: 3px;margin: 3px;line-height: 28px;" id="selectCategory">
                        <?php echo Column::getSelectTree(Yii::t('articles','All categories'));?>
                    </select>
                </div>
			</div>
		</div>
        <?php 
             $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'_view',
            'ajaxUpdate'=>true,
            'template'=>'<div style="width:99%;">{summary}</div><table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="table_0" aria-describedby="table_0" style="margin-bottom: 50px;width:99%;">
                            <thead>
            					<tr role="row">
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="width:60px;">'.CHtml::encode($model->getAttributeLabel('id')).'</th>
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('columnid')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('title')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('publishtime')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('adminid')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('updatetime')).'</th>
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('status')).'</th>
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.Yii::t('system','manage action').'</th>
            					</tr>
            				</thead>
                            <tbody>{items}</tbody>
                        </table><div class="pagination pagination-centered">{pager}</div>',
            'pagerCssClass'=>'',//定义pager的div容器的class
            'summaryText'=>Yii::t('list','Total {count}, display {start}-{end}'),
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
        $('#selectCategory').change(function(){
	       var url = '<?php echo $this->createUrl('index',array('column'=>'___'));?>';
           url = url.replace('___',$('#selectCategory').val());
	       location.href = url;
        });
<?php
	if(isset($_GET['column'])){
	   echo "$('#selectCategory').val('".$_GET['column']."');";
	}
?>
	});
-->
</script>