<?php

/***************************************************************************************************
 This is proprietary software which belong to it's owner.
 And may not be reuse without permission of the developer.
 Author:Emmanuel Alcime
 Date: November 28, 2015
 
***************************************************************************************************/

$address = "https://freegeoip.net/json"; // this is freegeoip.net address 

$warning = "unable to open file at this time."; // warning just in case we don't get a answer. 

try{
      $info = file_get_contents($address);
      if($info != true){
      	 throw new Exception("unable to open file at this time. ");
      }else{
      	 $j_array = json_decode($info, true);
      	 $ip = $j_array['ip'];
      	 $region_code = $j_array['region_code'];
      	 $region_name = $j_array['region_name'];
      	 $city = $j_array['city'];
          $time_zone = $j_array['time_zone'];
          $latitude = $j_array['longitude'];
          $longitude = $j_array['longitude'];
          $metro_code = $j_array['metro_code'];

      }


}catch(Exception $e){
	   echo $e->getMessage();
}

?>
