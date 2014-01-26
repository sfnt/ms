<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<title><?php echo CHtml::encode(Yii::app()->name);?></title>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/mg/css/moneygod.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/mg/css/new_header.css" rel="stylesheet" media="screen" type="text/css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/mg/css/new_foot.css" rel="stylesheet" media="screen" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/mg/js/jquery-1.8.2.min.js"></script>
</head>
<body>
<!-- header -->
<script type="text/javascript">
$().ready(
	function(){
		$('#home-btn img').mouseover(
			function(){
				$('#home-btn img').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/mg/images/new/home_selected.gif');
			}
		);
		$('#home-btn img').mouseout(
			function(){
				$('#home-btn img').attr('src','<?php echo Yii::app()->request->baseUrl; ?>/mg/images/new/home_<?php echo (isset($this->params['rootColumnId'])?'unselected':'selected');?>.gif');
			}
		);
		$('.main-nav li').hover(
			function(){
				$(this).addClass('over');
			},
			function(){
				$(this).removeClass('over');
			}
		);
		$('.subnav').hover(
			function(){
				$('.subnav').css('display','none');
				$(this).css('display','block');
			},
			function(){
				//$(this).css('display','none');
				show_current_child_nemu();
			}
		);
		$('.subnav li').hover(
			function(){
				$(this).addClass('over');
			},
			function(){
				$(this).removeClass('over');
			}
		);
		show_current_child_nemu();
		$('#sub_nav_li'+_subnav_subid).addClass('current');
	}
);
var _subnav_topid = 0;
var _subnav_subid = 0;
_subnav_subid = <?php 
if(isset($this->params['columnid'])){echo $this->params['columnid']; }else{echo 0;};
?>;
_subnav_subid = parseInt(_subnav_subid);
if(!_subnav_subid)_subnav_subid=0;
function show_current_child_nemu(){
	$('.subnav').css('display','none');
	if($($('#sub_nav_column'+_subnav_topid).children()[0]).children().length>0){
		$('#sub_nav_column'+_subnav_topid).css('display','block');
		$('#sec_nav').css('position','relative');
	}
	
}
</script>
<div class="centerDiv" style="height:90px;background:url(<?php echo Yii::app()->request->baseUrl; ?>/mg/images/new/top2.jpg) top center no-repeat;">
     <div>
        <div style="float:right; ; text-align:right;">
        </div>
    </div> 
</div>
<div class="centerDiv main-nav">
    <div style="float:left; padding:0 10px 0 0;">
    	<ul class="h-ul" id="top_nav_ul">
			<li style="margin: -5px 1px -1px; width: 50px; background: none; border: none;"><a href="<?php echo $this->createUrl('index');?>" id="home-btn" title="首頁">
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/mg/images/new/home_<?php echo (isset($this->params['rootColumnId'])?'unselected':'selected');?>.gif" alt="首頁" border="0">
			</a></li>
<?php

$menus = Column::getArrayTree();
$breadcrumbMenus = array();
if(isset($this->params['columnid'])){
    $breadcrumbMenus = Column::getParentArr($this->params['columnid']);
}

foreach($menus as $r){
    if(!$r['publish_status']){
        continue;
    }
    if(isset($this->params['rootColumnId']) && $this->params['rootColumnId']==$r['id']){
        echo '<li class="top_navItem current">';
        echo "<script type='text/javascript'>_subnav_topid={$r['id']};</script>";
    }
    else{
        echo '<li class="top_navItem">';
    }
    echo CHtml::link($r['name'],array('/moneygod/category','id'=>$r['id']),array('id'=>'nav_column'.$r['id']));
    echo '</li>';
}
?>
        </ul>
    </div>
</div>
<script type="text/javascript">
<!--
	var nav_width_count = parseInt(928/$('.top_navItem').length-4);
	$('.top_navItem').css('width',nav_width_count);
//-->
</script>
<div class="centerDiv">
	<div class="centerDiv" style="height:24px; position:absolute;" id="sec_nav">
<?php
	foreach($menus as $r){
        if(!$r['publish_status']){
            continue;
        }
        if(isset($r['child']) && $r['child']){
            echo '<div class="subnav" id="sub_nav_column'.$r['id'].'"><ul class="h-ul">';
            foreach($r['child'] as $rr){
                if(!$rr['publish_status']){
                    continue;
                }
                if(isset($rr['child'])){
                    unset($rr['child']);
                }
                echo '<li id="sub_nav_li'.$rr['id'].'"'.(in_array($rr,$breadcrumbMenus)?" class='current'":'').'>';
                echo CHtml::link($rr['name'],array('/moneygod/category','id'=>$rr['id']));
                echo '</li>';
            }
            echo '</ul></div>';
            ?>
        <script type="text/javascript">
		<!--
			$().ready(
				function(){
					$('#nav_column<?php echo $r['id'];?>').hover(
						function(){
							$('.subnav').css('display','none');
							if($($('#sub_nav_column<?php echo $r['id'];?>').children()[0]).children().length>0)
								$('#sub_nav_column<?php echo $r['id'];?>').css('display','block');
						},
						function(){
							
							show_current_child_nemu();
						}
					);
				}
			);
		//-->
		</script>
            <?php
        }
    }
?>

	</div>

</div>

<!-- /header -->
<div class="wrapper centerDiv">
<?php echo $content; ?>
</div>
<!-- footer -->
<div style="clear:both;"></div>
<div class="centerDiv centerText footer_box">
    <div style="padding:15px; margin-bottom:15px; border-bottom:2px solid #d6d1cd;">
    	
    </div>
    
    <div>
    	本網站的文章資料，非經作者書面授權，禁止任意使用。
    </div>
    <hr class="footer_hr"/>
    <div class="footer_copy">
    	Copyright &copy; <a href="http://www.moneygod.net/"><?php echo CHtml::encode(Yii::app()->name);?></a> All rights reserved. 
    </div>
</div>

<!-- /footer -->

</body>
</html>