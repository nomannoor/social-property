<script>
function PopupCenter(pageURL,w,h) {
    

var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL,'Facebook', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

} 

</script>
<?php
    $facebook=Yii::app()->baseUrl.'/index.php/site/facebook';
    //include('login_signup_form_modal.php');
    $signupLink = CHtml::link('Click me','#modal', array('class'=>'btn btn-primary', 'data-toggle'=>'modal'));
    $this->widget('bootstrap.widgets.BootNavbar', array(
        'fixed'=>'top',
        'brand'=>'Social Property',
        'brandUrl'=>Yii::app()->baseUrl,
        'fluid'=>'true',
        'collapse'=>true, // requires bootstrap-responsive.css
        'items'=>array(
            array(
                'class'=>'bootstrap.widgets.BootMenu',
                'items'=>array(
                    
                    
                ),
            ),
           '<form class="navbar-search pull-right" method = "POST" action="'. Yii::app()->baseUrl.'/index.php/user/login"><input style = "height:25px;width:125px;"type="text" class="input-small" placeholder="Username" name = "username" >&nbsp;&nbsp;&nbsp;<input style = "height:25px;width:125px;" type="password" class="input-small" placeholder="Password" name = "password" >&nbsp;&nbsp;&nbsp;<input style = "height:25px;width:75px;margin-top:-6px;font-weight:bold" type="submit" class="btn" value = "Login" name = "login">&nbsp;&nbsp;<input style = "height:25px;margin-top:-6px;font-weight:bold" type="button" onclick="PopupCenter('."'$facebook'".',400,400);" class="btn" value = "Login with Facebook" name = "fblogin">&nbsp;&nbsp;&nbsp;<a href = "'.Yii::app()->baseUrl.'/index.php/user/signup"><input style = "height:25px;width:75px;margin-top:-6px;font-weight:bold" type="button" class="btn" value = "Signup" name = "signup"></a></form>',
            //CHtml::link('Login/Signup','#modal', array('class'=>'btn btn-primary pull-right', 'data-toggle'=>'modal')),
        ),
    ));
?>  
