<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
$this->breadcrumbs=array(
	Yii::t('menus','Category'),
);
?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Category');?></h2>
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
                    <div><?php echo CHtml::link('<i class="icon-plus icon-white"></i>'.Yii::t('menus','Create Category'), array('create'),array('class'=>'btn btn-success')); ?><hr style="width:99%;" /></div>
                </div>
			</div>
		</div>
<script language="javascript">
$(document).ready(function(){
$('.btn-del').click(function(){
		affirm = confirm("<?php echo Yii::t('system','Are you sure to delete this data?');?>");
		if(affirm) {
			$.ajax({
				url:$(this).attr('href'),
				type: 'post',
				dataType : 'json',
				success:function(data){
					if(data.status) {
                        alert(data.info);
						window.location.reload()
					} else {
						alert(data.info);
					}
	  			},
				
				error: function(XMLHttpRequest, textStatus, errorThrown){
					alert(XMLHttpRequest.responseText);
				}
			});
		}
		return false;
	});
	$("#form1").submit(function() {
		$this = $(this);
		
  		var formdata = $(this).formSerialize();
		
		$.post('<?php echo $this->createUrl('listorder');?>', formdata,function(data){
			if(!data.status) 
				alert(data.info);
			else if(data.status) {
                alert(data.info);
				window.location.reload();
			}
		 },"json");
		 return false;
	});
    $('#btn-set-order').click(function(){
        $("#form1").submit();
    });
});
</script>
<form action="<?php echo $this->createUrl('listorder');?>" method="post" name="form1" id="form1">
  <table width="100%" class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
    <thead>
      <tr>
        <th style="text-align:center;width:80px; "><?php echo Yii::t('system','order');?></th>
        <th style="min-width: 300px;"><?php echo Yii::t('articles','Category name');?></th>
        <th><?php echo Yii::t('articles','Template');?></th>
        <th><?php echo Yii::t('articles','Content template');?></th>
        <th style="text-align:center;width:40px;"><?php echo Yii::t('system','display');?></th>
        <th><?php echo Yii::t('system','manage action');?></th>
      </tr>
    </thead>
    <tbody>
      <?php echo $menuTree;?>
    </tbody>
    <tfoot>
      <tr>
        <th style="padding:5px" colspan="4">
        <?php echo CHtml::button(Yii::t('system','Set order'), array('class'=>'btn btn-primary','id'=>'btn-set-order')); ?>
        </th>
      </tr>
    </tfoot>
  </table>
</form>
</div>
</div>