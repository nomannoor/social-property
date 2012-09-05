<script type="text/javascript">
var stat=false;
function check(){
    
    var user=$('#Messages_user_id').val();
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
 return stat;
}
</script>

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'messages-messages-form',
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
                  'style'=>'height:30px',
          ),
         ));  


?>
<?php //echo $form->error($model, 'user_id'); ?>
<?php echo $form->textFieldRow($model, 'subject', array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model, 'message', array('class'=>'span3','style'=>'height:100px;')); ?>

<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Submit')); ?>
 
<?php $this->endWidget(); ?>


