<div class ="span8">
            <br/><br/><br/><br/>
           <?php foreach($messages as $m):
           
?>
            <table class="well-for-table">
                
            <tr onmouseout="$('#img_<?php echo $m['id'];?>').hide()" onmouseover="$('#img_<?php echo $m['id'];?>').show()" id ="row_<?php echo $m['id'];?>"><?php if($m['user']['userProfile']['image']) {?>
            <td><img width="50" style ="height:50px;" src="<?php echo Yii::app()->baseUrl; ?>/uploads/user_<?php echo $m['user']['userProfile']['user_id'];  ?>/<?php echo $m['user']['userProfile']['image']?>" /></td>
            <td>&nbsp;&nbsp;&nbsp;</td><?php } else { ?>
            <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl?>/images/user.png" /></td>
                <?php }?>
                <td style="width:100%";>
                <p>
                <b><a href="#"><?php echo $m['user']['userProfile']['first_name']. " ".$m['user']['userProfile']['last_name']; ?></a></b><span style="float:right;margin-right:3px; margin-top: 0px;"><img onclick="deleteMessage(<?php echo $m['id'];?>)" style ="display: none;width: 15px;" id ="img_<?php echo $m['id'];?>" src ="<?php echo Yii::app()->baseUrl?>/images/delete.png"/></span><br/>
                <?php echo $m['message'];?>
                </td>
                   </tr>
                        
                        
                    </table><?php endforeach;?>
        </div>