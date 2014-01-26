<?php
class ImageHelper{
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
    public static function checkImgType(){
        $cfg_photo_type = array();
        $cfg_photo_type['gif'] = FALSE;
        $cfg_photo_type['jpeg'] = FALSE;
        $cfg_photo_type['png'] = FALSE;
        $cfg_photo_type['wbmp'] = FALSE;
        $cfg_photo_typenames = Array();
        $cfg_photo_support = '';
        if(function_exists("imagecreatefromgif") && function_exists("imagegif"))
        {
            $cfg_photo_type["gif"] = TRUE;
            $cfg_photo_typenames[] = "image/gif";
            $cfg_photo_support .= "GIF ";
        }
        if(function_exists("imagecreatefromjpeg") && function_exists("imagejpeg"))
        {
            $cfg_photo_type["jpeg"] = TRUE;
            $cfg_photo_typenames[] = "image/pjpeg";
            $cfg_photo_typenames[] = "image/jpeg";
            $cfg_photo_support .= "JPEG ";
        }
        if(function_exists("imagecreatefrompng") && function_exists("imagepng"))
        {
            $cfg_photo_type["png"] = TRUE;
            $cfg_photo_typenames[] = "image/png";
            $cfg_photo_typenames[] = "image/xpng";
            $cfg_photo_support .= "PNG ";
        }
        if(function_exists("imagecreatefromwbmp") && function_exists("imagewbmp"))
        {
            $cfg_photo_type["wbmp"] = TRUE;
            $cfg_photo_typenames[] = "image/wbmp";
            $cfg_photo_support .= "WBMP ";
        }
        return $cfg_photo_type;
    }
    
    public static function diskThumb($filePath, $width, $height, $bg = false){
        if(!file_exists($filePath)){
            return '';
        }
        $thumbPath = '/.thumb/disk/';
        list($thumbname,$extname) = explode('.',$filePath);
        $thumbname = str_replace(':','_disk',$thumbname);
        $thumbname = str_replace("\\",'/',$thumbname);
        $siteRoot = str_replace("\\", '/',$_SERVER['DOCUMENT_ROOT']);
        
        $toPath = $siteRoot.$thumbPath.$thumbname.'.'.$extname;
        
        $newPath = dirname($toPath);
        if (!is_dir($newPath)){
            UtilHelper::mkdirs($newPath, 0755);
        }
        $newthumb = $thumbPath.$thumbname.'.'.$extname;
        if(!file_exists($toPath)){
            self::ImageResize($filePath, $width, $height, $toPath, true);
        }
        if(file_exists($toPath)){
            return $thumbPath.$thumbname.'.'.$extname;
        }
        else{
            return '';
        }
    }
    public static function getDiskFile($filePath){
        list($thumbname,$extname) = explode('.',$filePath);
        $type =
            ($extname == 'gif') ? "gif" : (
            ($extname == 'png') ? "png" : "jpeg");
        $type = "image/$type";
        HttpCacheHelper::file($filePath, $type);
    }
    public static function thumb($imgurl, $width, $height, $bg = false){
        if(substr($imgurl, 0, 1)!="/"){
            return $imgurl;
        }
    	$o_imgurl = $imgurl;
    	$imgurl = str_replace("-lp.", '.', $imgurl ) ;
        $thumb = $imgurl;
        list($thumbname,$extname) = explode('.',$thumb);
        $newthumb = $thumbname.'_'.$width.'_'.$height.'.'.$extname;
    	
        //echo($newthumb);
    	$siteRoot = str_replace("\\", '/',$_SERVER['DOCUMENT_ROOT']);
        
        $thumbPath = '/.thumb';
        
        $newPath = dirname($siteRoot.$thumbPath.$newthumb);
        
        $newthumb = $thumbPath.$newthumb;
        if (!is_dir($newPath)){
            UtilHelper::mkdirs($newPath, 0755);
        }
    	//echo($siteRoot.$newthumb);
        //Yii::log('thumb '.$newthumb,CLogger::LEVEL_WARNING,'thumb');
        if(!$thumbname || !$extname || !file_exists($siteRoot.$thumb)){
            
            return $o_imgurl;
        }
        if(!file_exists($siteRoot.$newthumb)) {
            if(self::ImageResize($siteRoot.$thumb, $width, $height, $siteRoot.$newthumb, true)){
                
            }
            else
            {
                //echo(' - no - ');
                //Yii::log('can not creat thumb '.$newPath,CLogger::LEVEL_WARNING,'thumb');
            }
        }
    	if(!file_exists($siteRoot.$newthumb)){
    	   //Yii::log('No file '.$siteRoot.$newthumb,CLogger::LEVEL_WARNING,'thumb');
            return $o_imgurl;
        }
        return $newthumb;
    }
    
