
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'user-signup-form',
    'htmlOptions'=>array('class'=>'well'),
    'enableClientValidation'=>true,
    'enableAjaxValidation'=>true,
)); ?>

    <table cellspacing="9">
        <tr><div class="row">
            <td style='width:150px;'><?php echo $form->labelEx($model,'username'); ?></td>
        <td><?php echo $form->textField($model,'username',array( "class"=>"span3")); ?></td>
        <td style='width:300px;'><?php echo $form->error($model,'username'); ?></td>
    </div></tr>

    <tr><div class="row">
        <td style='width:150px;'><?php echo $form->labelEx($model,'password'); ?></td>
        <td><?php echo $form->passwordField($model,'password',array( "class"=>"span3")); ?></td>
        <td style='width:300px;'><?php echo $form->error($model,'password'); ?></td>
    </div></tr>
    
    <tr><div class="row">
        <td style='width:150px;'><?php echo $form->labelEx($model,'comparePassword'); ?></td>
        <td><?php echo $form->passwordField($model,'comparePassword',array( "class"=>"span3")); ?></td>
        <td style='width:300px;'><?php echo $form->error($model,'comparePassword'); ?></td>
    </div></tr>

    <tr><div class="row">
        <td style='width:150px;'><?php echo $form->labelEx($model,'email'); ?></td>
        <td><?php echo $form->textField($model,'email',array( "class"=>"span3")); ?></td>
        <td style='width:300px;'><?php echo $form->error($model,'email'); ?></td>
    </div></tr>

    <tr><div class="row">
        <td style='width:150px;'><?php echo $form->labelEx($model,'user_type'); ?></td>
        <td><?php echo $form->dropdownList($model,'user_type',CHtml::listData(UserType::model()->findAll(),'id','type'),
                                array(
                                    'prompt'=>'Select Type', 
                                    'class'=>'span3',
                                    'ajax'=> array(                                 
                                    'type' => 'POST')
                                ) )  ;  ?></td>
        <td style='width:300px;'><?php echo $form->error($model,'user_type'); ?></td>
    </div></tr>
     


    <tr><div class="row buttons">
        <td style="padding-left: 109px;"> 
           
        </td>
        <td>
            <?php 
            $this->widget('bootstrap.widgets.BootButton', array(
    'label'=>'Signup',
                'buttonType'=>'submit',
    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // '', 'large', 'small' or 'mini'
)); ?>
        </td>
        
    </div></tr></table>
 
<?php $this->endWidget(); ?>
