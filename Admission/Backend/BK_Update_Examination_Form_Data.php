<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$ID = mysqli_real_escape_string($connection, $_REQUEST['ID']);
$Type = mysqli_real_escape_string($connection, $_REQUEST['Type']);
$Subject = mysqli_real_escape_string($connection, $_REQUEST['Subject']);
$Topic = mysqli_real_escape_string($connection, $_REQUEST['Topic']);
$Date = mysqli_real_escape_string($connection, $_REQUEST['Date']);
$Time = mysqli_real_escape_string($connection, $_REQUEST['Time']);
//$Duration = mysqli_real_escape_string($connection, $_REQUEST['Duration']);
$Mark = mysqli_real_escape_string($connection, $_REQUEST['Mark']);
$Batch = mysqli_real_escape_string($connection, $_REQUEST['Batch']);

if(!empty($Subject) && !empty($Date) && !empty($Time) && !empty($Type) && !empty($Batch)){
    

    $UPDATE = "UPDATE Examinations SET exam_ext_type='{$Type}', exam_sub_name='{$Subject}', exam_lec_id='{$Topic}', exam_date='{$Date}', exam_starting_time='{$Time}', exam_total_mark='{$Mark}', exam_batch='{$Batch}' WHERE exam_id='{$ID}'";
    $SELECT = mysqli_query($connection, $UPDATE);
    if($SELECT){
        echo "Examination Update successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>