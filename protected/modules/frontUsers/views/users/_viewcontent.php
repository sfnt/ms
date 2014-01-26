	<td class="center"><?php echo CHtml::encode($data->id); ?></td>
	<td class="center"><?php echo CHtml::encode($data->username); ?></td>
    <td class="center"><?php echo CHtml::encode($data->nickname); ?></td>
    <td class="center"><?php echo CHtml::encode($data->email); ?></td>
    <td class="center"><?php 
        if($data->regtime){
            echo CHtml::encode(date('Y-m-d H:i:s',$data->regtime));
        }
        else{
            echo '-';
        }
    ?></td>
    <td class="center"><?php 
        if($data->lastlogintime){
            echo CHtml::encode(date('Y-m-d H:i:s',$data->lastlogintime));
        }
        else{
            echo '-';
        }
    ?></td>
    <td class="center"><?php echo CHtml::encode($data->lastloginip); ?></td>
    <td class="center"><?php 
    $ustatus = EnumHelper::IsDisabled();
    echo CHtml::encode($ustatus[$data->status]); 
    ?></td>
	<td class="center">
        <?php 
            echo CHtml::link('<i class="icon-edit icon-white"></i>'.Yii::t('system','modify'), array('update', 'id'=>$data->id),array('class'=>'btn btn-info')).'&nbsp;';
            echo CHtml::link('<i class="icon-lock icon-white"></i>'.Yii::t('system','password'), array('changePassword', 'id'=>$data->id),array('class'=>'btn btn-info')).'&nbsp;';
            echo CHtml::link('<i class="icon-trash icon-white"></i>'.Yii::t('system','delete'), array('delete', 'id'=>$data->id),array('class'=>'btn btn-info btn-del')).'&nbsp;';
		?>
	</td>