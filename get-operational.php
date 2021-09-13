<?php 
require_once('helper.php');


$sql = "SELECT * FROM operation WHERE id = '1'";

if ($result = $db_connect -> query($sql)) {
  while ($row = $result -> fetch_row()) {
    echo $row[1];
  }
  $result -> free_result();
}

$db_connect -> close();
?>