<?php


require_once('helper.php');
parse_str(file_get_contents('php://input'), $value);

$uid = $value['uid'];



$check = "SELECT * FROM employee WHERE uid = '$uid'";
$sql_check = mysqli_query($db_connect, $check);

$current_date = date("Y-m-d");
$current_time = date("h:i:s");


$check_date = "SELECT * FROM attendance WHERE uid = '$uid' AND tgl='$current_date'";
$sql_check_date = mysqli_query($db_connect, $check_date);

$query = "UPDATE attendance SET time_out='$current_time' WHERE uid='$uid' AND tgl='$current_date' ";
$sql = mysqli_query($db_connect, $query);

$result = array();

if ($sql_check->num_rows == 0) {
    // echo json_encode(array('message'=>'Kartu tidak terdaftar!'));
    echo "Tidak Terdaftar";
} else if ($sql_check_date->num_rows > 0) {
    // echo json_encode(array('message'=>'Absensi Keluar Berhasil'));
    echo "Berhasil Absensi Keluar";
} else if ($sql_check_date->num_rows == 0) {
    // echo json_encode(array('message'=>'Anda belum melakukan absensi masuk!'));
    echo "Belum Absensi Masuk!";
}
