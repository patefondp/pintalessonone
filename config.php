<?php
define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '11111111');
define('DBNAME', 'form');

function connect(){
  $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
  mysqli_set_charset($conn, "utf8");
  if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
  return $conn;
}

?>