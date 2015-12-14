<?php


$json_url = "http://freegeoip.net/json";
 $key_movie = "";
 // comic book api key
 $key_comic_book = "4806dcc3d82b135dd42ef4aca6ac4300075989f4";
 // tv guide api key
 
 try{

	@$link = file_get_contents($json_url);
	if($link){
	     $place = json_decode($link, true);
	     $city = $place['city'];
	     $lat =  $place['latitude'];
	     $long = $place['longitude'];
	     $country = $place['country_name'];

	}else{
	   throw new Exception(" OOOps An Error Occured try Back Later or Try refreshing ", 1);
	}

$tv_guide_key ="http://api.tvmedia.ca/tv/v4/lineups/36617/listings?api_key=1738c30f0ebf18477117206b29b9183d&timezone=".$city."&showtype[]=M&showtype[]=6&detail=brief";
	@$channel = file_get_contents($tv_guide_key);
	 if($channel){
	 	   $tv_info = json_decode($channel,true);
	 	     for($i = 0; $i< count($tv_info[0]); $i++){
                   $ch = $tv_info->{'network'};
                   print_r($ch);
	 	     }// for Loop 	   	 
	    }else{
	    	 //throw new Exception("Unable To Make Request ", 1);
	    	     
	    }

 }catch(Exception $e){
	 echo $e->getMessage();
}

 ?>