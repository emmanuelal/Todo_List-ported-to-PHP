<?php
//showimg.php
$file = $_GET['thefile'];
//Check to see if the image exists.
if (!is_file($file) || !file_exists($file))
exit;
?>
<img src="<?= $file ?>" alt="" />