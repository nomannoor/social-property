<style>#notify{margin:0px auto;font-size:13px;width:100%;text-shadow:0 1px 0 rgba(255,255,255,0.4)}#notify_error{margin:15px 0 5px;border:1px solid #a34625;background-color:#f9d9ce;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}#notify_success{margin:15px 0 5px;border:1px solid #25a336;background-color:#dfffe3;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}#notify_message{margin:15px 0 5px;border:1px solid #284797;background-color:#cedaf9;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}.flash_icon_container{margin-left: 150px; margin-right: 30px;float:left;width:20px;text-align:right;padding-right:8px;height:20px;position:relative;top:-3px}.flash_messages_container{margin-left: 200px; font-family:'Helvetica Neue', 'Myriad Pro', Calibri, 'trebuchet ms', Tahoma, Arial, Verdana, sans-serif;color:#333}.notify_message{width:400px;height:40px;background-color:#A6D6FF}</style>
<?php if (Yii::app()->user->hasFlash('success')) { ?>
    <div id="notify">
        <div id="notify_success" style="opacity: 1; ">
            <div class="flash_icon_container">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/icon-success.png" onload="$('#notify_success').animate({opacity: 1.0}, 3000).fadeOut(500)" />
            </div>
            <div class="flash_messages_container"><?php echo Yii::app()->user->getFlash('success'); ?></div><br class="clear">
        </div>
    </div>                
<?php } else if (Yii::app()->user->hasFlash('error')) {
    ?>
    <div id="notify">
        <div id="notify_error" style="opacity: 1; ">
            <div class="flash_icon_container">
                <img src="<?php echo Yii::app()->baseUrl ?>/images/icon-error.png" onload="$('#notify_error').animate({opacity: 1.0}, 3000).fadeOut(500)" />
            </div>
            <div class="flash_messages_container"><?php echo Yii::app()->user->getFlash('error'); ?></div><br class="clear">
        </div>
    </div> 
<?php } ?>

<?php
 $changePasswoed_form_frame = "<iframe style='width:100%;height:330px;border:none;' src='".Yii::app()->baseUrl."/index.php/user/changePassword'></iframe>";
 $changeEmail_form_frame = "<iframe style='width:100%;height:330px;border:none;' src='".Yii::app()->baseUrl."/index.php/user/changeemail'></iframe>";
?>
<?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Change Password', 'content'=>$changePasswoed_form_frame, 'active'=>true),
        array('label'=>'Change Email','content'=>$changeEmail_form_frame),
    ),
    'htmlOptions'=>array('style'=>'height:auto;'),
)); ?>