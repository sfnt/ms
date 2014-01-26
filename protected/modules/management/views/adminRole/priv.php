<?php
Yii::app()->clientScript->registerScriptFile($this->module->assetsUrl.'/js/jquery/ztree/jquery.ztree.all-3.2.min.js');
Yii::app()->clientScript->registerCssFile($this->module->assetsUrl.'/js/jquery/ztree/zTreeStyle.css');
$this->breadcrumbs=array(
	Yii::t('menus','Role Management')=>array('index'),
    Yii::t('system','Role rights'),
);
?>
<SCRIPT type="text/javascript">
		<!--
		
		var setting = {
			check: {
				enable: true,
				chkboxType: { "Y" : "ps", "N" : "ps" }
			},
			data: {
				simpleData: {
					enable: true
				}
			}
		};
		
	var zNodes = <?php echo CJSON::encode($menus);?>;

		$(document).ready(function(){
			var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
			$('#form1').submit(function() {
				nodes = treeObj.getCheckedNodes(true);
				if(nodes.length>0) {
					menus = {"menu_id": []};
					$.each( nodes, function(i, n){
						menus.menu_id[i] = n.id;
					});
					$.post("<?php echo Yii::app()->getRequest()->getUrl();?>", menus,
					   function(data){
							if(!data.status) 
								alert(data.info);
							else if(data.status) {
								alert(data.info);
								window.location.href = '<?php echo $this->createUrl('index');?>';
							}
					   },"json");
				} else {
					alert('<?php echo Yii::t('system','Please select some rights.');?>');
				}
				return false;
			});
			$('#btn-save').click(function(){
                $("#form1").submit();
            });
		});
		//-->
	</SCRIPT>
    <style>
	ul.ztree {
    
 
    height: 360px;
   
    overflow-x: auto;
    overflow-y: scroll;
    
}
	</style>
<h2 class="margin-top-18"><?php echo Yii::t('system','Role rights');?></h2>
<div class="row-fluid content-box">
    <form name="form1" method="post" action="<?php echo $this->createUrl('priv');?>" id="form1">
        <div class="zTreeDemoBackground left">
    		<ul id="treeDemo" class="ztree"></ul>
    	</div>
        <?php echo CHtml::button(Yii::t('system','Save'), array('class'=>'btn btn-primary','id'=>'btn-save')); ?>
        <?php echo CHtml::link('<i class="icon-arrow-left"></i>'.Yii::t('system','Return'), array('index'),array('class'=>'btn')); ?>
    </form>
</div>