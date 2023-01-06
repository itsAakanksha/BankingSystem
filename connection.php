<?php
// create connection
$mysqli = new mysqli("localhost","root",'',"banking");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  
}



?>