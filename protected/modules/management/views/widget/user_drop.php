<!-- user dropdown starts -->
<div class="btn-group pull-right">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="icon-user"></i><span class="hidden-phone"><?php echo Yii::app()->manager->name;?></span>
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li><?php echo CHtml::link(Yii::t('system','profile'),array('/management/profile'))?></li>
        <li><?php echo CHtml::link(Yii::t('system','modify password'),array('/management/profile/changepassword'))?></li>
        <li class="divider"></li>
        <li><?php echo CHtml::link(Yii::t('system','Logout'),array('/management/auth/logout'))?></li>
    </ul>
</div>
<!-- user dropdown ends -->