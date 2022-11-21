<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();
$res = array();
$SELECT = "SELECT * FROM Subjects";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        $subject = array();
        while($row = mysqli_fetch_array($result)){
            array_push($subject,$row);
        }
        $res['subject'] = $subject;
        mysqli_free_result($result);
        DB_Connection_Close($connection);
    }
}
header("Content-type: appplication/json");
echo json_encode($res);

?>