<?php
$hash = sha1(rand(1,1000  ) );
echo $hash;
?>


<?php
require_once('database/connection.php');
require_once('includes/output.html.php');
require_once('function/data_holder.php');

$conn = connection(); 
$sql = "SELECT email FROM users where user_id =4";
$result = $conn->query($sql);
while($r = $result->fetch_assoc()){
	   
}

?>