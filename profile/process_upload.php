<?php
session_start();
require_once('../function/data_holder.php');
require_once('../database/connection.php');
require_once('../includes/output.html.php');
$con = connection();



$find_user = "SELECT * FROM users WHERE email = '".$_SESSION['valid_user']."'  ";
$result = $con->query($find_user);
if($result){
	 while($row = $result->fetch_assoc()){
	 	   $_SESSION['user_id'] = $row['user_id'];
	 }
}else{
	 print("<b>unable to make connection </b>");
	 exit;
}



//process_upload.php
//Allowed file MIME types.
$target_dir = "../user_image/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

 

/// after getname and post name in database.

$picture = basename( $_FILES["fileToUpload"]["name"]);
$find_user = "SELECT * FROM users";
$query = " INSERT INTO profiles( p_id , user_image , picture_id , profile_id) 
           VALUES ('".$_SESSION['user_id']."','".$picture."','".$_SESSION['user_id']."','".$_SESSION['user_id']."' ) ";

$insert = $con->query($query);
if($insert){
	header("Location:add-name-info.php");
	exit();
}
else{

	echo $picture;
	//header("Location:add_profile.php");
	//exit();
}

?>
