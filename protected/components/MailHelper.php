<?php
class MailHelper{
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
}
?>