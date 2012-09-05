<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'modal')); ?>
<?php
    $login_form_frame = "<iframe style='width:100%;height:330px;border:none;' src='".Yii::app()->baseUrl."/index.php/user/login'></iframe>";
    $signup_form_frame = "<iframe style='width:100%;height:330px;border:none;' src='".Yii::app()->baseUrl."/index.php/user/signup'></iframe>";
?>
<div class="modal-body">
<a class="close" data-dismiss="modal">&times;</a>
    <?php $this->widget('bootstrap.widgets.BootTabbable', array(
    'type'=>'tabs',
    'placement'=>'above', // 'above', 'right', 'below' or 'left'
    'tabs'=>array(
        array('label'=>'Login', 'content'=>$login_form_frame, 'active'=>true),
        array('label'=>'Signup', 'content'=>$signup_form_frame),
    ),
    'htmlOptions'=>array('style'=>'height:auto;'),
)); ?>
</div>
 
<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.BootButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
</div>
 
<?php $this->endWidget(); ?>




