                <div style ="margin-top: 30px;font-size: 20px;font-weight: bolder;">
                 Notifications.
             </div>
<div class="shiftcontainer" style="width:70%;margin-top: 60px;" id="mainDiv">
    <div class="shadowcontainer">
        <div  id ="inner" class="innerdiv">
             <div id='preview'></div>
                         <?php if ($notification){
            foreach ($notification as $p) { ?>
                
                <?php
                if($p->type == "friend"){
                    $senderId = $p->sender_id;
                    
                    $is_friend = UserFriend::model()->find('(user_id=:uid AND friend_id=:fid) AND (status = 1)',array(':uid'=>$senderId,':fid'=>$p->user_id));
                    if($is_friend){
                        
                        $message = "is Your friend";
                        
                    }
                    else{
                        $message = $p->message;
                    }
                }
                $userId = $p->sender_id;
                $user = UserProfile::model()->findByAttributes(array('user_id' => $userId));
                if (!empty($user->first_name)) {
                    $userName = ucfirst($user->first_name) . ' ' . ucfirst($user->last_name);
                } else {
                    $users = User::model()->findByPk($userId);
                    $userName = $users['username'];
                }
                ?>
                <table id ="row_<?php echo $p->id; ?>" class="well-for-table" >
                    <tr>
                        <?php if(!empty($user->image)){ ?>
                        <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl.'/uploads/user_'.$user->user_id.'/'.$user->image;?>" /></td>
                        <?php } else { ?>
                        <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl.'/images/user.png';?>"/></td>
                        <?php } ?>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        
                        <td style="width:100%;">
                            
                            <p>
                                <b><a href="<?php echo Yii::app()->baseUrl . '/index.php/user/viewprofile/userId/'.$p->sender_id; ?>"><?php echo $userName;?></a></b><span style="float:right; font-size: 10px;margin-right:3px;"><?php echo $this->checkTime($p->date);?></span><br />
                                
                                <?php if($p->type != "friend")
                                  { echo $p->message; } else { echo $message; } ?><br/>
                                <?php if(!empty($p->image)){?><img src="<?php echo Yii::app()->baseUrl.'/uploads/'.$p->id.'_'.$p->image;?>" /><?php }?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;&nbsp;&nbsp;</td>
                        
                    </tr>
                    
                    <?php
                
                ?>
                    
                    
                    
                </table>
<?php } }else{?>
                    No recent posts...
                    <?php } ?>
        </div>
    </div>
    <?php 
    
    ?>
</div>
