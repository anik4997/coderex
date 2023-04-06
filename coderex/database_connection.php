<?php
// Database connection start
$connect = mysqli_connect('localhost','coderex','Coderex@12345','products');
if(!$connect){
  die("Not connected".mysqli_error());
}
//  Database connection end
?>