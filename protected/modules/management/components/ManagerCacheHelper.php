<?php
class ManagerCacheHelper{
    private static $_roles = array();
    public static function getRoles(){
        if(self::$_roles){
            return self::$_roles;
        }
        else{
            $roles = AdminRole::model()->findAll('disabled=0');
            $r = array();
            foreach($roles as $role){
                $r[$role->id]=Yii::t('system',$role->name);
            }
            self::$_roles = $r;
            return self::$_roles;
        }
    }
}
?>