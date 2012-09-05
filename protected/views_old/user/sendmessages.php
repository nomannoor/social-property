<script type ="text/javascript">

function deleteMessage(id){
   $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/deletemessage/messageId/"; ?>'+id, 
        function(data) {
            
            
        $("#row_"+id).hide(1000);
        $('#newbody').load('<?php echo Yii::app()->baseUrl?>/index.php/user/inbux');
            
            
        });
   
  
   
    
   
}
</script>


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
    </div>
        <?php $model ="";?>
       <?php echo Chtml::link('New message','', array('class'=>'btn pull-right',));?>
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
                
                <td style="width:100%">
                <p>
                    <b><a href="#"><?php echo ucfirst($m['user']['userProfile']['first_name']. " ".ucfirst($m['user']['userProfile']['last_name'])); ?></a></b><span style="float:right;margin-right:3px; margin-top: 0px;"><img onclick="deleteMessage(<?php echo $m['id'];?>)" style ="display: none;width: 15px;" id ="img_<?php echo $m['id'];?>" src ="<?php echo Yii::app()->baseUrl?>/images/delete.png"/></span><br/>
                <a href ="<?php echo Yii::app()->baseUrl?>/index.php/user/viewmessage/messageId/<?php echo $m['id'];?> "><span style=" font-size: 12px;margin-right:3px;">Subject:</span><b><?php echo $m['subject'];?></b></a><br/><span style=" font-size: 10px;margin-right:10px;"><?php echo $this->checkTime($m->date);?></span>
                </p>
                </td>
                </tr>
                
                        
                    </table>
                     <?php endforeach;?>
        </div>

   
</div>