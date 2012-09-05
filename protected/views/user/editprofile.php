
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
<div class= "well" style ="height: auto;">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>array('user/profile'),
	'id'=>'project-projects-form',
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'htmlOptions'=>array('enctype'=>'multipart/form-data'),
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
            'validateOnChange'=>true,
        ))); 
//$userId = Yii::app()->user->userId;
//        $model=TesterProfile::model()->findByAttributes(array('user_id' => $userId)); ?>
	
<table cellspacing="9">
	<tr><div class="row" >
		<td><?php echo $form->labelEx($model,'first_name'); ?></td>
		<td><?php echo $form->textField($model,'first_name'); ?></td>
		<td><?php echo $form->error($model,'first_name'); ?></td>
	</div></tr>
    
	<tr><div class="row">
		<td><?php echo $form->labelEx($model,'last_name'); ?></td>
		<td><?php echo $form->textField($model,'last_name'); ?></td>
		<td><?php echo $form->error($model,'last_name'); ?></td>
	</div></tr>
        
        <tr><div class="row">
                    <td><?php  echo $form->labelEx($model,'gender'); ?></td>
                    <td><?php echo $form->dropdownList($model,'gender',CHtml::listData(Gender::model()->findAll(),'id','gender'),
                                  array(
                                            'prompt'=>'Select Gender'
                                       ) )  ;  ?></td>
                    <td><?php echo $form->error($model,'gender');  ?></td>
       </div></tr>
        
        <tr><div class="row">
		<td><?php echo $form->labelEx($model,'dob'); ?></td>
		<td> <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'dob',
                            'options' => array(
                                'showAnim' => 'fold',
                                'dateFormat' => 'yy-mm-dd',
                                'minDate' => '',
                            ),
                            'htmlOptions' => array(
                                //'onChange' => 'autoComplete(this.form)',
                            ),
                        ));
                        ?></td>
		<td><?php echo $form->error($model,'dob'); ?></td>
	</div></tr>
        
        <tr><div class="row">
		<td><?php echo $form->labelEx($model,'address'); ?></td>
		<td><?php echo $form->textField($model,'address'); ?></td>
		<td><?php echo $form->error($model,'address'); ?></td>
	</div></tr>
        
        <tr><div class="row">
		<td><?php echo $form->labelEx($model,'city'); ?></td>
		<td><?php echo $form->textField($model,'city'); ?></td>
		<td><?php echo $form->error($model,'city'); ?></td>
	</div></tr>
        
        <tr><div class="row">
		<td><?php echo $form->labelEx($model,'state'); ?></td>
		<td><?php echo $form->textField($model,'state'); ?></td>
		<td><?php echo $form->error($model,'state'); ?></td>
	</div></tr>
        
       <tr><div class="row">
                    <td><?php  echo $form->labelEx($model,'country_id'); ?></td>
                    <td><?php echo $form->dropdownList($model,'country_id',CHtml::listData(Country::model()->findAll(),'id','name'),
                                  array(
                                            'prompt'=>'Select Country'
                                       ) )  ;  ?></td>
                    <td><?php echo $form->error($model,'country_id');  ?></td>
       </div></tr>
        
       <tr><div class="row">
		<td><?php echo $form->labelEx($model,'contact_number'); ?></td>
		<td><?php echo $form->textField($model,'contact_number'); ?></td>
		<td><?php echo $form->error($model,'contact_number'); ?></td>
	</div></tr>
        
            <tr><div class="row">
                <td><?php echo $form->labelEx($model,'image'); ?></td>
                <td><?php echo $form->fileField($model,'image',array('style'=>'width:377px;')); ?></td>
                <td><?php echo $form->error($model,'image'); ?></td>
            </div></tr>
            
        <?php echo $form->hiddenField($model, 'join_date'); ?>
	<?php echo $form->hiddenField($model, 'user_id'); ?>
        
          <tr><div class="row buttons">
              <td></td><td colspan="2" style="">
                    <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok white', 'label'=>'Submit')); ?>
            </div></tr>
</table> 
<?php $this->endWidget(); ?> 
</div>
   </div>