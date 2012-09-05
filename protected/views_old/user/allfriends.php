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
            
            
            $("#display1").html(html).show();


                    }




            });
            }return false;    


            });
            });

//            jQuery(function($){
//            $("#searchbox").Watermark("Search");
//            });
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



<script>
    
</script>

<style>
    .well-for-table:hover {
        background-color: #e1eafe;
    }
    .well-for-table img{
        height:50px;
    }
    
    .well-for-table1:hover {
        background-color: #f5f5f5;
    }
    
    .well-for-table1 img{
        height:30px;
    }

</style>
            
            <div>
                
                
                <form class="navbar-search pull-left" action="">
                  <input style ="margin-left:300px;" id = "searchbox" type="text" class="search-query" placeholder="Search">
                </form> 
            </div>

            <div style ="display:none;width:250px; height:auto;margin-left:300px; position:absolute;z-index:2; background-color:#ffffff;margin-top: 30px;" id="display1">
        </div>

            <div style ="margin-top:80px;margin-left:10px;"class="shadowcontainer">
                <div class="innerdiv">
                    <table class="well-for-table" style="width:100%">
                    <tr style='padding-bottom:10px'>
                    <?php if ($friends){
                        $i=1;
            foreach ($friends as $p) { ?>
                
                <?php
                
                $userId = $p->friend_id;
                $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
                $country = Country::model()->findByPk($user->country_id);
                if ($user->first_name) {
                    $userName = ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
                } else {
                    $user3 = User::model()->findByAttributes(array('id' => $userId));
                    $userName = $user3->username;
                }
                if($i%4!=0){
                ?>
               
                        
                        <td style="width:100px;"><img src="<?php echo $this->geUserImage($user->user_id);?>" style="padding-top:20px;width:100px;height:100px"</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        <td style="width:25%;">
                         <p style ="font-size: 21px;">
                         <b><span><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$user->user_id; ?>"><?php echo $userName;?></a></b</span><br />
                        </td>
                        
                    <?php } else { echo "<td style='width:100px'><img src='".$this->geUserImage($user->user_id)."' style='padding-top:20px;width:100px;height:100px'</td><td>&nbsp;&nbsp;&nbsp;</td><td style='width:25%;'><p style ='font-size: 21px;'><b><span><a href='".Yii::app()->baseUrl ."/index.php/user/viewprofile/userId/".$user->user_id."'>".$userName."</a></b</span><br /></td></tr><tr style='padding-bottom:10px'>";}?>   
                    
                
                
                    <div style ="margin-top:10px;">
                    
<?php $i++;} } else{?>
                    No recent posts...
                    <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
