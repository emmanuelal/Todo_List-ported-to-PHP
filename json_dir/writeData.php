<?php


function create_file($source){
   $new_date = Date("m-d-y");
   $file = "json_dir/guardian_".$new_date.".json";
try{   
   if(file_exists($file)){
        throw new Exception("file exists ");
   }else{ 
        $new = touch($file);
        if(!$new){
         throw new Exception("file not created");
         exit(0);
      }//if 
      // else statement 
      $local_file = fopen($file,'w');
      if(fwrite($local_file, strlen($source), 998) == false){
            return false;
      }
      fclose($local_file);
      $c_permissions = chmod($new, 0666);  
    }//else
 }catch(Exception $e){
 	  echo $e->getMessage();
  }  
  return $file;
}// create file



$address = "http://content.guardianapis.com/search?show-elements=image&api-key=agu5esashhuk6yqngrwj4yt6";
@$getter = file_get_contents($address);
if(!$getter){
	  echo "unable open file ";
	  exit;
} else{ 
  if(create_file($getter) == true){
      $dir = "json_dir/";
      $files = scandir($dir);
      if(sizeof($files) < 0){
         print("no files in this directory\n");
      }else{
          print(count($files));
      }
      print_r($files);
              	     
   }      
 }   
?>
