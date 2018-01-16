<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        html, body, #map-canvas {
            margin: 0;
            padding: 0;
            height: 100%;
        }
    </style>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&libraries=places"></script> -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCyB6K1CFUQ1RwVJ-nyXxd6W0rfiIBe12Q"
  type="text/javascript">
  </script>
    <script>

        var directionsDisplay;
        var directionsService = new google.maps.DirectionsService();
        var map;

        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer();
            var cantho = new google.maps.LatLng(10.0309641000, 105.7689041000);
            var mapOptions = {
                zoom: 15,
                // mapTypeId: google.maps.MapTypeId.ROADMAP,
                center: cantho
            }
            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
            directionsDisplay.setMap(map);

        }

        function calcRoute() {
            var start = document.getElementById("start").value;
            var end = document.getElementById("end").value;


            var waypts = [];
            var checkboxArray = document.getElementById('waypoints');
            for(var i = 0; i < checkboxArray.length; i++) {
                if(checkboxArray.options[i].selected == true) {
                    waypts.push({
                        location: checkboxArray[i].value,
                        stopover: true
                    });
                }
            }


            var request = {
                origin: start,
                destination: end,
                waypoints: waypts,
                travelMode: google.maps.TravelMode.DRIVING
            };
            directionsService.route(request, function(response, status) {
                if(status == google.maps.DirectionsStatus.OK) {
                    directionsDisplay.setDirections(response);
                    var route = response.routes[0];
                    //  alert(route.legs[1].duration.text);
                    var summaryPanel = document.getElementById('directions_panel');
                    summaryPanel.innerHTML = '';
                    // For each route, display summary information.
                    for(var i = 0; i < route.legs.length; i++) {
                        var routeSegment = i + 1;
                        summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
                        summaryPanel.innerHTML += route.legs[i].start_address + ' đến ';
                        summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                        summaryPanel.innerHTML += route.legs[i].duration.text + '<br>';

                        summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                        
                        
                    }
                    

                }

            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</head>
<body>
    <!--  <div id="map-canvas"></div>-->
    <div>
        <strong>Start: </strong>
        <select id="start" onChange="calcRoute();">
            <option value="dai hoc can tho">ĐH Cần Thơ</option>
            <option value="dai hoc y duoc can tho">ĐH Y Cần Thơ</option>
            <option value="cao dang can tho">CĐ Cần Thơ</option>

            
        </select>
        <strong>End: </strong>
        <select id="end" onChange="calcRoute();">
            <option value="dai hoc y duoc can tho">ĐH Y Cần Thơ</option>
            <option value="dai hoc can tho">ĐH Cần Thơ</option>
            
        </select>
    </div>

    <div>
        <strong>Mode of Travel: </strong>
        <select multiple id="waypoints" id="mode" onChange="calcRoute();">
            <option value="DRIVING">Driving</option>
            <option value="WALKING">Walking</option>
            <option value="BICYCLING">Bicycling</option>
            <option value="TRANSIT">Transit</option>
        </select>

        

    </div>
    <div>
        <select multiple id="waypoints" onChange="calcRoute();">
            <option value="bassi">bassi</input>
            <option value="chainpura">chainpura</input>
            <option value="Kanauta">Kanauta</input>
            <option value="dai hoc y duoc can tho">ĐH Y Cần Thơ</option>
            <option value="dai hoc can tho">ĐH Cần Thơ</option>
            <option value="cao dang can tho">CĐ Cần Thơ</option>
        </select>
    </div>
    <div id="map-canvas" style="float:left;width:70%; height:40%"></div>

    <div id="directions_panel" style="margin:20px;background-color:#FFEE77; margin-top: 400px"></div>


</body>
</html>