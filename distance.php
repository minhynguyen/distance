<?php 
    function distance($lat1, $lon1, $lat2, $lon2, $unit) {

      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      // $unit = strtoupper($unit);

      if ($unit == "K") {
          return ($miles * 1.609344);
      } else {
          return $miles;
      }
    }

    echo distance(10.0309641000, 105.7689041000, 10.035358, 105.753637, "M") . " Miles<br>";
    echo distance(10.0309641000, 105.7689041000, 10.035358, 105.753637, "K") . " Kilometers<br>";
 ?>
https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=Washington,DC&destinations=New+York+City,NY&key=YOUR_API_KEY
