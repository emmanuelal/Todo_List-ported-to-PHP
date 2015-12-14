<?php

// curl libarary function for GET and POST methods

function get_file( $ip ){
    $get_info = exec('searcher.py', $ip );
    if(!$get_info){
       return false;
    }else{
    	 return $get_info;
    }
}

   

?>