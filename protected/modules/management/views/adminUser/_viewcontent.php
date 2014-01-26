	<td class="center"><?php echo CHtml::encode($data->id); ?></td>
	<td class="center"><?php echo CHtml::encode($data->username); ?></td>
    <td class="center"><?php echo CHtml::encode($data->realname); ?></td>
    <td class="center"><?php echo CHtml::encode(Yii::t('system',$data->role->name)); ?></td>
    <td class="center"><?php echo CHtml::encode($data->email); ?></td>
    <td class="center"><?php 
        if($data->lastlogintime){
            echo CHtml::encode(date('Y-m-d H:i:s',$data->lastlogintime));
        }
        else{
            echo '-';
        }
    ?></td>
    <td class="center"><?php echo CHtml::encode($data->lastloginip); ?></td>
	<td class="center"><?php $mnumD = EnumHelper::IsDisabled();echo $mnumD[$data->status]; ?></td>
	<td class="center">
        <?php 
            //echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/1.gif" border=0/>', array('priv', 'id'=>$data->id),array('title'=>Yii::t('system','menus'))).'&nbsp;';
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/update.png" border=0/>', array('update', 'id'=>$data->id),array('title'=>Yii::t('system','modify'))).'&nbsp;';
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/delete.png" border=0/>', array('delete', 'id'=>$data->id),array('title'=>Yii::t('system','delete'),'class'=>'del')).'&nbsp;';
		?>
	</td>