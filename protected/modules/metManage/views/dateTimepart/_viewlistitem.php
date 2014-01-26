<?php
	if(!isset($ajax)){
?>
<tr id="part-<?php echo $data->id;?>">
<?php
	}
?>
    <td class="center"><?php echo CHtml::encode($data->partname); ?></td>
    <td class="center"><?php echo CHtml::encode($data->room->name); ?></td>
    <td class="center"><?php 
    echo CHtml::encode(str_replace($data->day->date_day.' ','',date('Y-m-d H:i:s',$data->starttime))); 
    ?> -- <?php 
    echo CHtml::encode(str_replace($data->day->date_day.' ','',date('Y-m-d H:i:s',$data->endtime))); 
    ?></td>
    <td class="center">
        <?php 
            echo CHtml::link('<i class="icon-edit icon-white"></i>'.Yii::t('system','modify'), array('update', 'id'=>$data->id),array('class'=>'btn btn-info')).'&nbsp;';
            echo CHtml::ajaxLink(
                    '<i class="icon-list-alt icon-white"></i>'.Yii::t('system','delete'), 
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
                        'beforeSend' => "function( request )
                         {
                           return confirm('您确定要删除吗？删除不可恢复。');
                         }",
                    ),
                    array('class'=>'btn btn-danger del')).'&nbsp;'; 
		?>
	</td>
<?php
	if(!isset($ajax)){
?>
</tr>
<?php
	}
?>