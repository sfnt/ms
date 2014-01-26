<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    public function init() 
    {  
        parent::init();
        //Yii::app()->charset = 'utf-8';//防止多语言乱码
        $lang = Yii::app()->request->getParam('lang');
        if(isset($lang) && $lang !="")
         {
             Yii::app()->language = $lang;
             setcookie('lang',$lang);
         }else if(isset($_COOKIE['lang']) && $_COOKIE['lang'] != "")
         {
             Yii::app()->language=$_COOKIE['lang'];
         }else{
            //Yii::app()->language = 'en_us';//en_us 为系统默认语言，若部分英文翻译不同，语言目录请勿命名为en_us
         }
    }
    public function langurl($lang = 'en'){ //用于生成多语言链接
            if($lang == Yii::app()->language) return '';
            $current_uri = Yii::app()->request->requestUri;
            if(strrpos($current_uri,'lang=' ))
            {
                //防止生成的 url 传值出现重复
                $langstr = 'lang='.Yii::app()->language;
                $current_uri = str_replace ('?'.$langstr.'&','?', $current_uri);
                $current_uri = str_replace ('?'.$langstr,'', $current_uri);
                $current_uri = str_replace ('&'.$langstr,'', $current_uri);
            }
            if(strrpos($current_uri,'?' ))
                return $current_uri.'&lang='.$lang;
            else
                return $current_uri.'?lang='.$lang;
        }
}