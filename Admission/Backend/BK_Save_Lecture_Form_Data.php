<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$Subject = mysqli_real_escape_string($connection, $_REQUEST['Subject']);
$Lecture = mysqli_real_escape_string($connection, $_REQUEST['Lecture']);
$Topic = mysqli_real_escape_string($connection, $_REQUEST['Topic']);

if(!empty($Subject) && !empty($Lecture)){
    $Flag = true;
    $SELECT = "SELECT * FROM Sublecture WHERE (lec_sub_name,lec_name) IN (('$Subject','$Lecture'))";
    if($result = mysqli_query($connection, $SELECT)){
        if(mysqli_num_rows($result)>0){
            //$batch = array();
            if($row = mysqli_fetch_array($result)){
                $Flag = false;
            }
            //$res['batch'] = $batch;
            mysqli_free_result($result);
        }
    }

    if($Flag){
        $INSERT = "INSERT INTO Sublecture(lec_sub_name,lec_name,Lec_topic) VALUES ('{$Subject}','{$Lecture}','{$Topic}')";
        $SELECT = mysqli_query($connection, $INSERT);
        if($SELECT){
            echo "New Lecture Added Successfully";
        }
        else echo "Something wrong here.please check!";
    }else echo "This Lecture is Already Added!!!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>