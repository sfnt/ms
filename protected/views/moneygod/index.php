<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/mg/css/moneygod.css','screen');
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/mg/css/newindex.css','screen');
?>
<div class="centerDiv">
    <div style="clear: both;">
        <div class="are_a_cen">
			<div class="Menubox">
                <ul class="h-ul">
                    <li id="li_tab_ann" style="display:none;"><a id="tab_menubox_1"><span>當前公告</span></a></li>
                    <li class="over"><a id="tab_menubox_3"><span>熱門文章</span></a></li>
                </ul>
            </div>
			<div>
				<div class="tab_box_content" id="tab_box_1" style="height:552px; position:relative; height:616px; padding-top: 5px;">
					<div style="height:572px; overflow:hidden;" id="current_ann_box">
						<div id="current_ann_box_content">
<?php $this->widget(
'ext.ArcListWidget',
array(
    'columnId'=>6,
    'limit'=>5,
    'length'=>0,
    'showSub'=>true,
    'actionPath'=>'/moneygod/article',
    'categoryPath'=>'/moneygod/category',
    'linkHtmlOptions'=>array('target'=>'_blank'),
    'template'=>'{Items}',
    'itemTemplate'=>'<div class="dot_bottom" style="padding:12px 0;">
	<img align="absmiddle" src="/mg/images/mg/icon_nav.gif" /><b><a href="{Link}" target="_blank">{Title}</a></b> <br />
	{Body}
</div>',
    )
); ?>
						</div>
          			</div>
                </div>
				<script type="text/javascript">
				<!--
					$(document).ready(function() {
						$('#tab_box_1 img').each(function() {
							var maxWidth = 708;
							var ratio = 0;
							var width = $(this).width();
							var height = $(this).height();
							if (width > maxWidth) {
								ratio = maxWidth / width;
								$(this).css("width", maxWidth);
								height = height * ratio;
								$(this).css("height", height);
							}
							
						});
						$('#tab_box_1 embed,#tab_box_1 object,#tab_box_1 iframe').each(function() {
							var maxWidth = 708;
							var minHeight = 300;
							var ratio = 0;
							var width = $(this).attr("width");
							var height = $(this).attr("height");
							if (width > maxWidth) {
								ratio = maxWidth / width;
								$(this).attr("width",maxWidth);
								height = height * ratio;
								if(height<minHeight)height=minHeight;
								$(this).attr("height", height);
							}
							
						});
					});
					///$(document).ready(function() {
					///	if($('#current_ann_box_content').height()>$("#current_ann_box").height())
					///		$("#current_ann_box").niceScroll({touchbehavior:true});
					///});
				//-->
				</script>
				<div class="tab_box_content main-list" id="tab_box_3" style="display:block; height:542px; height:611px;">
<?php $this->widget(
'ext.ArcListWidget',
array(
    'limit'=>2,
    'length'=>0,
    'actionPath'=>'/moneygod/article',
    'categoryPath'=>'/moneygod/category',
    'linkHtmlOptions'=>array('target'=>'_blank'),
    'template'=>'{Items}',
    'picHeight'=>220,
    'picWidth'=>343,
    'flag'=>'p',
    'orderBy'=>'click_num DESC, publishtime DESC',
    'itemTemplate'=>'<div class="list-pic">
	<a target="_blank" href="{Link}" title="{ReTitle}"><img src="{PicPath}" width="{PicWidth}" height="{PicHeight}" border="0" ></a>
	<div class="pic-title">
		<a target="_blank" href="{Link}" title="{ReTitle}">{Title}</a>
	</div>
	<div style="clear:both;"></div>
</div>',
    )
); ?>
<div class="list">
<?php $this->widget(
'ext.ArcListWidget',
array(
    'limit'=>14,
    'offset'=>0,
    'length'=>0,
    'subDay'=>7,
    'orderBy'=>'click_num DESC, publishtime DESC',
    'actionPath'=>'/moneygod/article',
    'categoryPath'=>'/moneygod/category',
    'linkHtmlOptions'=>array('target'=>'_blank'),
    'template'=>'<div style="clear:both;"></div><ul>{Items}</ul><div style="clear:both;"></div></div>',
    'itemTemplate'=>'<li><a href="{Link}" title="{ReTitle}" target="_blank">{Title}</a></li>',
    )
);
$this->widget(
'ext.ArcListWidget',
array(
    'limit'=>14,
    'offset'=>14,
    'length'=>0,
    'subDay'=>7,
    'orderBy'=>'click_num DESC, publishtime DESC',
    'actionPath'=>'/moneygod/article',
    'categoryPath'=>'/moneygod/category',
    'linkHtmlOptions'=>array('target'=>'_blank'),
    'template'=>'<div class="list dot_bottom" style="padding-top:10px;"><ul>{Items}</ul><div style="clear:both;"></div></div>',
    'itemTemplate'=>'<li><a href="{Link}" title="{ReTitle}" target="_blank">{Title}</a></li>',
    )
);
 ?>

                </div>
			</div>
		</div>
        <script type="text/javascript">
		<!--
			//$().ready(
			//	function(){
					$('.Menubox li').click(
						function(){
							$('.Menubox li').removeClass('over');
							$(this).addClass('over');
						}
					);
					
					$('#tab_menubox_1').click(
						function(){
							$('.tab_box_content').css('display','none');
							$('#tab_box_1').css('display','block');
						}
					);
					
					$('#tab_menubox_3').click(
						function(){
							$('.tab_box_content').css('display','none');
							$('#tab_box_3').css('display','block');
						}
					);
					$().ready(function(){
					   var annHtml = $('#current_ann_box_content').html();
                       annHtml = $.trim(annHtml);
                       if(annHtml){
                        $("#li_tab_ann").css("display","block");
                        $('.Menubox li').removeClass('over');
                        $('#li_tab_ann').addClass('over');
                        $('.tab_box_content').css('display','none');
                        $('#tab_box_1').css('display','block');
                       }
                       
					});
			//	}
			//);
		//-->
		</script>
    </div>
    <div class="are_a_right">
        <div class="main-list" style="padding:0px; margin:0px;">
			<div style="padding:5px 5px 0 5px; font-weight: bold; margin-bottom:5px;">最近更新</div>
			<!-- recently publish -->
            <div class="list" style="padding:0;background:transparent;">
                <?php
