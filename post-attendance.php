<?php
require_once('helper.php');

$uid = $_POST['uid'];
$query = mysqli_query($db_connect, "SELECT HOUR(attendance_out) AS keluar FROM operation WHERE id = '1'");
$result = $query->fetch_assoc();
$timenow = (int) date('H');
$time = (int) $result['keluar'];

$check_specific = "SELECT * FROM specific_operation JOIN employee ON specific_operation.emp_id = employee.e_id WHERE employee.uid = '$uid' ";
$sql_check_specific = mysqli_query($db_connect, $check_specific);


if ($timenow >= $time) {
    out($db_connect);
    // out($db_connect);
} else if ($sql_check_specific->num_rows > 0) {
    $sql = "SELECT * FROM specific_operation JOIN operation ON specific_operation.spec_id = operation.id JOIN employee ON specific_operation.emp_id = employee.e_id WHERE employee.uid = '$uid'";

    $result = $db_connect->query($sql);
    while ($row = $result->fetch_assoc()) {
        $specific_time_in = (int)date('G', strtotime($row["attendance_in"]));
        $specific_time_out = (int)date('G', strtotime($row["attendance_out"]));
    }
    $now_time = (int)date("G");


    if ($now_time <= $specific_time_in) {
        // out($db_connect);
        in($db_connect);
    } else if ($now_time >= $specific_time_out) {
        // in($db_connect);
        out($db_connect);
    } else {
        echo "fail!";
    }
} else {
    in($db_connect);
}


function out($db_connect)
{
    parse_str(file_get_contents('php://input'), $value);
    $uid = $value['uid'];
    $check = "SELECT * FROM employee WHERE uid = '$uid'";
    $sql_check = mysqli_query($db_connect, $check);

    $current_date = date("Y-m-d");
    $current_time = date("H:i:s");


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
        echo "BERHASIL\nABSENSI\nKELUAR";
    } else if ($sql_check_date->num_rows == 0) {
        // echo json_encode(array('message'=>'Anda belum melakukan absensi masuk!'));
        echo "BELUM\nABSENSI\nMASUK";
    }
}

function in($db_connect)
{
    $uid = $_POST['uid'];
    date_default_timezone_set('Asia/Jakarta');
    $current_date = date("Y-m-d");
    $current_time = date("h:i:sa");
    $check = "SELECT * FROM employee WHERE uid = '$uid'";
    $sql_check = mysqli_query($db_connect, $check);

    $check_date = "SELECT * FROM attendance WHERE uid = '$uid' AND tgl='$current_date'";
    $sql_check_date = mysqli_query($db_connect, $check_date);


    if ($sql_check->num_rows == 0) {
        // echo json_encode(array('message'=>'Maaf kartu tidak terdaftar!'));
        echo "Tidak Terdaftar!";
    } else if ($sql_check_date->num_rows > 0) {
        // echo json_encode(array('message'=>'Anda sudah absen!'));
        echo "Anda Sudah Absen";
    } else {
        $query = "INSERT INTO attendance(uid,tgl,time_in) VALUES ('$uid','$current_date',now())";
        $sql = mysqli_query($db_connect, $query);

        $result = array();

        if ($sql) {
            // echo json_encode(array('message'=>'Absensi Berhasil!'));
            echo "BERHASIL\nMELAKUKAN\nABSENSI";
        } else {
            // echo json_encode(array('message'=>'Gagal!'));
            echo "GAGAL\nCOBA LAGI! ";
        }
    }
}
