<style type="text/css">
        #map_canvas {height:300px;width:600px;}
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <script type="text/javascript">
        var map;
        var markersArray = [];

$(document).ready(function() {
  
 
  navigator.geolocation.getCurrentPosition(showLocation,errorHandler);
 
 
    function showLocation(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    initMap(latitude,longitude);
    //alert("Latitude : " + latitude + " Longitude: " + longitude);
        }

    function errorHandler(err) {
    if(err.code == 1) {
    alert("Error: Access is denied!");
    }else if( err.code == 2) {
        alert("Error: Position is unavailable!");
    }
        }
 
                                               
   
  
});
        function initMap(lat,lon)
        {
            var latlng = new google.maps.LatLng(lat, lon);
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            placeMarker(latlng);
            document.getElementById("latFld").value = lat;
            document.getElementById("lngFld").value = lon;
            // add a click event handler to the map object
            google.maps.event.addListener(map, "click", function(event)
            {
                // place a marker
                placeMarker(event.latLng);

                // display the lat/lng in your form's lat/lng fields
                document.getElementById("latFld").value = event.latLng.lat();
                document.getElementById("lngFld").value = event.latLng.lng();
            });
        }
        function placeMarker(location) {
            // first remove all markers if there are any
            deleteOverlays();

            var marker = new google.maps.Marker({
                position: location, 
                map: map
            });

            // add marker in markers array
            markersArray.push(marker);

            //map.setCenter(location);
        }

        // Deletes all markers in the array by removing references to them
        function deleteOverlays() {
            if (markersArray) {
                for (i in markersArray) {
                    markersArray[i].setMap(null);
                }
            markersArray.length = 0;
            }
        }
    </script>
<div class="form">

    <?php 
        $form=$this->beginWidget('CActiveForm', array(
	'id'=>'create_page',
	'enableClientValidation'=>true,
        'enableAjaxValidation'=>true,
        'htmlOptions'=>array('class'=>'well','enctype'=>'multipart/form-data'),
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
         ),
         
         
));
           ?>
         

	<table cellspacing="9">
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'company_name'); ?></td>
                    <td><?php echo $form->textField($model,'company_name',array( "class"=>"span3")); ?></td>
                    <td><?php echo $form->error($model,'company_name',array('style'=>'color:red')); ?></td>
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
                    <td><?php echo $form->labelEx($model,'address'); ?></td>
                    <td><?php echo $form->textField($model,'address',array( "class"=>"span3")); ?></td>
                    <td><?php echo $form->error($model,'address',array('style'=>'color:red')); ?></td>
                    
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="emailerror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'address'));
                    $this->widget('bootstrap.widgets.BootAlert');
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
                    <td><?php echo $form->labelEx($model,'type'); ?></td>
                    <td><?php echo $form->dropdownList($model,'type',CHtml::listData(PagesTypes::model()->findAll(),'id','type'),
                                    array(
                                        'prompt'=>'Select Type', 
                                        'class'=>'span3'));  ?></td>
                    
            </div></tr>
            <tr>
                <td>
                    &nbsp;
                </td>
                <td id="typeerror" style="display:none;width:100%;">
                    <?php
                    Yii::app()->user->setFlash('error', $form->error($model, 'user_type'));
                    $this->widget('bootstrap.widgets.BootAlert');
                    ?>
                </td>
        </tr>
        
        
        
        
        <tr><div class="row" >
	
                <?php //echo $model->getThumbnail(); ?>
	
            <br>
	
            <td><?php echo $form->labelEx($model,'image'); ?></td>
		
                <td><?php echo CHtml::activeFileField($model, 'image'); // see comments below ?></td>
	
        </div>
        
        </tr>
            
            <tr><div class="row">
                    <td><?php echo $form->labelEx($model,'description'); ?></td>
                    <td><?php $this->widget('application.extensions.redactor.redactorjs.Redactor', array( 'lang' => 'de', 'toolbar' => 'mini', 'model' => $model, 'attribute' => 'description' ));//echo $form->textArea($model,'description',array( "rows"=>4,"col"=>20)); ?></td>
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
        <!--mapp-->    
        <tr>
            <td>
                Select Location :
            </td>
            <td>
                <div id="map_canvas" style="margin-bottom:10px"></div>
            </td>
        </tr>
        <tr>
            <div class="row">
            <td style ="display: none;">
                Latitude :
            </td>
            <td>
                <input style="display:none" type="text" id="latFld" name="Pages[latitude]">
            </td>
            </div>
        </tr>
        <tr>
            <div class="row">
            <td style ="display: none;" >Longitude : </td>
            <td>
                <input style="display:none" type="text" id="lngFld" name="Pages[longitude]">
            </td>
            </div>
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
