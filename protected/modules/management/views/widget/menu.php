<!-- left nav-->
<div class="sidebar-nav" id="left-side">
<?php
//print_r($menus_key);
    if(isset($menus_key[$breadcrumb[0]['id']])){
        foreach($menus_key[$breadcrumb[0]['id']] as $key){
            //print_r($breadcrumb[0]);
            //print_r($menus[$key]);
            //if($breadcrumb[0]['id']!=$menus[$key]['parentid']){
            //    continue;
            //}
            $active = '';
            //echo $key.'=='.$breadcrumb[1]['id'].'?'.($key==$breadcrumb[1]['id']);
            if(isset($breadcrumb[1]) && $key==$breadcrumb[1]['id']){
                $active = ' active';
            }
            echo '<div class="block clearfix'.$active.'">';
            $icoClass = '';
            if($menus[$key]['ico']){
                $icoClass = $menus[$key]['ico'];
            }
            $ico = '';
            if($icoClass!=''){
                $ico = '<i class="'.$icoClass.'"></i>';
            }
            if(!$menus[$key]['display']){
                continue;
            }
            //print_r($menus[$key]);
            echo CHtml::link($ico.Yii::t('menus',$menus[$key]['name']),array('/'.$menus[$key]['modules'].'/'.$menus[$key]['controller'].'/'.$menus[$key]['action']),array('class'=>'item'));
            if(isset($menus_key[$key])){
                $havesub = false;
                foreach($menus_key[$key] as $key2){
                    if($menus[$key2]['parentid']==$key){
                        if(!$havesub){
                            echo '<ul class="clearfix sub-items">';
                            $havesub = true;
                        }
                        $icoClass = '';
                        if($menus[$key2]['ico']){
                            $icoClass = $menus[$key2]['ico'];
                        }
                        $ico = '';
                        if($icoClass!=''){
                            $ico = '<i class="'.$icoClass.'"></i>';
                        }
                        if(!$menus[$key2]['display']){
                            continue;
                        }
                        echo '<li>'.CHtml::link($ico.Yii::t('menus',$menus[$key2]['name']),array('/'.$menus[$key2]['modules'].'/'.$menus[$key2]['controller'].'/'.$menus[$key2]['action'])).'</li>';
                    }
                }
                if($havesub){
                    echo '</ul>';
                }
                $havesub = false;
            }
            echo '</div>';
        }
    }
	
?>
</div>
<!-- left nav end-->
