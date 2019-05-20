<?php
include "db-config.php";
$mysqli = new mysqli($HOST, $USERNAME, $PASSWORD, $DBNAME);
  if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
  }
?>

