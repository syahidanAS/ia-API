<?php
include 'helper.php';
$sql = mysqli_query($db_connect, "SELECT * FROM unregistered_uid");
$result = array();

while ($row = mysqli_fetch_array($sql)) {
    array_push($result, array('id' => $row[0], 'uid' => $row[1], 'scan_date' => $row[2]));
}

echo json_encode($result);
