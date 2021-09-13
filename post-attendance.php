<?php
require_once('helper.php');

    $query = mysqli_query($db_connect,"SELECT HOUR(attendance_out) AS keluar FROM operation WHERE id = '1' LIMIT 1");
    $result = $query->fetch_assoc();
    $timenow = (int) date('H');
    $time = (int) $result['keluar'];


    if ($timenow >= $time) {
        out($db_connect);
    }else{
        in($db_connect);
    }


    function out($db_connect){
            parse_str(file_get_contents('php://input'), $value);
            $uid = $value['uid'];
            $check = "SELECT * FROM employee WHERE uid = '$uid'";
            $sql_check = mysqli_query( $db_connect, $check);

            $current_date = date("Y-m-d");
            $current_time = date("H:i:s");


            $check_date = "SELECT * FROM attendance WHERE uid = '$uid' AND tgl='$current_date'";
            $sql_check_date = mysqli_query( $db_connect, $check_date);

            $query = "UPDATE attendance SET time_out='$current_time' WHERE uid='$uid' AND tgl='$current_date' ";
            $sql = mysqli_query( $db_connect, $query);

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

}

function in($db_connect){
            $uid = $_POST['uid'];
            date_default_timezone_set('Asia/Jakarta');
            $current_date = date("Y-m-d");
            $current_time = date("h:i:sa");
            $check = "SELECT * FROM employee WHERE uid = '$uid'";
            $sql_check = mysqli_query( $db_connect, $check);

            $check_date = "SELECT * FROM attendance WHERE uid = '$uid' AND tgl='$current_date'";
            $sql_check_date = mysqli_query( $db_connect, $check_date);

             if ($sql_check->num_rows == 0) {
            // echo json_encode(array('message'=>'Maaf kartu tidak terdaftar!'));
                echo "Tidak Terdaftar!";
            } else if ($sql_check_date->num_rows > 0) {
                    // echo json_encode(array('message'=>'Anda sudah absen!'));
                echo "Anda Sudah Absen";
            } else {
                $query = "INSERT INTO attendance(uid,tgl,time_in) VALUES ('$uid','$current_date',now())";
                $sql = mysqli_query( $db_connect, $query);

                $result = array();

                if ($sql) {
                        // echo json_encode(array('message'=>'Absensi Berhasil!'));
                    echo "Berhasil Absen";
                } else {
                        // echo json_encode(array('message'=>'Gagal!'));
                    echo "Gagal Absen, coba lagi!";
                }
            }
}
