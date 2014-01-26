<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");',CClientScript::POS_READY);
$this->breadcrumbs=array(
	Yii::t('menus','System'),
);
?>
<div class="row-fluid">
		<div class="box span12">
			<div class="box-header well" style="cursor: default">
				<h2><i class="icon-info-sign"></i><?php echo Yii::t('system','Welcome');?></h2>
				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<?php
                echo Yii::t('system','Hi, {name}.',array('{name}'=>Yii::app()->manager->name));
                echo '<br /><br />';
                echo Yii::t('system','Today is {date}.',array('{date}'=>date('Y-m-d',time())));
                echo '<br /><br />';
				if (Yii::app()->manager->lastLoginTime==''){
				    echo Yii::t('system','This is your first time login to this system, please click the username one the upper right corner to modify your password and profile.');
                    echo '<br />';
				}
				else
					echo Yii::t('system','The last time you login is : ').date('Y-m-d H:i:s', Yii::app()->manager->lastLoginTime).'。<br /><br />'
				?>
			</div>
		</div>
	</div>