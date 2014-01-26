<?php
class SystemHelper{
    public static function getSuperuserIDs(){
        return Yii::app()->params['su'];
    }
    public static function getSystemViewsPath(){
        return '//../modules/management/views';
    }
}
?>