<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$ID = mysqli_real_escape_string($connection, $_REQUEST['T_ID']);
$Name = mysqli_real_escape_string($connection, $_REQUEST['T_Name']);
$Email = mysqli_real_escape_string($connection, $_REQUEST['T_Email']);
$Phone = mysqli_real_escape_string($connection, $_REQUEST['T_Phone']);
$Institution = mysqli_real_escape_string($connection, $_REQUEST['T_Institution']);
$Department = mysqli_real_escape_string($connection, $_REQUEST['T_Department']);
$Subject = mysqli_real_escape_string($connection, $_REQUEST['T_Subject']);

if(!empty($Name) && !empty($Email) && !empty($Phone) && !empty($Institution)){
   
    $UPDATE = "UPDATE Teachers SET tch_name='{$Name}', tch_email='{$Email}',tch_phone='{$Phone}',tch_institution='{$Institution}', tch_department='{$Department}', tch_subject='{$Subject}' WHERE tch_id='{$ID}'";
    $SELECT = mysqli_query($connection, $UPDATE);
    if($SELECT){
        echo "Teacher Updated successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>