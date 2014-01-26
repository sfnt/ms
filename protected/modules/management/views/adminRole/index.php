<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
$this->breadcrumbs=array(
	Yii::t('menus','Role Management'),
);
?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Role Management');?></h2>
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
                    <div><?php echo CHtml::link('<i class="icon-plus icon-white"></i>'.Yii::t('menus','Create Role'), array('create'),array('class'=>'btn btn-success')); ?><hr style="width:99%;" /></div>
                </div>
			</div>
		</div>
        <?php 
             $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$model->search(),
            'itemView'=>'_view',
            'template'=>'<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="table_0" aria-describedby="table_0" style="margin-bottom: 50px;width:99%;">
                            <thead>
            					<tr role="row">
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="width:60px;">'.CHtml::encode($model->getAttributeLabel('id')).'</th>
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('name')).'</th>
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('disabled')).'</th>
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
