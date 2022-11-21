<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$ID = mysqli_real_escape_string($connection, $_REQUEST['ID']);
$Subject = mysqli_real_escape_string($connection, $_REQUEST['Subject']);
$Lecture = mysqli_real_escape_string($connection, $_REQUEST['Lecture']);
$Date = mysqli_real_escape_string($connection, $_REQUEST['Date']);
$STime = mysqli_real_escape_string($connection, $_REQUEST['Start_Time']);
$ETime = mysqli_real_escape_string($connection, $_REQUEST['End_Time']);
$Teacher = mysqli_real_escape_string($connection, $_REQUEST['Teacher']);
$Batch = mysqli_real_escape_string($connection, $_REQUEST['Batch']);

if(!empty($Subject) && !empty($Date) && !empty($Teacher) && !empty($Lecture)){
    
    $UPDATE = "UPDATE Schedules SET schd_subject='{$Subject}', schd_lecture='{$Lecture}', schd_date='{$Date}', schd_starting_time='{$STime}', schd_ending_time='{$ETime}', schd_teacher='{$Teacher}', schd_batch='{$Batch}' WHERE schd_id='{$ID}'";
    $SELECT = mysqli_query($connection, $UPDATE);
    if($SELECT){
        echo "Schedule Updated successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>