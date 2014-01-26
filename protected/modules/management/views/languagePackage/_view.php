<tr>
    <td class="center"><?php echo CHtml::encode($data['file']); ?></td>
	<td class="center"><?php $mnumD = EnumHelper::PackageStatus();echo $mnumD[$data['in']]; ?></td>
	<td class="center">
        <?php 
            echo CHtml::link('<i class="icon-edit icon-white"></i>'.Yii::t('system','modify'), array('update', 'file'=>$data['file'],'selectedLan'=>$selectedLan),array('class'=>'btn btn-info')).'&nbsp;';
            //echo CHtml::link('<img src="'.$this->module->assetsUrl.'/img/ico/action/update.png" border=0/>', array('update', 'file'=>$data['file'],'selectedLan'=>$selectedLan),array('title'=>Yii::t('system','modify'))).'&nbsp;';
		?>
	</td>
</tr>