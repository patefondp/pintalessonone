<?php
$connect = mysqli_connect("localhost", "root", "11111111", "form");
$query = "SELECT * FROM employee";
$result = mysqli_query($connect, $query);
$output = array();
var_dump ($result);
while($row = mysqli_fetch_assoc($result)){
 $output[] = $row;
}
echo json_encode($output);
?>