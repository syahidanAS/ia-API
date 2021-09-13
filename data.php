<?php

    require_once('helper.php');
    $query = "SELECT * FROM employee";
    $sql = mysqli_query($db_connect, $query);

    $result = array();

    if($sql){
        while($row = mysqli_fetch_array($sql)){
            array_push($result, array(
                'e_id' => $row['e_id'],
                'name' => $row['name'],
                'address' => $row['address'],
            ));
        }
        echo json_encode(array('Employees'=>$result));
    }

?>