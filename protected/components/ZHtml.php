<?php
class ZHtml extends CHtml
{
    public static function enumDropDownList($model, $attribute, $values,$htmlOptions=array())
    {
      return CHtml::activeDropDownList( $model, $attribute, self::enumItem($values), $htmlOptions);
    }

    public static function enumRadioButtonList($model, $attribute, $values,$htmlOptions=array())
    {
      return CHtml::activeRadioButtonList( $model, $attribute, self::enumItem($values), $htmlOptions);
    }
 
    public static function enumItem($values) {
        foreach($values as $value) {
             $r[$value]=$value;
        }
        return $r;
    } 
}
?>