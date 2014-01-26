<li>
<?php
    $params = array();
    if($data->color){
        $params['style']='color:'.$data->color;
    }
    if($columnid!=$data->columnid){
        //echo '['.$data->column->name.']';
        echo '['.CHtml::link($data->column->name,array('category','id'=>$data->columnid)).'] ';
    }
	echo CHtml::link($data->title,array('article','id'=>$data->id),$params);
    echo ' - <font size="2" color="#808080">'.$data->author.' ('.date('Y-m-d',$data->publishtime).')</font>'
?>
</li>