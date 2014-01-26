<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
$this->breadcrumbs=array(
	Yii::t('menus','Manager Management'),
);
?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Manager Management');?></h2>
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
                    <?php echo CHtml::link('<i class="icon-plus icon-white"></i>'.Yii::t('menus','Create Manager'), array('create'),array('class'=>'btn btn-success')); ?>
                    <hr style="width:99%;" />
                    </div>
                    <select style="padding: 3px;margin: 3px;line-height: 28px;" id="selectRole">
                    <option value=""><?php echo Yii::t('system','All roles');?></option>
                    <?php
                        $currentRole = isset($_GET['role'])?$_GET['role']:'';
                        $roles = ManagerCacheHelper::getRoles();
                    	foreach($roles as $k=>$v){
                    	   echo('<option value="'.$k.'"'.(($currentRole == strval($k))?' selected="selected"':'').'>'.$v.'</option>');
                    	}
                    ?>
                    </select>
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
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('username')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('realname')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('role_id')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('email')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('lastlogintime')).'</th>
                                    <th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('lastloginip')).'</th>
            						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.CHtml::encode($model->getAttributeLabel('status')).'</th>
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
	   $('#selectRole').change(function(){
	       var url = '<?php echo $this->createUrl('index',array('role'=>'___'));?>';
           url = url.replace('___',$('#selectRole').val());
	       location.href = url;
	   });
	});
-->
</script>