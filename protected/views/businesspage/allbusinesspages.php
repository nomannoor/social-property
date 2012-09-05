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
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<a style="margin-top:15px;float:left"href ="<?php echo Yii::app()->baseUrl?>/index.php/subpage/create">        
<?php $this->widget('bootstrap.widgets.BootLabel', array(
    'type'=>'success', // '', 'success', 'warning', 'important', 'info' or 'inverse'
    'label'=>'create sub-page',
    
)); ?>
</a>


<?php

function MapLink($val){
    
    $page=Pages::model()->findByPk($val);
    
 return $val =$page['latitude'].$page['longitude'];
}
function ShowMap()
{
    echo "<script>alert('asd');</script>";
}
function SabPages($val){
    
    
    $page =  SubPage::model()->findAll('bussiness_page_id=:pageId',array(':pageId'=>$val));
    
    
    $val='';
    if(!empty($page))
    {
        $val='<ul>';
    foreach($page as $p):
        $val .="<li>".$p['name']."</li>";
    endforeach;
    $val.='</ul>';
    }
    
 return $val;
}


$model=new Pages;
$this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $model->searchall(),
            'id' => 'my-grid-view',
            'ajaxUpdate'=>true,
            'columns' => array(
                
                array(
                    'class' => 'EImageColumn_businessPages',
                    'name' => "image",
                    'htmlOptions' => array('style' => 'width: 100px;height:100px'),
                ),
                array(
                    'name' => 'company_name',
                    'type' => 'raw',
                    'value' => 'CHtml::link(ucfirst($data->company_name), $this->grid->controller->createUrl("businesspage/viewpage", array("id" => $data->id)))',
                ),
                array(
                    'name' => 'address',
                    'type' => 'raw',
                    //'value' => 'CHtml::link(CHtml::encode($data->title))',$this->grid->controller->createUrl("lecture/course", array("id" => $data->id, "title" => $this->replaceString($data->title));
                    
                ),
                array(
                    'name' => 'domain',
                    'type' => 'raw',
                    //'value' => 'CHtml::link(CHtml::encode($data->title))',$this->grid->controller->createUrl("lecture/course", array("id" => $data->id, "title" => $this->replaceString($data->title));
                    
                ),
                array(
                    'name' => 'description',
                    'type' => 'raw',
                    'value' => 'substr($data->description,0,20)."...."',
                    
                ),
                array(
                    //'name' => 'description',
                    'header'=>'Sub Pages',
                    'type' => 'raw',
                    'value' => 'SabPages($data->id)',
                    
                ),
                array(
                   
                    'header'=>'Location',
                    'type' => 'raw',
                    'value' => 'CHtml::link("Show Location","javascript:void(0)",array("onclick"=>"initMap($data->latitude,$data->longitude)"))',
                    
                ),
                array(
                        'header'=>'Actions',
                        'type'=>'raw',
                        'value'=>'CHtml::ajaxLink(CHtml::image("' . Yii::app()->request->baseUrl . '/images/delete.png", "Delete", array("title"=>"Delete","class"=>"grid_icon")), Yii::app()->createUrl("businesspage/deletebusinesspages"), array("type"=>"POST", "data"=>array("id"=>$data->id, "action"=>"delete"), "success"=>"jsDelete"), array("onclick"=>"$(\'.grid-view\').addClass(\'grid-view-loading\')", "class"=>"delete", "confirm"=>"Are you sure?\r\nDrafts are permanently deleted and are not recoverable.") )',
                ),
            ),
        ));
?>
<style type="text/css">
        #map_canvas {height:300px;width:500px;}
        
    </style>
<script>

function jsDelete()
{
    
    $('.grid-view').removeClass('grid-view-loading');
    $.fn.yiiGridView.update("my-grid-view");
    
    
}
function initMap(lat,lon)
        {
            var map;
            var latlng = new google.maps.LatLng(lat, lon);
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
               var marker = new google.maps.Marker({
                position: latlng, 
                map: map
            });
            $('#map').show();
        }
function CloseMap()
{
    $('#map').hide();
}
</script>
<div class="well" id="map" style="height:310px;width:510px;display:none">
     <a class="close" onclick="CloseMap()"style="float:right;margin-top:-15px;margin-right: -10px">&times;</a>
<div id="map_canvas"></div>
</div>