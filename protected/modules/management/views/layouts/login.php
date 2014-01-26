<!DOCTYPE html>
<html lang="zh">
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="Keywords" content="">
    <meta name="Description" content="">
    <!-- Le styles -->
    <link href="<?php echo $this->module->assetsUrl; ?>/css/bootstrap-cerulean.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo $this->module->assetsUrl; ?>/css/global.css" type="text/css" rel="stylesheet"/>
    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo $this->module->assetsUrl; ?>/js/tools/html5shiv.js"></script>
    <![endif]-->
    <style type="text/css">
        .login-box .input-prepend {
            margin-bottom: 10px;*width:185px;
        }
        .login-box .input-prepend .add-on{
           *display: block;*float: left;*height: 20px;height: 20px\0;
        }
        .login-box .input-prepend input{
            *display: block;*float: left;*width:140px;*padding: 0px;padding: 0px\0;
        }
        .well{
            text-align: left;
        }
        .login-box .btn {
            width: 78%;
        }
    </style>
</head>
<body style="margin-left: 0px;">
<div class="container-fluid">
<?php echo $content; ?>
</div>
<footer>
    <p><?php echo CHtml::link ( '中文' , $this->langurl('zh_cn')) . ' | ' . CHtml::link ( 'English' ,$this->langurl('en_us')) ;?></p>
    <p>© <a href="http://www.sfnt.net" target="_blank">sfnt.net</a> 2013</p>
    <p>Powered by: <a href="http://www.sfnt.net" target="_blank">sfnt.net</a></p>
</footer>
</body>
</html>

