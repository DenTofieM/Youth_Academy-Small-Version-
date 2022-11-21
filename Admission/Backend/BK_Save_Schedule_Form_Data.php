<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$Subject = mysqli_real_escape_string($connection, $_REQUEST['Subject']);
$Lecture = mysqli_real_escape_string($connection, $_REQUEST['Lecture']);
$Date = mysqli_real_escape_string($connection, $_REQUEST['Date']);
$STime = mysqli_real_escape_string($connection, $_REQUEST['Start_Time']);
$ETime = mysqli_real_escape_string($connection, $_REQUEST['End_Time']);
$Teacher = mysqli_real_escape_string($connection, $_REQUEST['Teacher']);
$Batch = mysqli_real_escape_string($connection, $_REQUEST['Batch']);

if(!empty($Subject) && !empty($Date) && !empty($STime) && !empty($ETime) && !empty($Teacher)){
    
    $INSERT = "INSERT INTO Schedules(schd_subject, schd_lecture, schd_date, schd_starting_time, schd_ending_time, schd_teacher, schd_batch) VALUES ('{$Subject}', '{$Lecture}', '{$Date}', '{$STime}', '{$ETime}', '{$Teacher}', '{$Batch}')";
    $SELECT = mysqli_query($connection, $INSERT);
    if($SELECT){
        echo "Schedule created successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>