$this->widget(
'ext.ArcListWidget',
array(
    'limit'=>21,
    'offset'=>0,
    'length'=>16,
    //'subDay'=>7,
    'orderBy'=>'publishtime DESC',
    'actionPath'=>'/moneygod/article',
    'categoryPath'=>'/moneygod/category',
    'linkHtmlOptions'=>array('target'=>'_blank'),
    //'template'=>'<div style="clear:both;"></div><ul>{Items}</ul><div style="clear:both;"></div></div>',
    //'itemTemplate'=>'<li><a href="{Link}" title="{ReTitle}" target="_blank">{Title}</a></li>',
    )
);
?>
			</div>
			<!-- end recently publish -->
        </div>
        <div style="clear:both;"></div>
		<div style="padding:3px 0; background:#d1e3b9; margin-top:10px;" class="centerText">
        	<form onsubmit="return checkSearchForm(this);" action="/articlesearch.php">
           	  <span style="font-size:12px; color:#6B695A; vertical-align:middle;">文章檢索</span>
                <input type="text" onblur="if(this.value==''){this.value='在這裡搜索...';}" onfocus="if(this.value=='在這裡搜索...'){this.value='';}" value="" id="search-keyword" name="q" style="width:100px;">
                <input type="hidden" value="title" name="searchtype">
                <button class="search-submit" type="submit">搜索</button>
            </form>
        </div>
    </div>
</div>
<div>
    <div class="list_box_left">
    	<h1 class="alist-title">
<?php
	$column10 = Column::model()->findByPk(10);
    echo CHtml::link($column10->name,array('/moneygod/category','id'=>$column10->id),array('class'=>'title-link'));
?>
		</h1>
        <div class="alist-content">
			
            <div class="main-list">
            	<div class="list">
					<?php $this->widget(
                        'ext.ArcListWidget',
                        array(
                            'columnId'=>10,
                            'length'=>20,
                            'showSub'=>true,
                            'actionPath'=>'/moneygod/article',
                            'categoryPath'=>'/moneygod/category',
                            'linkHtmlOptions'=>array('target'=>'_blank'),
                            )
                        ); ?>
                    <div class="dot_bottom"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="list_box_left">
    	<h1 class="alist-title">
<?php
	$column11 = Column::model()->findByPk(11);
    echo CHtml::link($column11->name,array('/moneygod/category','id'=>$column11->id),array('class'=>'title-link'));
?>
		</h1>
        <div class="alist-content">
			
            <div class="main-list">
            	<div class="list">
					<?php $this->widget(
                        'ext.ArcListWidget',
                        array(
                            'columnId'=>11,
                            'length'=>20,
                            'showSub'=>true,
                            'actionPath'=>'/moneygod/article',
                            'categoryPath'=>'/moneygod/category',
                            'linkHtmlOptions'=>array('target'=>'_blank'),
                            )
                        ); ?>
                    <div class="dot_bottom"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="list_box_right">
    	<h1 class="alist-title">
<?php
	$column12 = Column::model()->findByPk(12);
    echo CHtml::link($column12->name,array('/moneygod/category','id'=>$column12->id),array('class'=>'title-link'));
?>
		</h1>
        <div class="alist-content">
			
            <div class="main-list">
            	<div class="list">
					<?php $this->widget(
                        'ext.ArcListWidget',
                        array(
                            'columnId'=>12,
                            'length'=>20,
                            'showSub'=>true,
                            'actionPath'=>'/moneygod/article',
                            'categoryPath'=>'/moneygod/category',
                            'linkHtmlOptions'=>array('target'=>'_blank'),
                            )
                        ); ?>
                    <div class="dot_bottom"></div>
                </div>
            </div>
        </div>
    </div>
</div>