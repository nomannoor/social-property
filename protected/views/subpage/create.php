
<div class="form">

    <?php 
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create_page',
	'enableClientValidation'=>false,
        'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'well','enctype'=>'multipart/form-data'),
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
         ),
         
         
));
           ?>
         

	<table cellspacing="9">
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'name'); ?></td>
                    <td><?php echo $form->textField($model,'name',array( "class"=>"span3")); ?></td>
                    <td><?php echo $form->error($model,'name',array('style'=>'color:red')); ?></td>
                    
                    
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="usererror" style="display:none;width:100%;">
                    <?php
                    //Yii::app()->user->setFlash('error', $form->error($model, 'company_name'));
                    //$this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>

            
        
        <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'domain'); ?></td>
                    <td><?php echo $form->textField($model,'domain',array( "class"=>"span3")); ?></td>
                    <td><?php echo $form->error($model,'domain',array('style'=>'color:red')); ?></td>
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="usererror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'domain'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
        
        
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'bussiness_page_id'); ?></td>
                    <td><?php echo $form->dropdownList($model,'bussiness_page_id',CHtml::listData(Pages::model()->findAll('user_id=:Id',array(':Id'=>Yii::app()->user->userId)),'id','company_name'),
                                    array(
                                        'prompt'=>'Select Page', 
                                        'class'=>'span3',
                                        'ajax'=> array(                                 
                                        'type' => 'POST')
                                    ) )  ;  ?></td>
                    
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                
                <td id="typeerror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'bussiness_page_id'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
        
        
        
        
            
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'description'); ?></td>
                    <td>
                        
       <?php $this->widget('application.extensions.redactor.redactorjs.Redactor', array( 'lang' => 'de', 'toolbar' => 'default', 'model' => $model, 'attribute' => 'description' ));
       ////echo $form->textArea($model,'description',array( "class"=>"span3")); ?>
                    </td>
                    <td><?php echo $form->error($model,'description',array('style'=>'color:red')); ?></td>
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="passerror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'description'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
            
          
            
            <tr><div class="row buttons">
                    <?php // echo CHtml::submitButton('Submit'); ?>
                    <td style="padding-left: 135px;"></td>
                    <td>
                         <?php 
                        $this->widget('bootstrap.widgets.BootButton', array(
                            'label'=>'Create',
                            'buttonType'=>'submit',
                            'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                            'size'=>'large', // '', 'large', 'small' or 'mini'
                        )); ?>

                    </td>
            </div></tr>
        </table>

<?php $this->endWidget(); ?>

</div><!-- form -->