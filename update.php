<?php
//update.php
$connect = mysqli_connect("localhost", "root", "11111111", "testing");
$query = "
 UPDATE employee SET ".$_POST["name"]." = '".$_POST["value"]."' 
 WHERE id = '".$_POST["pk"]."'";
mysqli_query($connect, $query);
?>

