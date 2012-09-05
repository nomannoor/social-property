

<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'messages-messages-form',
    'enableAjaxValidation'=>true,
    'htmlOptions'=>array('class'=>'well'),
)); ?>
 
<?php echo $form->textFieldRow($model, 'subject', array('class'=>'span3')); ?>
<?php echo $form->textAreaRow($model, 'message', array('class'=>'span3','style'=>'height:100px;')); ?>


<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Submit')); ?>
 
<?php $this->endWidget(); ?>


