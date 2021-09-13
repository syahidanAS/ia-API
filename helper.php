<?php 
$db_connect = mysqli_connect('localhost', 'root', '', 'interconnect_attendance') or die("Gagal");

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

 ?>