    <div class="row-fluid">
        <div class="row-fluid" style="margin-top: 50px;margin-bottom: 50px;">
            <div class="span12 center login-header">
                <h2><?php echo Yii::t('system','SFNT Content Management System');?></h2>
            </div><!--/span-->
        </div><!--/row-->

        <div class="row-fluid">
            <div class="well span5 center login-box">

			<?php 
				$form=$this->beginWidget('CActiveForm', array(
					'id'=>'adminlogin-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
					'enableAjaxValidation'=>true,
					'htmlOptions'=>array('class'=>'form-horizontal'),
				)); 
				CHtml::$afterRequiredLabel = '&nbsp;:&nbsp;';
			?>
                <div class="alert alert-info"><?php echo Yii::t('system','Please input your username and password.');?></div>
                    <fieldset>
                        <div class="input-prepend" data-rel="tooltip" data-original-title="Username">
                            <span class="add-on"><i class="icon-user"></i></span><?php echo $form->textField($model,'username', array('class'=>'text input-large span10')); echo '<span class="showsign">&nbsp;</span>'; echo $form->error($model,'username'); ?>
                        </div>
                        <div class="clearfix"></div>

                        <div class="input-prepend" data-rel="tooltip" data-original-title="Password">
                            <span class="add-on"><i class="icon-lock"></i></span><?php echo $form->passwordField($model,'password', array('class'=>'text input-large span10')); echo '<span class="showsign">&nbsp;</span>'; echo $form->error($model,'password'); ?>
                        </div>
                        <div class="clearfix"></div>

                        <p class="center span5">
							<?php echo CHtml::submitButton(Yii::t('system','Login'), array('class'=>'btn btn-primary')); ?>
                        </p>
                    </fieldset>
			<?php $this->endWidget(); ?>
            </div><!--/span-->
        </div><!--/row-->
    </div><!--/fluid-row-->
<?php
/*
	$salt =  UtilHelper::getRndString(Yii::app()->params['saltlenght']);
    echo $salt;
    echo '<br/>';
    echo UtilHelper::encryptPwd('123456', $salt);
    echo ' '.time();
 */
?>
