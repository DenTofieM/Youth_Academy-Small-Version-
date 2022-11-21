<?php

include "../Database/DB_Connector.php";


$connection = DB_Connection_Start();

$Subject = mysqli_real_escape_string($connection, $_REQUEST['Subject']);

$res = array();
$SELECT = "SELECT * FROM Sublecture WHERE lec_sub_name='$Subject'";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $lecture = array();
        while($row = mysqli_fetch_array($result)){
            array_push($lecture,$row);
        }
        $res['lecture'] = $lecture;
        mysqli_free_result($result);
        DB_Connection_Close($connection);
    }
}
header("Content-type: appplication/json");
echo json_encode($res);

?>