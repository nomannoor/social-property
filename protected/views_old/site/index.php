<style type="text/css">
        #map_canvas {height:400px;width:auto;}
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
        var map;
        var markersArray = [];

function ShowMap() {
  
 
  navigator.geolocation.getCurrentPosition(showLocation,errorHandler);
 
 
    function showLocation(position) {
    var latitude = position.coords.latitude;
    var longitude = position.coords.longitude;
    
    initMap(latitude,longitude);
}

    function errorHandler(err) {
    if(err.code == 1) {
    alert("Error: Access is denied!");
    }else if( err.code == 2) {
        alert("Error: Position is unavailable!");
    }
        }
}

        function initMap(lat,lon)
        {
            var locations=[{"lat":"24.909294847965885","lon":"67.11879459835882"},{"lat":"24.91653434597683","lon":"67.12420193173284"},{"lat":"24.893379","lon":"67.028061"},{"lat":"24.893379","lon":"67.028061"}];
           $.post('<?php echo Yii::app()->baseUrl . "/index.php/user/indexlocation"; ?>', 
                function(data) {
                  
                  
                  
                    var map = new google.maps.Map(document.getElementById('map_canvas'), {
                      zoom: 10,
                      center: new google.maps.LatLng(lat, lon),
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                    });

                    var infowindow = new google.maps.InfoWindow();

                    var marker, i;

                    for (i = 0; i < locations.length; i++) {  
                      marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i].lat, locations[i].lon),
                        map: map
                      });

                      google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                          infowindow.setContent(locations[i].lat+' '+locations[i].lon);
                          infowindow.open(map, marker);
                        }
                      })(marker, i));
                    }
                });
            
        }
        
function showMap(){
$('#Map').show();
ShowMap();
$('#mapBtn').html('Hide Map');
$('#mapBtn').attr('onclick','');
$('#mapBtn').attr('onclick','hideMap()');
}        
function hideMap(){
$('#Map').hide();
$('#mapBtn').html('Show Map');
$('#mapBtn').attr('onclick','');
$('#mapBtn').attr('onclick','showMap()');
}        

    </script>
    <style>
        hr {
  background: #ddd; 
  clear: both; 
  float: none; 
  width: auto; 
  height: 1px;
  margin: 0 0 1.4em;
  border: none; 
  margin:20px 50px 20px 50px;
}
    </style>
    <div style="margin:60px 0px 0px 50px"><a href="javascript:void(0)" onclick="showMap()" class="label label-info" id="mapBtn">Show Map</a></div>
    
    <div class="well" id="Map" style="display:none;margin:20px 50px 50px 50px">
        <h4>Map Locations :</h4>
        <div id="map_canvas" ></div>
    </div>
    <hr>
     <div class="shiftcontainer" style="width:auto;margin: 20px 50px 50px 50px" id="mainDiv">
    <div class="shadowcontainer">
        <div id="inner" class="innerdiv">
            <table id="row_1" class="well-for-table" style="margin-bottom:15px">
                    <tbody>
                        <tr>
                                                <td><img width="50" height="50" src="/social-property/uploads/user_35/Hydrangeas.jpg"></td>
                                                <td>&nbsp;&nbsp;&nbsp;</td>
                        
                        <td style="width:100%;">
                            
                            <p>                                <b><a href="/social-property/index.php/user/viewprofile/userId/35"><u>Noman Noor</u></a></b> posted on <b><a href="/social-property/index.php/businesspage/viewpage/2"><u>Asjdlkasjdl</u></a></b><span style="float:right; font-size: 10px;margin-right:3px;">2 days ago</span><br>
                                
                                this is first post of business page<br>
                                <!--<img src="" />-->
                                
                        </p></td>
                    </tr>

                </tbody></table>

                           </div>
    </div>
    
</div>