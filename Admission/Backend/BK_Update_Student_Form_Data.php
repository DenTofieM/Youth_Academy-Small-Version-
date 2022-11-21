<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$ID = mysqli_real_escape_string($connection, $_REQUEST['S_ID']);
$Name = mysqli_real_escape_string($connection, $_REQUEST['S_Name']);
$Email = mysqli_real_escape_string($connection, $_REQUEST['S_Email']);
$Phone = mysqli_real_escape_string($connection, $_REQUEST['S_Phone']);
$School = mysqli_real_escape_string($connection, $_REQUEST['S_School']);
$Roll = mysqli_real_escape_string($connection, $_REQUEST['S_Roll']);
$Registration = mysqli_real_escape_string($connection, $_REQUEST['S_Registration']);
$Batch = mysqli_real_escape_string($connection, $_REQUEST['S_Batch']);

if(!empty($Name) && !empty($Email) && !empty($Phone) && !empty($Batch)){
   
    $UPDATE = "UPDATE Students SET std_name='{$Name}', std_email='{$Email}', std_phone='{$Phone}', std_school='{$School}', std_roll='{$Roll}', std_reg='{$Registration}', std_batch='{$Batch}' WHERE std_id='{$ID}'";
    $SELECT = mysqli_query($connection, $UPDATE);
    if($SELECT){
        echo "Student Updated successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>