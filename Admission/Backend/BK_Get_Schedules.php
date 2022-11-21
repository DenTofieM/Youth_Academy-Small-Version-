<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();
$res = array();
$SELECT = "SELECT * FROM Schedules JOIN Teachers ON Schedules.schd_teacher=Teachers.tch_id";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $user = array();
        while($row = mysqli_fetch_array($result)){
            array_push($user,$row);
        }
        $res['schedules'] = $user;
        mysqli_free_result($result);
        DB_Connection_Close($connection);
    }
}
header("Content-type: appplication/json");
echo json_encode($res);

?>