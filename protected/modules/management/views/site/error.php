<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - 错误';
?>
<p class="error-code">
    错误 <?php echo $code; ?>
</p>
<p class="not-found">&nbsp;</p>
<div class="clear"></div>
<div class="content">
<?php echo CHtml::encode($message);?>
</div>