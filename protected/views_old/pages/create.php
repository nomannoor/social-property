 <script type="text/javascript">
     function GetImage(){
        $.post('<?php echo Yii::app()->baseUrl."/index.php/pages/image"; ?>', 
        function(data) {
          alert(data);  
            
            //$('.well-for-table').html('');
        });
            }
            function GetReload(){
               // $('#newbody').load('<?php echo Yii::app()->baseUrl?>/index.php/pages/create');
               $('#newbody').load('<?php echo Yii::app()->baseUrl."/index.php/pages/create"?>');
            }

    function urlencode(str) {
        str = escape(str);
        str = str.replace('+', '%2B');
        str = str.replace('%20', '+');
        str = str.replace('*', '%2A');
        str = str.replace('/', '%2F');
        str = str.replace('@', '%40');
        return str;
    }

    function urldecode(str) {
        str = str.replace('+', ' ');
        str = unescape(str);
        return str;
    }

    function removeFile(filename){
        //alert(filename);
        $.ajax({
            type: "POST",
            url: "<?php //echo Yii::app()->request->baseUrl; ?>/index.php/lecture/removefile/lectureId/<?php //echo $lectureId; ?>",
            data: "filename="+filename,
            dataType: "script",
            async: false,
            success: function (msg){
                alert ("Done");
                //foreach files
                $('#files tr').each(function() {
                   
                    
                  if($(this).find(".filename").html() == urldecode(filename)){      
                  $(this).find(".filename").html('');
                  $(this).find(".file_upload_progress").html('');
                  $(this).find(".filesize").html('');
                  $(this).find(".file_upload_cancel").html('');
                    }
                    //find the exact tr to remove from the node...
                  
              });
            }
        });
        

    }
    
</script>
   
            
            
 


<table  class ="well" style ="">
    
    <tr><td>    
    <a href="#" class="thumbnail" rel="tooltip" data-title="Tooltip">
        <?php if(Yii::app()->session['imageName']){ ?>
        <img id="user-image" style ="width: 180px; height: 180px;"src="<?php echo Yii::app()->baseUrl.'/uploads/'. Yii::app()->session['imageName']; ?>" alt="">
        <?php } else { ?>
        <img id="user-image" src="http://placehold.it/180x180" alt="">
        <?php }?>
    </a></td></tr>
    <tr><td align ="center"><?php 
    
    $model1 = new XUploadForm;
$this->widget('ext.xupload.XUploadWidget', array(
                    'url' => Yii::app()->createUrl("pages/upload"),
                    'model' => $model1,
                    'attribute' => 'file',
                    
                    //'multiple' => true,
                      //Callback funtion when upload complete
            'options' => array('onComplete' => 'js:function (event, files, index, xhr, handler, callBack) {
                        GetReload();
                        }'
                        ),
                    
));
?>
</td></tr>
    <?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
    'id'=>'pages-create-form',
    'htmlOptions'=>array('class'=>'well'),
)); ?>
<tr><td><?php echo $form->textFieldRow($model, 'company_name', array('class'=>'span3')); ?></td></tr>
<tr><td><?php echo $form->dropDownList($model,'type', CHtml::listData(PagesTypes::model()->findAll(), 'id', 'type'), array('empty'=>'Select Type')); ?></td></tr>
<tr><td><?php echo $form->textFieldRow($model, 'address', array('class'=>'span3')); ?></td></tr>

<tr><td><?php $this->widget('application.extensions.redactor.redactorjs.Redactor', array( 'lang' => 'de', 'toolbar' => 'default', 'model' => $model, 'attribute' => 'description' ));//echo $form->textAreaRow($model, 'description', array('class'=>'span3')); ?></td></tr><br/>
<tr><td><?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'icon'=>'ok', 'label'=>'Create Page')); ?></td></tr>
 
<?php $this->endWidget(); ?>



</table>












