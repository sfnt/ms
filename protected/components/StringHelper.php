<?php
class StringHelper{
    public static function getFirstPic($body){
        $litpic = '';
        preg_match_all("/(src)=[\"|'| ]{0,}([^>]*\.(gif|jpg|bmp|png))/isU",$body,$img_array);
        $img_array = array_unique($img_array[2]);
        if(count($img_array)>0)
        {
            $picname = preg_replace("/[\"|'| ]{1,}/", '', $img_array[0]);
            $litpic = $picname;
            
        }
        return $litpic;
    }
    public static function match_links($document)
    {
        $match = array();
        preg_match_all("'<\s*a\s.*?href\s*=\s*([\"\'])?(?(1)(.*?)\\1|([^\s\>]+))[^>]*>?(.*?)</a>'isx",
            $document, $links);
        while (list($key, $val) = each($links[2])) {
            if (!empty($val))
                $match['link'][] = $val;
        }

        while (list($key, $val) = each($links[3])) {
            if (!empty($val))
                $match['link'][] = $val;
        }

        while (list($key, $val) = each($links[4])) {
            if (!empty($val))
                $match['content'][] = $val;
        }

        while (list($key, $val) = each($links[0])) {
            if (!empty($val))
                $match['all'][] = $val;
        }

        return $match;
    }
    public static function Html2Text($str, $r = 0)
    {
        if ($r == 0) {
            return self::SpHtml2Text($str);
        } else {
            $str = self::SpHtml2Text(stripslashes($str));
            return addslashes($str);
        }
    }
    public static function Text2Html($txt)
    {
        $txt = str_replace("  ", "　", $txt);
        $txt = str_replace("<", "&lt;", $txt);
        $txt = str_replace(">", "&gt;", $txt);
        $txt = preg_replace("/[\r\n]{1,}/isU", "<br/>\r\n", $txt);
        return $txt;
    }
    public static function SpHtml2Text($str)
    {
        $str = preg_replace("/<sty(.*)\\/style>|<scr(.*)\\/script>|<!--(.*)-->/isU", "",
            $str);
        $alltext = "";
        $start = 1;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($start == 0 && $str[$i] == ">") {
                $start = 1;
            } else
                if ($start == 1) {
                    if ($str[$i] == "<") {
                        $start = 0;
                        $alltext .= " ";
                    } else
                        if (ord($str[$i]) > 31) {
                            $alltext .= $str[$i];
                        }
                }
        }
        $alltext = str_replace("　", " ", $alltext);
        $alltext = preg_replace("/&([^;&]*)(;|&)/", "", $alltext);
        $alltext = preg_replace("/[ ]+/s", " ", $alltext);
        return $alltext;
    }
}
?>