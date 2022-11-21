<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$Type = mysqli_real_escape_string($connection, $_REQUEST['Type']);
$Subject = mysqli_real_escape_string($connection, $_REQUEST['Subject']);
$Topic = mysqli_real_escape_string($connection, $_REQUEST['Topic']);
$Date = mysqli_real_escape_string($connection, $_REQUEST['Date']);
$Time = mysqli_real_escape_string($connection, $_REQUEST['Time']);
//$Duration = mysqli_real_escape_string($connection, $_REQUEST['Duration']);
$Mark = mysqli_real_escape_string($connection, $_REQUEST['Mark']);
$Batch = mysqli_real_escape_string($connection, $_REQUEST['Batch']);

if(!empty($Subject) && !empty($Date) && !empty($Time) && !empty($Type) && !empty($Batch)){
    
    $INSERT = "INSERT INTO Examinations(exam_ext_type, exam_sub_name, exam_lec_id, exam_date, exam_starting_time, exam_total_mark, exam_batch) VALUES ('{$Type}', '{$Subject}', '{$Topic}', '{$Date}', '{$Time}', '{$Mark}', '{$Batch}')";
    $SELECT = mysqli_query($connection, $INSERT);
    if($SELECT){
        echo "Examination created successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>