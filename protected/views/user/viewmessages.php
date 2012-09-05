<style>#notify{margin:0px auto;font-size:13px;width:100%;text-shadow:0 1px 0 rgba(255,255,255,0.4)}#notify_error{margin:15px 0 5px;border:1px solid #a34625;background-color:#f9d9ce;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}#notify_success{margin:15px 0 5px;border:1px solid #25a336;background-color:#dfffe3;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}#notify_message{margin:15px 0 5px;border:1px solid #284797;background-color:#cedaf9;padding:8px 4px 4px;height:20px;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px}.flash_icon_container{margin-left: 150px; margin-right: 30px;float:left;width:20px;text-align:right;padding-right:8px;height:20px;position:relative;top:-3px}.flash_messages_container{margin-left: 200px; font-family:'Helvetica Neue', 'Myriad Pro', Calibri, 'trebuchet ms', Tahoma, Arial, Verdana, sans-serif;color:#333}.notify_message{width:400px;height:40px;background-color:#A6D6FF}</style>
<script type ="text/javascript">

function deleteMessage(id){
      var check=confirm('Are You Sure You Want To Delete This Message.');  
           if(check){
           $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/deletemessage/messageId/"; ?>'+id, 

                function(data) {


                $("#row_"+id).hide(1000);
                $('#newbody').load('<?php echo Yii::app()->baseUrl?>/index.php/user/inbux');


                });
                }
}
</script>
<script type="text/javascript">
var stat=false;
function check(){
    
    
    var user=$('#Messages_user_id').val();
    if(user!='')
     {
                $.post('<?php echo Yii::app()->baseUrl."/index.php/user/checkusernames/users/";?>'+user,
                function(data) {
                   if(data=='1')
                     {
                         alert('Invalid User select');
                         $('#Messages_user_id').val('');

                     }
                   else
                     {

                        $('#messages-messages-form').attr("onSubmit", '');
                        $('#messages-messages-form').attr("onSubmit", 'return true');
                        $('#messages-messages-form').hide();
                        $('.btn').trigger('click'); 

                    } 
               });
     }
    else
      {
          alert('Write Some Message');
          return false;
      }
 return stat;
}
</script>

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
<div class="row-fluid">

    <div class="span12">
        
    <a href ="<?php echo Yii::app()->baseUrl?>/index.php/user/inbux">
  <?php $this->widget('bootstrap.widgets.BootLabel', array(
    'type'=>'info', // '', 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Messages',
)); ?></a>
<a href ="<?php echo Yii::app()->baseUrl?>/index.php/user/sendmessages">        
<?php $this->widget('bootstrap.widgets.BootLabel', array(
    'type'=>'success', // '', 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'Send Items',
    
)); ?>
    
</a>
        
 <?php echo CHtml::link('New message', '#myModal', array('class' => 'btn pull-right', 'data-toggle' => 'modal')); ?>       
    </div>
    
        
        <?php $this->beginWidget('bootstrap.widgets.BootModal', array('id' => 'myModal')); ?>

            <div class="modal-header">
                <a class="close" data-dismiss="modal">&times;</a>
                <h3>Messaging</h3>
            </div>

            <div class="modal-body" style='width: 500px; height: 400px; overflow: hidden;'>
                <!--<iframe style='width:100%;height:375px;border:none;'   src='<?php echo Yii::app()->baseUrl."/index.php/user/newmessages/";?>'></iframe>-->
            
                <?php /** @var BootActiveForm $form */
                $model=new Messages;
                $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                    'id'=>'messages-messages-form',
                    'action'=>Yii::app()->baseUrl.'/index.php/user/newmessages',
                    'enableAjaxValidation'=>true,
                    'htmlOptions'=>array('class'=>'well','onSubmit'=>'return check()'),
                )); ?>
                <label>To </label>

                <?php $this->widget('ext.multicomplete.MultiComplete', array(
                          'model'=>$model,
                          'attribute'=>'user_id',
                          'splitter'=>',',
                         // 'source'=>array('ac1', 'ac2', 'ac3'),
                          'sourceUrl'=>Yii::app()->baseUrl.'/index.php/user/search',
                          // additional javascript options for the autocomplete plugin

                          'options'=>array(
                                  'minLength'=>'1',
                          ),
                          'htmlOptions'=>array(
                                  'size'=>'100',
                                  'style'=>'height:30px;width:400px',
                          ),
                         ));  


                ?>
                <?php //echo $form->error($model, 'user_id'); ?>
                <?php echo $form->textFieldRow($model, 'subject', array('class'=>'span3','style'=>'width:400px')); ?>
                <?php echo $form->textAreaRow($model, 'message', array('class'=>'span3','style'=>'height:100px;width:400px')); ?>
               <hr>
                <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Submit')); ?>

                <?php $this->endWidget(); ?>
            </div>

            <div class="modal-footer">

                <?php
                $this->widget('bootstrap.widgets.BootButton', array(
                    'label' => 'Close',
                    'url' => '#',
                    'htmlOptions' => array('data-dismiss' => 'modal'),
                ));
                ?>
            </div>

    <?php $this->endWidget(); ?>

            
       <?php //echo Chtml::link('New message','', array('class'=>'btn pull-right',));?>
        <div class ="span8">
            <br/><h4>Messages:</h4>
            <hr>
           <?php foreach($messages as $m):
           
?>
            
            <table id ="tbl"class="well-for-table" style ="width:100%">
                
                <tr onmouseout="$('#img_<?php echo $m['id'];?>').hide()" onmouseover="$('#img_<?php echo $m['id'];?>').show()" id ="row_<?php echo $m['id'];?>"><?php if($m['user']['userProfile']['image']) {?>
                
                <td><img width="50" style ="height:50px;" src="<?php if($m->sender_id!=Yii::app()->user->userId){ echo Yii::app()->baseUrl.'/uploads/user_'.$m->sender_id.'/'.$m['sender']['userProfile']['image'];} else { echo Yii::app()->baseUrl.'/uploads/user_'.$m->user_id.'/'.$m['user']['userProfile']['image'] ;}?>" /></td>
                <td>&nbsp;&nbsp;&nbsp;</td><?php } else { ?>
                <td><img width="50" height="50" src="<?php echo Yii::app()->baseUrl?>/images/user.png" /></td>
                <?php }?>
                
                <td style="width:100%">
                <p style ="word-wrap:break-word;">
                    <b><a href="#"><?php if($m->sender_id!=Yii::app()->user->userId){ echo $m['sender']['userProfile']['first_name'].' '.$m['sender']['userProfile']['last_name'] ;} else { echo $m['user']['userProfile']['first_name'].' '.$m['user']['userProfile']['last_name'] ;} //echo ucfirst($m['user']['userProfile']['first_name']. " ".ucfirst($m['user']['userProfile']['last_name'])); ?></a></b><span style="float:right;margin-right:3px; margin-top: 0px;"><img onclick="deleteMessage(<?php echo $m['id'];?>)" style ="display: none;width: 15px;" id ="img_<?php echo $m['id'];?>" src ="<?php echo Yii::app()->baseUrl?>/images/delete.png"/></span><br/>
                <a href ="<?php echo Yii::app()->baseUrl?>/index.php/user/viewmessage/messageId/<?php echo $m['id'];?> "><span style=" font-size: 12px;margin-right:3px;">Subject:</span><b><?php echo $m['subject'];?></b></a><br/><span style=" font-size: 10px;margin-right:10px;"><?php echo $this->checkTime($m->date);?></span>
                </p>
                </td>
                </tr>
                
                        
                    </table>
                     <?php endforeach;?>
        </div>

   
</div>