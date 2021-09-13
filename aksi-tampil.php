<?php 
    include'helper.php';
    $sql = mysqli_query($db_connect, "SELECT * FROM unregistered_uid LIMIT 1");
    $result = array();

    while($row = mysqli_fetch_array($sql)){
        array_push($result, array('uid'=> $row[1]));
    }

    echo json_encode(array("result"=>$result));
