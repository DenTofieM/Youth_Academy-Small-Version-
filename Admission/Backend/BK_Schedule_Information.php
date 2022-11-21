<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$ID =  mysqli_real_escape_string($connection, $_REQUEST['X_ID']);

$res = array();
$SELECT = "SELECT * FROM (`Schedules` JOIN Sublecture ON Schedules.schd_lecture=Sublecture.lec_id) JOIN Teachers ON Teachers.tch_id=Schedules.schd_teacher WHERE Schedules.schd_id='$ID'";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $user = array();
        while($row = mysqli_fetch_array($result)){
            array_push($user,$row);
        }
        $res['topicinfo'] = $user;
        mysqli_free_result($result);
        //DB_Connection_Close($connection);
    }
}

$SELECT = "SELECT * FROM Schedules JOIN Students ON Schedules.schd_batch=Students.std_batch WHERE Schedules.schd_id='$ID'";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $user = array();
        while($row = mysqli_fetch_array($result)){
            array_push($user,$row);
        }
        $res['batchinfo'] = $user;
        mysqli_free_result($result);
        //DB_Connection_Close($connection);
    }
}
DB_Connection_Close($connection);
header("Content-type: appplication/json");
echo json_encode($res);

?>