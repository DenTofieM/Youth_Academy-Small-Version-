<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$ID =  mysqli_real_escape_string($connection, $_REQUEST['X_ID']);

$res = array();

$SELECT = "SELECT * FROM Students WHERE std_id='$ID'";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $user = array();
        while($row = mysqli_fetch_array($result)){
            array_push($user,$row);
        }
        $res['personalinfo'] = $user;
        mysqli_free_result($result);
        //DB_Connection_Close($connection);
    }
}

$SELECT = "SELECT * FROM Examinations LEFT OUTER JOIN Results ON Examinations.exam_id = Results.res_exam_id WHERE Results.res_std_id='$ID'";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $user = array();
        while($row = mysqli_fetch_array($result)){
            array_push($user,$row);
        }
        $res['resultinfo'] = $user;
        mysqli_free_result($result);
        //DB_Connection_Close($connection);
    }
} 
DB_Connection_Close($connection);
header("Content-type: appplication/json");
echo json_encode($res);

?>