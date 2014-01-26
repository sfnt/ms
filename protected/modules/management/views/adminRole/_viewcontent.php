	<td class="center"><?php echo CHtml::encode($data->id); ?></td>
	<td class="center"><?php echo CHtml::encode(Yii::t('system',$data->name)); ?></td>
	<td class="center"><?php $mnumD = EnumHelper::YesNo();echo $mnumD[$data->disabled]; ?></td>
	<td class="center">
        <?php 
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/1.gif" border=0/>', array('priv', 'id'=>$data->id),array('title'=>Yii::t('system','menus'))).'&nbsp;';
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/update.png" border=0/>', array('update', 'id'=>$data->id),array('title'=>Yii::t('system','modify'))).'&nbsp;';
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/delete.png" border=0/>', array('delete', 'id'=>$data->id),array('title'=>Yii::t('system','delete'))).'&nbsp;';
		?>
	</td>