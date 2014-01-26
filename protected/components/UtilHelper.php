<?php
class UtilHelper{
    public static function getMailer(){
        $mailer = Yii::createComponent('application.extensions.mailer.EMailer');
        $mailer->Host = Yii::app()->params['mail_host'];
        $mailer->Port = Yii::app()->params['mail_port'];    
        $mailer->IsSMTP();
        $mailer->SMTPAuth= true; 
        $mailer->Username = Yii::app()->params['mail_username'];
        $mailer->Password = Yii::app()->params['mail_pwd'];
        $mailer->From = Yii::app()->params['mail_from'];
        $mailer->FromName = Yii::app()->params['mail_fromName'];
        $mailer->CharSet = 'UTF-8';
        return $mailer;
    }

    public static function getRndString($num){
        $patternarr = str_split(Yii::app()->params['stringValidChar'],1);
        $targetarr = array_rand($patternarr, $num);
        $restr = '';
        foreach($targetarr as $v) {$restr.=$patternarr[$v];}
        return $restr;
    }

    public static function encryptPwd($pwd, $salt=''){
        return md5(md5($pwd).$salt);
    }
    
    public static function getOnlineIP(){
        $onlineip = '';
        if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$onlineip = getenv('HTTP_CLIENT_IP');
		} elseif(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
			$onlineip = getenv('HTTP_X_FORWARDED_FOR');
		} elseif(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
			$onlineip = getenv('REMOTE_ADDR');
		} elseif(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
			$onlineip = $_SERVER['REMOTE_ADDR'];
		}

		preg_match("/[\d\.]{7,15}/", $onlineip, $onlineipmatches);
		$onlineip = $onlineipmatches[0] ? $onlineipmatches[0] : 'unknown';
		unset($onlineipmatches);
        return $onlineip;
    }
    
    public function mkdirs($dir, $mode = 0755){ 
        return is_dir($dir) or (self::mkdirs(dirname($dir),$mode) and mkdir($dir, $mode)); 
    }


}
?>