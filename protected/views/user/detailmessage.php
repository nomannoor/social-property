<script type="text/javascript">
 function delMessage(id){
     $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/deletemessage/messageId/"; ?>'+id, 
        function(data) {
            alert('Delete Successfully');
            window.location="<?php echo Yii::app()->baseUrl?>/index.php/user/inbux";
        });
 }   
   
</script>
<div style="width:100%">
    <a href="<?php echo Yii::app()->baseUrl.'/index.php/user/inbux';?>"><input type="button" class="btn-info" value="Back To Message" style="margin-right:10px"/></a>
           
           <?php 
           $user = UserProfile::model()->with('user')->findByAttributes(array('user_id' =>Yii::app()->user->userId));
           foreach($message as $m):
               $senderId=$m->user->userProfile->first_name. " ".$m->user->userProfile->last_name;
               $recId=$m->user_id;
               $recId2=$m->sender_id;
               $messageId=$m->message_id;
               
               
           ?>
                <table class="well-for-table" >

                <tr ><?php if($m->user->userProfile->image) { ?>
                <td><img width="50" style ="height:50px;" src="<?php echo Yii::app()->baseUrl; ?>/uploads/user_<?php echo $m->sender->userProfile->user_id;  ?>/<?php echo $m->sender->userProfile->image;?>" /></td>
                <td>&nbsp;&nbsp;&nbsp;</td><?php } else { ?>
                <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl?>/images/user.png" /></td>
                    <?php }?>
                    <td style="width:100%;">
                    <p>
                    <b><a href="#"><?php echo $m->sender->userProfile->first_name. " ".$m->sender->userProfile->last_name; ?></a></b><span style="float:right;margin-right:3px; margin-top: 0px;opacity:0.5"><?php echo $this->checkTime($m->date); ?></span><br/>
                    <?php echo $m->message;?>
                    </td>

               </tr>


                </table>
            <hr style="margin:5px">
            </table>
            <?php endforeach; ?>
<?php if(Yii::app()->user->userId==$recId){$recvrId=$recId2;} else { $recvrId=$recId;} ?>
<table class="well-for-table" style ="width:100%">
    <form action="<?php echo Yii::app()->baseUrl.'/index.php/user/replymessage';?>" method="POST">
                <tr style="width:100%;" ><td style="width:100%;"><textarea style="height:50px;width:98%; resize: none;margin:10px;border:solid 2px #333" placeholder="write your reply message" name="message"></textarea></td></tr>
                <tr><td style="float:right"><input type="submit" class="btn-info" value="Send" style="margin-right:10px"/></td></tr>
                <input type="hidden" class="span3" style="width:400px;" name="recvrId" value="<?php echo $recvrId;?>"/>
                <input type="hidden" class="span3" style="width:400px;" name="messageId" value="<?php echo $messageId;?>"/>
                
                
    </form>
</table>
</div>

            <!--<div id="replyBox_<?php /*echo $message->id;?>" class="well" style="clear:both;width:500px;display:none">
<?php /** @var BootActiveForm $form */
                /*$model=new Messages;
                $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                    'id'=>'messages-messages-form',
                    'action'=>Yii::app()->baseUrl.'/index.php/user/replymessage',
                    'enableAjaxValidation'=>true,
                    //'htmlOptions'=>array('class'=>'well','onSubmit'=>'return check()'),
                ));*/ ?>
                
                <?php //echo $form->textFieldRow($model, 'user_id', array('class'=>'span3','style'=>'width:400px;','disabled'=>'disabled','id'=>'toUser')); ?>
                <input type="hidden" class="span3" style="width:400px;" name="Messages[user_id]"  id="userId"/>
                <input type="text" class="span3" style="width:400px;" disabled id="toUser"/>
                <?php //echo $form->textFieldRow($model, 'subject', array('class'=>'span3','style'=>'width:400px','disabled'=>'disabled','id'=>'toSubject')); ?>
                <input type="hidden" class="span3" style="width:400px;" name="Messages[subject]"  id="tosubjecthidden"/>
                <?php //echo $form->textAreaRow($model, 'message', array('class'=>'span3','style'=>'height:100px;width:400px')); ?>
               <hr>
                <?php //$this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Submit')); ?>
               
                <?php //$this->endWidget();*/ ?>
</div>-->