    public static function ImageResize($srcFile, $toW, $toH, $toFile="", $cutFile=false)
    {
        //echo($toFile);
        $cfg_photo_type = self::checkImgType();
        if($toFile=='') $toFile = $srcFile;
        $info = '';
        $srcInfo = GetImageSize($srcFile,$info);
        //print_r($srcInfo);
        
        switch ($srcInfo[2])
        {
            case 1:
                if(!$cfg_photo_type['gif']) return FALSE;
                $im = imagecreatefromgif($srcFile);
                break;
            case 2:
                if(!$cfg_photo_type['jpeg']) return FALSE;
                $im = imagecreatefromjpeg($srcFile);
                break;
            case 3:
                if(!$cfg_photo_type['png']) return FALSE;
                $im = imagecreatefrompng($srcFile);
                break;
            case 6:
                if(!$cfg_photo_type['bmp']) return FALSE;
                $im = imagecreatefromwbmp($srcFile);
                break;
        }
        //echo(" - $srcInfo[2] - ");
        $srcW=ImageSX($im);
        $srcH=ImageSY($im);
        if($srcW<=$toW && $srcH<=$toH ) return TRUE;

        $toWH=$toW/$toH;
        $srcWH=$srcW/$srcH;
        if($toWH<=$srcWH)
        {
            $ftoW=$toW;
            $ftoH=$ftoW*($srcH/$srcW);
        }
        else
        {
            $ftoH=$toH;
            $ftoW=$ftoH*($srcW/$srcH);
        }

		//change=========
		if($cutFile){
			//缩略生成并裁剪
			$newW = $toH * $srcW / $srcH;
			$newH = $toW * $srcH / $srcW;
			if ($newH >= $toH) {
				$ftoW = $toW;
				$ftoH = $newH;
			} else {
				$ftoW = $newW;
				$ftoH = $toH;
			}
			
		}//change=========

        if($srcW>$toW||$srcH>$toH)
        {
            if(function_exists("imagecreateTRUEcolor"))
            {
                @$ni = imagecreateTRUEcolor($ftoW,$ftoH);
                if($ni)
                {
                    imagecopyresampled($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
                }
                else
                {
                    $ni=imagecreate($ftoW,$ftoH);
                    imagecopyresized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
                }
            }
            else
            {
                $ni=imagecreate($ftoW,$ftoH);
                imagecopyresized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
            }

			//change=========
			if($cutFile){
			     //echo($toFile);
				//裁剪图片成标准缩略图
				$new_imgx = imagecreatetruecolor($toW, $toH);
				if ($newH >= $toH) {
					imagecopyresampled($new_imgx, $ni, 0, 0, 0, ($newH - $toH) / 2, $toW, $toH, $toW,
						$toH);
				} else {
					imagecopyresampled($new_imgx, $ni, 0, 0, ($newW - $toW) / 2, 0, $toW, $toH, $toW,
						$toH);
				}
				switch ($srcInfo[2]) {
					case 1:
						imagegif($new_imgx, $toFile);
						break;
					case 2:
						if(!imagejpeg($new_imgx, $toFile, 85)){
						  echo($toFile.' - no out put - ');
                          //Yii::log('can not creat thumb '.$toFile,CLogger::LEVEL_WARNING,'thumb');
						}
                        
						break;
					case 3:
						imagepng($new_imgx, $toFile);
						break;
					case 6:
						imagebmp($new_imgx, $toFile);
						break;
					default:
                        
						return false;
				}
				imagedestroy($new_imgx);
			}//change=========
			else{//change
				switch ($srcInfo[2])
				{
					case 1:
						imagegif($ni,$toFile);
						break;
					case 2:
						if(!imagejpeg($ni,$toFile,85)){
						  echo($toFile.' - no out put - ');
                          //Yii::log('can not creat thumb '.$toFile,CLogger::LEVEL_WARNING,'thumb');
						}
						break;
					case 3:
						imagepng($ni,$toFile);
						break;
					case 6:
						imagebmp($ni,$toFile);
						break;
					default:
                        
						return FALSE;
				}
				imagedestroy($ni);
			}//change
            
        }
        imagedestroy($im);
        return TRUE;
    }
}
    
?>