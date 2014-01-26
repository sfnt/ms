<?php
    if(isset($data->timeParts)){
        $parts = $data->timeParts;
        $partArr = array();
        foreach($parts as $p){
            $partArr[$p->id] = $p;
        }
        if($partArr){
            echo '<tr id="list-'.$data->id.'"><td colspan="3">';
            $dp = new CArrayDataProvider($partArr,array( 'keyField'=>'id'));
            
            $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dp,
                'itemView'=>'_viewlistitem',
                'ajaxUpdate'=>false,
                'emptyText'=>'',
                'template'=>'<table class="table table-striped table-bordered bootstrap-datatable datatable dataTable" id="table_'.$data->id.'" aria-describedby="table_'.$data->id.'" style="margin-bottom: 50px;width:99%;">
                                <tbody>{items}</tbody>
                            </table>',
            ));
            
            echo '</td></tr>';
        }
    }
?>