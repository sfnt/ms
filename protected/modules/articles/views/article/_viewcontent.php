	<td class="center"><?php echo CHtml::encode($data->id); ?></td>
	<td class="center"><?php echo CHtml::encode($data->column->name); ?></td>
    <td class="center"><?php echo CHtml::encode($data->title); ?></td>
    <td class="center"><?php 
        if($data->publishtime){
            echo CHtml::encode(date('Y-m-d H:i:s',$data->publishtime));
        }
        else{
            echo '-';
        }
    ?></td>
    <td class="center"><?php 
    if(isset($data->admin) && $data->admin){
        echo CHtml::encode($data->admin->realname);
    }
    else{
        echo '-';
    }
     
    ?></td>
    <td class="center"><?php 
        if($data->updatetime){
            echo CHtml::encode(date('Y-m-d H:i:s',$data->updatetime));
        }
        else{
            echo '-';
        }
    ?></td>
    <td class="center"><?php 
    $astatus = EnumHelper::ArticleStatus();
    echo CHtml::encode($astatus[$data->status]); 
    ?></td>
	<td class="center">
        <?php 
            //echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/1.gif" border=0/>', array('priv', 'id'=>$data->id),array('title'=>Yii::t('system','menus'))).'&nbsp;';
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/update.png" border=0/>', array('update', 'id'=>$data->id),array('title'=>Yii::t('system','modify'))).'&nbsp;';
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/delete.png" border=0/>', array('delete', 'id'=>$data->id),array('title'=>Yii::t('system','delete'),'class'=>'del')).'&nbsp;';
		?>
	</td>