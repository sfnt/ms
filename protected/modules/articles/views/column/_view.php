<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('level')); ?>:</b>
	<?php echo CHtml::encode($data->level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rootid')); ?>:</b>
	<?php echo CHtml::encode($data->rootid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parentid')); ?>:</b>
	<?php echo CHtml::encode($data->parentid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('template')); ?>:</b>
	<?php echo CHtml::encode($data->template); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content_template')); ?>:</b>
	<?php echo CHtml::encode($data->content_template); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('listorder')); ?>:</b>
	<?php echo CHtml::encode($data->listorder); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publish_status')); ?>:</b>
	<?php echo CHtml::encode($data->publish_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('with_list')); ?>:</b>
	<?php echo CHtml::encode($data->with_list); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creattime')); ?>:</b>
	<?php echo CHtml::encode($data->creattime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('updatetime')); ?>:</b>
	<?php echo CHtml::encode($data->updatetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('publishtime')); ?>:</b>
	<?php echo CHtml::encode($data->publishtime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('gotourl')); ?>:</b>
	<?php echo CHtml::encode($data->gotourl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('need_login')); ?>:</b>
	<?php echo CHtml::encode($data->need_login); ?>
	<br />

	*/ ?>

</div>