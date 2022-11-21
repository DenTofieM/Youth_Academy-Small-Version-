<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$ID =  mysqli_real_escape_string($connection, $_REQUEST['X_ID']);

$res = array();
$SELECT = "SELECT * FROM Examinations JOIN Sublecture ON Examinations.exam_lec_id=Sublecture.lec_id WHERE Examinations.exam_id='$ID'";
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
/*
$SELECT = "SELECT * FROM (Examinations LEFT OUTER JOIN Students ON Examinations.exam_batch=Students.std_batch) LEFT OUTER JOIN Results ON Examinations.exam_id=Results.res_exam_id WHERE Examinations.exam_id='$ID' AND Students.std_id=Results.res_std_id";

//$SELECT = "SELECT std_id, std_name, res_mark FROM (Examinations LEFT OUTER JOIN Students ON Examinations.exam_batch=Students.std_batch) LEFT OUTER JOIN Results ON Students.std_id=Results.res_std_id WHERE Examinations.exam_id='$ID' AND (Examinations.exam_id=Results.res_exam_id OR Results.res_exam_id IS NULL)";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $user = array();
        while($row = mysqli_fetch_array($result)){
            array_push($user,$row);
        }
        $res['batchinfopos'] = $user;
        mysqli_free_result($result);
        //DB_Connection_Close($connection);
    }
}

$SELECT = "SELECT * FROM (Examinations LEFT OUTER JOIN Students ON Examinations.exam_batch=Students.std_batch) LEFT OUTER JOIN Results ON Examinations.exam_id=Results.res_exam_id WHERE Examinations.exam_id='$ID' AND Students.std_id<>Results.res_std_id";

if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $user = array();
        while($row = mysqli_fetch_array($result)){
            array_push($user,$row);
        }
        $res['batchinfoneg'] = $user;
        mysqli_free_result($result);
        DB_Connection_Close($connection);
    }
}*/
DB_Connection_Close($connection);
header("Content-type: appplication/json");
echo json_encode($res);

?>