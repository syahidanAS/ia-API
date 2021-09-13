<?php
require_once('helper.php');


$uid = $_POST['uid'];
$current_date = date("Y-m-d H:i:s");

$check = "SELECT * FROM unregistered_uid WHERE uid = '$uid'";
$sql_check = mysqli_query($db_connect, $check);


if ($sql_check->num_rows == 0) {
    $query = "INSERT INTO unregistered_uid (uid,created_at) VALUES ('$uid','$current_date')";
    $sql = mysqli_query($db_connect, $query);

    var_dump($query);

    $result = array();

    if ($sql) {
        // echo json_encode(array('message'=>'Berhasil scan kartu'));
        echo "Berhasil Scan";
    } else {
        // echo json_encode(array('message'=>'Gagal scan kartu!'));
        echo "Gagal Scan";
    }
} else {
    // echo json_encode(array('message'=>'Masih dalam antrean'));
    echo "Dalam Antrean!";
}
