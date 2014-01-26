<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/mg/css/new_content.css');
?>
<div style="float:none;margin:0 auto;" class="article-main">
		<div style="position:relative; width:100%">
			<div style="background:url('<?php echo Yii::app()->request->baseUrl; ?>/mg/images/new/crane.gif') no-repeat scroll top left transparent;width:123px; height:65px; z-index:-999; position:absolute; top:0px; left:0px;">
			</div>
			<div style="background:url('<?php echo Yii::app()->request->baseUrl; ?>/mg/images/new/cloud1.gif') no-repeat scroll top right transparent;width:150px; height:100px; z-index:-999; position:absolute; top:0px; right:0px;">
			</div>
		</div>
		<div class="centerText read-content article-title">
			<font class="bigfont"><b><?php echo $article->title;?></b></font>
		</div>
		<div class="centerText">
			<font color="#646464" style="font-size:12px;">作者：<?php echo $article->author;?>&#12288;&#12288;出處：<?php echo $article->from;?>&#12288;&#12288;時間：<?php echo date('Y-m-d H:i:s',$article->publishtime);?>&#12288;&#12288;點閱：<font id="click_num">
<script language="javascript" type="text/javascript" src="<?php echo $this->createUrl('click',array('article'=>$article->id));?>"></script></font></font>
		</div>
		
		<div id="read-content-body" class="read-content">
			<div style="line-height: 180%">
<?php echo $article->content;?>
			</div>

		</div>
		<div style="clear:both;"></div>
		<div style="max-height:29px; float:left;" data-show-faces="false" data-width="450" data-send="false" data-href="<?php echo $this->createUrl('article',array('id'=>$article->id));?>" class="fb-like"></div>
		<div style="float:right;font-size:12px;">
			分享到：
			<a rel="nofollow" class="fav_facebook" href="javascript:window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(location.href)+'&amp;t='+encodeURIComponent(document.title),'_blank','width=640,height=400');void(0)"><img border="0" align="absmiddle" src="<?php echo Yii::app()->request->baseUrl; ?>/mg/images/mg/share-facebook.png" alt="Facebook" title="Facebook"></a>
			<a rel="nofollow" class="fav_plurk" href="javascript:window.open('http://www.plurk.com/?qualifier=shares&amp;status=' .concat(encodeURIComponent(location.href)) .concat(' ') .concat('(') .concat(encodeURIComponent(document.title)) .concat(')'));void(0)"><img border="0" align="absmiddle" src="<?php echo Yii::app()->request->baseUrl; ?>/mg/images/mg/share-plurk.png" alt="Plurk" title="Plurk"></a>
			<a rel="nofollow" class="fav_twitter" href="javascript:window.open('http://twitter.com/home?status='+encodeURIComponent(location.href)+'&nbsp;'+encodeURIComponent(document.title),'_blank','width=640,height=400');void(0)"><img border="0" align="absmiddle" src="<?php echo Yii::app()->request->baseUrl; ?>/mg/images/mg/share-twitter.png" alt="Twitter" title="Twitter"></a>
		</div>
		<div style="clear:both;"></div>
		<div>
		   <ul class="pagelist">
			
		   </ul>
		</div>
		<div style="clear:both;"></div>
		<div data-width="960" data-num-posts="40" data-href="<?php echo $this->createUrl('article',array('id'=>$article->id));?>" class="fb-comments"></div>
	</div>