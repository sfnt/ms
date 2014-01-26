<tr>
    <td class="center"><img src="<?php echo ImageHelper::diskThumb($path.DIRECTORY_SEPARATOR.$data,100,100); ?>" /></td>
	<td class="center"><?php echo CHtml::link($data,array('file','file'=>$data),array('target'=>"_blank")); ?></td>
</tr> 