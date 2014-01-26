<?php
class EnumHelper{
	// 前后台类型
	public static function UserType() {
		return array(
		'FRONTEND' => 0,
		'BACKEND' => 1,
		);
	}

    public static function UserStatus(){
        return array(
            0 => Yii::t('system','disabled'),
            1 => Yii::t('system','enabled'),
            2 => Yii::t('system','unactived'),
        );
    }
    
    public static function IsDisplay() {
		return array(
    		0 => Yii::t('system','no'),
            1 => Yii::t('system','yes'),
		);
	}
    public static function IsDisabled() {
		return array(
    		0 => Yii::t('system','disabled'),
            1 => Yii::t('system','enabled'),
		);
	}
    public static function YesNo() {
		return array(
    		0 => Yii::t('system','no'),
            1 => Yii::t('system','yes'),
		);
	}
    public static function ColumnTemplate(){
        return array(
            'column'=>Yii::t('system','Show article list'),
            'columnContent'=>Yii::t('system','Show content')
        );
    }
    public static function ContentTemplate(){
        return array(
            'article'=>Yii::t('system','Normal article')
        );
    }
    public static function ArticleStatus(){
        return array(
            0 => Yii::t('articles','Draft'),
            1 => Yii::t('articles','Submitted'),
            2 => Yii::t('articles','Published'),
            3 => Yii::t('articles','Returned'),
            4 => Yii::t('articles','Deleted'),
        );
    }
    public static function Gender(){
        return array(
            0=> Yii::t('system','Unknow'),
            1=> Yii::t('system','Male'),
            2=> Yii::t('system','Female'),
        );
    }
    public static function RegType(){
        return array(
            0=> Yii::t('system','Direct Registered'),
            1=> Yii::t('system','Manager Registered'),
            2=> Yii::t('system','Registered From Other System'),
            3=> Yii::t('system','Email Invited'),
        );
    }
    
    public static function PackageStatus(){
        return array(
            'both'=>Yii::t('files','Included'),
            'base'=>Yii::t('files','Missed'),
            'select'=>Yii::t('files','Extra'),
        );
    }
}
?>