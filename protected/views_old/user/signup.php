<script>
    $(document).ready(function() {
        $('#usererror').hide();
        $('#passerror').hide();
    });
    
    function check(){
        var a = $('#User_ConfirmPassword').val();
        var b =$('#User_password').val();
        if(a!=b){
            alert("confirm password is not match");
        }
    }
    
    function nameerror(){
        if ($('#User_username').val()==''){
            $('#usererror').show();}
        if ($('#User_username').val()!=''){
            $('#usererror').hide();}
    }
    
    function emailerror(){
        if ($('#User_email').val()==''){
            $('#emailerror').show();}
        if ($('#User_email').val()!=''){
            $('#emailerror').hide();}
    }
    
    function typeerror(){
        if ($('#User_user_type').val()==''){
            $('#typeerror').show();}
        if ($('#User_user_type').val()!=''){
            $('#typeerror').hide();}
    }
    
    function passerror(){
        if ($('#User_password').val()==''){
            $('#passerror').show();
        $('#passerror2').hide();
    }
        if ($('#User_password').val()!=''){
            $('#passerror').hide();
        $('#passerror2').hide();
    }
    }
    
    function testing(){
        if ($('#User_username').val()==''){
            $('#usererror').show();
        $('#passerror').hide();}
//    if ($('#User_email').val()==''){
//            $('#emailerror').show();}
        if ($('#User_user_type').val()==''){
            $('#typeerror').show();}
        if ($('#User_password').val()==''){
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
<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-signup-form',
	'enableClientValidation'=>true,
        'htmlOptions'=>array('class'=>'well'),
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
)); ?>

	<?php //echo $form->errorSummary($model); ?>

	<table cellspacing="9">
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'username'); ?></td>
                    <td><?php echo $form->textField($model,'username',array( "class"=>"span3",)); ?><br/>
                    <?php echo $form->error($model,'username',array('style'=>'color:red;font-size:12px;')); ?></td>
                        
                    
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="usererror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'username'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>

            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'email'); ?></td>
                    <td><?php echo $form->textField($model,'email',array( "class"=>"span3",)); ?><br/>
                   <?php echo $form->error($model,'email',array('style'=>'color:red;font-size:12px;')); ?></td>
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="emailerror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'email'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
        
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'user_type'); ?></td>
                    <td><?php echo $form->dropdownList($model,'user_type',CHtml::listData(UserType::model()->findAll('id!=:Id',array(':Id'=>3)),'id','type'),
                                    array(
                                        'prompt'=>'Select Type', 
                                        'class'=>'span3',
                                        'ajax'=> array(                                 
                                        'type' => 'POST')
                                    , ) )  ;  ?><br/>
                      <?php echo $form->error($model,'user_type',array('style'=>'color:red;font-size:12px;')); ?></td>                
                    
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="typeerror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'user_type'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
            
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'password'); ?></td>
                    <td><?php echo $form->passwordField($model,'password',array( "class"=>"span3", )); ?><br/>
                      <?php echo $form->error($model,'password',array('style'=>'color:red;font-size:12px;')); ?></td>
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="passerror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'password'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
            
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'ConfirmPassword'); ?></td>
                    <td><?php echo $form->passwordField($model,'ConfirmPassword',array( "class"=>"span3",'onblur'=>'check()')); ?><br/>
                       <?php echo $form->error($model,'ConfirmPassword',array('style'=>'color:red;font-size:12px;')); ?></td>   
                    
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="conpasserror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'ConfirmPassword'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
            
            <tr><div class="row buttons">
                    <?php // echo CHtml::submitButton('Submit'); ?>
                    <td style="padding-left: 135px;"></td>
                    <td>
                         <?php 
                        $this->widget('bootstrap.widgets.BootButton', array(
                            'label'=>'Signup',
                            'buttonType'=>'submit',
                            'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                            'size'=>'large', // '', 'large', 'small' or 'mini'
                        )); ?>

                    </td>
            </div></tr>
        </table>

<?php $this->endWidget(); ?>

</div><!-- form -->