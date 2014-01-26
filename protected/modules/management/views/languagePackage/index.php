<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
$this->breadcrumbs=array(
	Yii::t('menus','Language Packages'),
);
?>

<h2 class="margin-top-18"><?php echo Yii::t('menus','Language Packages');?></h2>
<?php
	if (Yii::app()->manager->hasFlash('success'))
		echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('success').'</div>';
	elseif (Yii::app()->manager->hasFlash('failure'))
		echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button>'.Yii::app()->manager->getFlash('failure').'</div>';
?>
<div class="row-fluid content-box">
    <ul class="nav nav-tabs" id="tabs">
<?php
    $selectedLan = isset($_GET['package'])?$_GET['package']:'';
    if(!$selectedLan){
        $selectedLan = $currentLanguage;
    }
	foreach($languages as $l){
	   echo '<li'.($l==$selectedLan?' class="active"':'').'><a href="'.$this->createUrl('index',array('package'=>$l)).'">'.$l.'</a></li>';
	}
?>
    </ul>
    <div class="table-wrapper">
<?php
	$selectfiles = array();
        
    if(in_array($selectedLan,$languages)){
        $dir = dir($basePath.DIRECTORY_SEPARATOR.$selectedLan);
        while($f=$dir->read()){
            $p=$basePath.DIRECTORY_SEPARATOR.$selectedLan.DIRECTORY_SEPARATOR.$f;
            if((!is_dir($p)) AND ($f!=".") AND ($f!="..")){
                $selectfiles[] = $f;
            }
        }
    }
    $fileList = array();
    $fileList1 = array();
    $fileList2 = array();
    $fileList3 = array();
    foreach($files as $f){
        if(in_array($f,$selectfiles)){
            $fileList1[] = array(
                'file'=>$f,
                'in'=>'both'
            );
        }
        else{
            $fileList2[] = array(
                'file'=>$f,
                'in'=>'base'
            );
        }
    }
    
    foreach($selectfiles as $f){
        if(!in_array($f,$files)){
            $fileList3[] = array(
                'file'=>$f,
                'in'=>'select'
            );
        }
    }
    
    $fileList = array_merge($fileList1,$fileList2,$fileList3);
    $dp = new CArrayDataProvider($fileList,array('keyField'=>false));
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dp,
        'itemView'=>'_view',
        'viewData'=>array(
            'selectedLan'=>$selectedLan,
        ),
        'template'=>'<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="table_0" aria-describedby="table_0" style="margin-bottom: 50px;width:99%;">
                        <thead>
        					<tr role="row">
        						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.Yii::t('files','File Name').'</th>
        						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.Yii::t('files','Package Status').'</th>
        						<th role="columnheader" tabindex="0" aria-controls="table_0" style="">'.Yii::t('system','manage action').'</th>
        					</tr>
        				</thead>
                        <tbody>{items}</tbody>
                    </table>',
    ));
?>
    </div>
</div>
