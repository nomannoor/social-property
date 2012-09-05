<!DOCTYPE html>  
<html lang="en"> 
    <head>
        <title>Social Property</title>
        
        <style type="text/css">
body
{
font-family:"Lucida Sans";

}
*
{
margin:0px
}
#searchbox
{
width:250px;
border:solid 1px #000;
padding:3px;
}
#display
{
width:250px;
display:none;
margin-right:30px;
border-left:solid 1px #dedede;
border-right:solid 1px #dedede;
border-bottom:solid 1px #dedede;
overflow:hidden;
}
.display_box
{
padding:4px; border-top:solid 1px #dedede; font-size:12px; height:30px;
}

.display_box:hover
{
background:#3b5998;
color:#FFFFFF;
}
#shade
{
background-color:#00CCFF;

}


</style>
       
        <script type="text/javascript">
            $(document).ready(function(){
            
            $("#searchbox").keyup(function() 
            {
            
            var searchbox = $(this).val();
            var dataString = 'searchword='+ searchbox;
            
            if(searchbox=='')
            {
            }
            else
            {

            $.ajax({
            type: "POST",
            url: '<?php echo Yii::app()->baseUrl?>/index.php/user/finduser',
            data: dataString,
            cache: false,
            success: function(html)
            {
            
            
            $("#display").html(html).show();


                    }




            });
            }return false;    


            });
            });

//            jQuery(function($){
//            $("#searchbox").Watermark("Search");
//            });
            </script>
            
        
        
    </head>
    <body>
    <div class="container-fluid">
        <div class="row-fluid">&nbsp;</div>
        <div class="row-fluid">&nbsp;</div>
        <div class="row-fluid">&nbsp;</div>
        <div style ="width: 250px;height:auto;margin-left:376px; position:absolute;z-index:2; background-color:#ffffff;margin-top: -14px;" id="display">
        </div>
        <?php if(Yii::app()->user->usertype != 3){$userId = Yii::app()->user->userId;
        $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
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
                                    array('label'=>'Home', 'url'=>Yii::app()->baseUrl.'/index.php/user/dashboard', 'active'=>true),
                                    array('label'=>'Features', 'url'=>'#'),
                                    array('label'=>'About','url'=>'#'),
                                    array('label'=>'Blog','url'=>'#'),
                                        
                                  ),
                                
                                
                                
                            ),
                            //CHtml::link('Logout',array('user/logout'), array('class'=>'btn btn-danger pull-right', 'data-toggle'=>'modal')),
                            
                            array('class'=>'bootstrapwidgets.BootMenu',
                                 'htmlOptions'=>array('class'=>'pull-right'),
                                'items'=>array(
                                      array('label'=>$userName, 'url'=>'#','items'=>array(
                                           array('label'=>'Profile', 'icon'=>'user', 'url'=>Yii::app()->baseUrl.'/index.php/user/viewprofile'),
                                           array('label'=>'Settings', 'icon'=>'pencil', 'url'=>Yii::app()->baseUrl.'/index.php/user/settings'),
                                           '---',
                                           array('label'=>'Logout', 'icon'=>'off', 'url'=>Yii::app()->baseUrl.'/index.php/user/logout'),
                                          
                                
                                          ),),),),
  
                        ),
                        
                    ));
                ?>
    <div class="row-fluid">
    
    <div class="span10" style="width: 100%">
        <?php echo $content; ?>
    </div>
    </div>
    </div>
      
  </body>
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
                                           array('label'=>'Profile', 'icon'=>'user', 'url'=>Yii::app()->baseUrl.'/index.php/user/viewprofile'),
                                           array('label'=>'Settings', 'icon'=>'pencil', 'url'=>Yii::app()->baseUrl.'/index.php/user/settings'),
                                           '---',
                                           array('label'=>'Logout', 'icon'=>'off', 'url'=>Yii::app()->baseUrl.'/index.php/user/logout'),
                                          
                                
                                          ),),),),
  
                        ),
                        
                    ));
                ?>
  
</html>

