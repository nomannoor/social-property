
<script type ="text/javascript">
$(document).ready(function() {
  $('#email-div').hide();
  $("#email").click(function() {
  $('#email').addClass('active tabs');
  $ ('#password').removeClass('active tabs')  
    $('#email-div').show();
    $('#pass-div').hide();
});


$("#password").click(function() {
  $('#password').addClass('active tabs');
  $('#email').removeClass('active tabs')  
    $('#email-div').hide();
    $('#pass-div').show();
});




});
/*$('#email').click(function(){
    alert("test");
//    
});*/

</script>

<ul class="nav nav-pills">
  <li  id ="password" class="active tabs">
    <a  href="#">Change Password</a>
    <div id="pass-div">
        <?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'change-password-changePassword-form',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<?php echo $form->passwordFieldRow($model, 'password', array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'newPassword', array('class'=>'span3')); ?>
<?php echo $form->passwordFieldRow($model, 'conformPassword', array('class'=>'span3')); ?><br/>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Submit')); ?>
 
<?php $this->endWidget(); ?>
    </div>
    
    
    <div id="email-div"> 
      
              <?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'change-password-changePassword-form',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
   <?php $email = User::model()->find('id=:userId',array(':userId'=>Yii::app()->user->userId));
   $emailAddress = $email['email'];
   ?>
<?php echo CHtml::textField('', "$emailAddress", array('class'=>'span3', 'disabled'=>'disabled')); ?>
<?php echo $form->passwordFieldRow($model, 'newPassword', array('class'=>'span3')); ?>
<br/>
<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Submit')); ?>
 
<?php $this->endWidget(); ?>
      
      </div>
    
    
  </li>
  
  <li id ="email" ><a  href="#">Change Email</a>
      </li>
  
</ul>

