<!DOCTYPE html>  
<html lang="en"> 
    <head>
       
        <title>Social Property</title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl?>/css/core" />
 
       
            </script>
        
        <script type="text/javascript">
            $(document).ready(function(){
             //alert($('.icon-asterisk').parent().html());
              window.setInterval("get_noti_count()",2000);
            });
            function get_noti_count(){
            
            $.ajax({
            url: '<?php echo Yii::app()->baseUrl?>/index.php/notification/getcount',
            success: function(data) {
              var obj = jQuery.parseJSON(data);
               if(obj.noti !=0){
               $('#noti-icon').show();
               $('#noti-icon').html(obj.noti);
               $('.icon-asterisk').parent().html("<i class = 'icon-asterisk'></i> <span style = 'color:red'>Notification ("+obj.noti+")</span>");
            }
            if(obj.mess !=0){
               $('#message-icon').show();
               $('#message-icon').html(obj.mess);
            }
            if(obj.friend !=0){
               $('#user-icon').show();
               $('#user-icon').html(obj.friend);
            }
            
            }
            });
            }
         
        </script>
    </head>
    <body id="newbody">
    <div class="container-fluid">
        <div class="row-fluid">&nbsp;</div>
        <div class="row-fluid">&nbsp;</div>
        <div class="row-fluid">&nbsp;</div>
        
        <?php if((Yii::app()->user->usertype != 3) ||(Yii::app()->user->usertype == 3) ){$userId = Yii::app()->user->userId;
        $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
        if($user){
            $userName = "No-Name";
        
        if ($user->first_name){
            $userName = $user->first_name.' '.$user->last_name;
        } else {
            $user = User::model()->findByAttributes(array('id' => $userId));
            $userName = $user->username;
        }
        }
        else{
            
            $userName = 'Admin';
        }
        }
        
        if($user){
        $imageLink = Yii::app()->baseUrl."/uploads/user_".Yii::app()->user->userId."/".$user->image;
        }
        else{
             $userName = 'No-Name';
            $imageLink = Yii::app()->baseUrl."/images/user.png";
        }
        ?>
                <?php
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
                            
                            //CHtml::link('Logout',array('user/logout'), array('class'=>'btn btn-danger pull-right', 'data-toggle'=>'modal')),
                            
                            array('class'=>'bootstrapwidgets.BootMenu',
                                 'htmlOptions'=>array('class'=>'pull-right'),
                                'items'=>array(
                                           
                                           array('label'=>$userName, 'url'=>'#','items'=>array(
                                           array('label'=>'Profile', 'icon'=>'user', 'url'=>Yii::app()->baseUrl.'/index.php/user/viewprofile/userId/'.Yii::app()->user->userId),
                                           array('label'=>'Settings', 'icon'=>'pencil', 'url'=>Yii::app()->baseUrl.'/index.php/user/settings'),
                                           '---',
                                           array('label'=>'Logout', 'icon'=>'off', 'url'=>Yii::app()->baseUrl.'/index.php/user/logout'),
                                          
                                
                                          ),),),),
                            '<span style="float:right;"><img style = "margin-top:6px" src = "'.Yii::app()->baseUrl.'/images/single-user.png"/><a href= "'.Yii::app()->baseUrl.'/index.php/notification/friendnotification"/><span id = "user-icon" style = "display:none;margin-left:-8px;background-color:#F01B1B" class="badge"></span></a>&nbsp;&nbsp;<img style = "margin-top:6px" src = "'.Yii::app()->baseUrl.'/images/alert-2.png"/><a href= "'.Yii::app()->baseUrl.'/index.php/notification/viewnotification"/><span id = "noti-icon" style = "display:none;margin-left:-8px;background-color:#F01B1B" class="badge"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<img style = "margin-top:6px" src = "'.Yii::app()->baseUrl.'/images/message.png"/><a href= "'.Yii::app()->baseUrl.'/index.php/user/inbux"/><span id = "message-icon" style = "display:none;margin-left:-8px;background-color:#F01B1B" class="badge"></span></a>&nbsp;&nbsp;&nbsp;&nbsp;<img style = "width:50px;height:30px;margin-top:6px" src = "'.$this->geUserImage(Yii::app()->user->userId).'"</span>',
  
                        ),
                        
                    ));
                ?>
    <div class="row-fluid">
    <div class="span2" id ="pp">
        <?php 
        
        if(Yii::app()->controller->ID=='user' && Yii::app()->controller->action->ID=='dashboard')
        {$dashboard = 'true'; }
        else{$dashboard = ''; }
        if (Yii::app()->controller->ID=='user' && Yii::app()->controller->action->ID=='settings' ) 
            $settings = 'true';
        else{$settings = ''; }
        if (Yii::app()->controller->ID=='user' && Yii::app()->controller->action->ID=='inbux' ) 
            $inbox = 'true';
        else{$inbox = ''; }
        if(Yii::app()->controller->ID=='businesspage' && Yii::app()->controller->action->ID=='businesspages')
        {
            $busPages = 'true';
            $busCrPages='';
        }
        elseif(Yii::app()->controller->ID=='businesspage' && Yii::app()->controller->action->ID=='createpage')
        {
            $busCrPages = 'true'; 
            $busPages='';
        }
        
        
        else
        {
            $busPages = ''; 
            $busCrPages='';    
        }
        ?> 
        <?php
        //message cout
        $messages = Messages::model()->findAll('user_id=:id AND is_read=:messgRead',array(':id'=>Yii::app()->user->userId,':messgRead'=>0));
        $count = count($messages);
        ?>
        <?php
        $notification = Notification::model()->findAll('user_id=:uid AND is_read = 0',array(':uid'=>Yii::app()->user->userId));
        $notification_count = count($notification);
        
        ?>
        
        <?php $this->widget('bootstrap.widgets.BootMenu', array(
                'type'=>'list',
                'items'=>array(
                    array('label'=>'General'),
                    array('label'=>'Home', 'icon'=>'home', 'url'=>Yii::app()->baseUrl.'/index.php/user/dashboard', 'active'=>$dashboard),
                    array('label'=>"Messages ($count) ", 'icon'=>'icon-envelope', 'url'=>Yii::app()->baseUrl.'/index.php/user/inbux','active'=>$inbox),
                    array('label'=>"Notification ($notification_count) ",'icon'=>'icon-asterisk','url'=>Yii::app()->baseUrl.'/index.php/notification/viewnotification'),
                    array('label'=>'Properties Nearby', 'icon'=>'road', 'url'=>'#'),
                    array('label'=>'Properties Search', 'icon'=>'search', 'url'=>'#'),
                    array('label'=>'Pages'),
                    array('label'=>'Create Page', 'icon'=>'lock', 'url'=>Yii::app()->baseUrl.'/index.php/businesspage/createpage', 'active'=>$busCrPages),
                    array('label'=>'My Business Page', 'icon'=>'lock', 'url'=>Yii::app()->baseUrl.'/index.php/businesspage/businesspages','active'=>$busPages),
                    array('label'=>'All Business Page', 'icon'=>'lock', 'url'=>Yii::app()->baseUrl.'/index.php/businesspage/allbusinesspages'),
                    
                    array('label'=>'Settings'),
                    array('label'=>'Profile', 'icon'=>'user', 'url'=>Yii::app()->baseUrl.'/index.php/user/viewprofile/userId/'.Yii::app()->user->userId),
                    array('label'=>'Pages','icon'=>'file','url'=>'#'),
                    array('label'=>'Settings', 'icon'=>'cog', 'url'=>Yii::app()->baseUrl.'/index.php/user/settings','active'=>$settings),
                    array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
                ),
                'htmlOptions'=>array('class'=>'well'),
               )); ?>
    </div>
    <div class="span10">
        <?php echo $content; ?>
    </div>
    </div>
    
      
  </body>
        <?php

                /*$this->widget('bootstrap.widgets.BootNavbar', array(
                'fixed'=>'top',
                'brand'=>'Social Property',
                'brandUrl'=>Yii::app()->baseUrl,
                'fluid'=>'true',
                'collapse'=>true, // requires bootstrap-responsive.css
                'items'=>array(
                    array(
                        'class'=>'bootstrap.widgets.BootMenu',
                        'items'=>array(
                            array('label'=>'Home', 'url'=>Yii::app()->baseUrl.'/index.php/user/dashboard', 'active'=>true),
                            array('label'=>'Features', 'url'=>'#'),
                            array('label'=>'About','url'=>'#'),
                            array('label'=>'Blog','url'=>'#'),

                            ),



                    ),
                    '<form class="navbar-search pull-left" action=""><input id = "searchbox" type="text" class="search-query span2" placeholder="Search"></form>',
                    //CHtml::link('Logout',array('user/logout'), array('class'=>'btn btn-danger pull-right', 'data-toggle'=>'modal')),

                    array('class'=>'bootstrapwidgets.BootMenu',
                            'htmlOptions'=>array('class'=>'pull-right'),
                        'items'=>array(
                                array('label'=>$userName, 'url'=>'#','active'=>true,'items'=>array(
                                    array('label'=>'Profile', 'icon'=>'user', 'url'=>Yii::app()->baseUrl.'/index.php/user/viewprofile/userId/'.Yii::app()->user->userId),
                                    array('label'=>'Settings', 'icon'=>'pencil', 'url'=>Yii::app()->baseUrl.'/index.php/user/settings'),
                                    '---',
                                    array('label'=>'Logout', 'icon'=>'off', 'url'=>Yii::app()->baseUrl.'/index.php/user/logout'),


                                    ),),),),

                ),

            ));*/
        ?>
  </div>
</html>

