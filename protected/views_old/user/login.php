<script>
    $(document).ready(function() {
        $('#usererror').hide();
        $('#passerror').hide();
    });
    
    function nameerror(){
        if ($('#LoginForm_username').val()==''){
            $('#usererror').show();}
        if ($('#LoginForm_username').val()!=''){
            $('#usererror').hide();}
    }
    
    function passworderror(){
        if ($('#LoginForm_password').val()==''){
            $('#passerror').show();
        $('#passerror2').hide();
    }
        if ($('#LoginForm_password').val()!=''){
            $('#passerror').hide();
        $('#passerror2').hide();
    }
    }
    
    function testing(){
        if ($('#LoginForm_username').val()==''){
            $('#usererror').show();
        $('#passerror').hide();}
        if ($('#LoginForm_password').val()==''){
            $('#passerror').show();
        }
        $('#passerror2').hide();
    }
</script>
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
<div style ="margin-top: 50px;"sclass="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-form',
        'enableClientValidation' => true,
        'htmlOptions' => array('class' => 'well'),
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>
    <?php
    $usernameError = $form->error($model, 'username');
    $passwordError = $form->error($model, 'password');
    ?>
    <table cellspacing="9">
        <tr><div class="row">
            <td><?php echo $form->labelEx($model, 'username'); ?></td>
            <td><?php echo $form->textField($model, 'username', array("class" => "span3")); ?><br/>
             <?php echo $form->error($model,'username',array('style'=>'color:red;font-size:12px;')); ?></td>
        </div></tr>
        <tr>
            <td>
                &nbsp;
            </td>
            <td id="usererror" style="display:none;width:100%;">
            <?php
                Yii::app()->user->setFlash('error', $usernameError);
                $this->widget('bootstrap.widgets.BootAlert');
            ?>
            </td>
        </tr>

        <tr><div class="row">
            <td><?php echo $form->labelEx($model, 'password'); ?></td>
            <td><?php echo $form->passwordField($model, 'password', array("class" => "span3")); ?><br/>
             <?php echo $form->error($model,'password',array('style'=>'color:red;font-size:12px;')); ?></td>
            
        </div></tr>
<tr>
    <td>&nbsp;</td>
    <td id="passerror" style="display:none;width:100%;"><?php Yii::app()->user->setFlash('error', $passwordError); ?>
        <?php $this->widget('bootstrap.widgets.BootAlert'); ?>
            </td>
</tr>
        <!--<div class="row rememberMe">
<?php //echo $form->checkBox($model,'rememberMe');  ?>
<?php //echo $form->label($model,'rememberMe');  ?>
                <?php //echo $form->error($model,'rememberMe');  ?>
        </div>-->
        <tr><div class="row buttons">
            <td style="padding-left: 135px;"></td>
            <td onclick="testing()"><?php
                $this->widget('bootstrap.widgets.BootButton', array(
                    'label' => 'Login',
                    'buttonType' => 'submit',
                    'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'large', // '', 'large', 'small' or 'mini'
                ));
                ?></td>
        </div></tr>
    </table>

<?php $this->endWidget(); ?>
</div><!-- form -->
