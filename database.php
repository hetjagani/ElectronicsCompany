<?php
  $host_name = 'db5002396183.hosting-data.io';
  $database = 'dbs1915877';
  $user_name = 'dbu492104';
  $password = 'ElectronicsCompany0)';

  $conn = new mysqli($host_name, $user_name, $password, $database);

  if ($conn->connect_error) {
    die('<p>Failed to connect to MySQL: '. $link->connect_error .'</p>');
  } 
?>