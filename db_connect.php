<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "incidentmonitor";
  $conn = mysqli_connect($servername, $username, $password,$database);
  if(!$conn){
    die("Connection failed<br>" .mysqli_connect_error());
  }
?>
