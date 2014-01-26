    <td class="center"><?php 
    if(isset($data->plan)){
        echo CHtml::encode($data->plan->name); 
    }else{
        echo '-';
    }
    ?></td>
    <td class="center"><?php echo CHtml::encode($data->date_day); ?></td>
	<td class="center">
        <?php 
            echo CHtml::link('<i class="icon-plus icon-white"></i>'.Yii::t('meeting','Add Time Period'), array('create', 'dayid'=>$data->id),array('class'=>'btn btn-info')).'&nbsp;';
		?>
	</td>