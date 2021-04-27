<?php
  $host_name = 'db5002343960.hosting-data.io';
  $database = 'dbs1879206';
  $user_name = 'dbu968869';
  $password = 'Database_3lectronics';

  $conn = new mysqli($host_name, $user_name, $password, $database);

  if ($conn->connect_error) {
    die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
  } 
?>