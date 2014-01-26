	<td class="center"><?php echo CHtml::encode($data->id); ?></td>
    <td class="center"><?php 
    if(isset($data->plan)){
        echo CHtml::encode($data->plan->name); 
    }else{
        echo '-';
    }
    ?></td>
    <td class="center"><?php echo CHtml::encode($data->date_day); ?></td>
    <td class="center"><?php 
    if(isset($data->creator)){
        echo CHtml::encode($data->creator->realname); 
    }else{
        echo '-';
    }
    ?></td>
    <td class="center"><?php 
        if($data->createtime){
            echo CHtml::encode(date('Y-m-d H:i:s',$data->createtime));
        }
        else{
            echo '-';
        }
    ?></td>
	<td class="center">
        <?php 
            //echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/1.gif" border=0/>', array('priv', 'id'=>$data->id),array('title'=>Yii::t('system','menus'))).'&nbsp;';
            echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/update.png" border=0/>', array('update', 'id'=>$data->id),array('title'=>Yii::t('system','modify'))).'&nbsp;';
            echo CHtml::ajaxLink(
                '<img src="'.$this->module->assetsUrl.'/img/ico/action/delete.png" border=0/>', 
                array('delete', 'id'=>$data->id),
                array(
                    'success' => "function( data )
                    {
                        if(data=='ok')
                        {
                            alert('".Yii::t('system','Successfully delete data!')."');
                            $('#item-".$data->id."').remove();
                        }
                        else{
                            alert(data);
                        }
                    }",
                    
                ),
                array('title'=>Yii::t('system','delete'),'class'=>'del')
            ).'&nbsp;';
		?>
	</td>