<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$cnt = 0;
$ID = "";

$SELECT = "SELECT * FROM Teachers";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
            $cnt = $cnt+1;
        }
        mysqli_free_result($result);
    }
}

$cnt = $cnt+1;
if($cnt>=1 && $cnt<=9) $ID = "TID-00".$cnt;
elseif($cnt>=10 && $cnt<=99) $ID = "TID-0".$cnt;
else $ID = "TID-".$cnt;

$Name = mysqli_real_escape_string($connection, $_REQUEST['T_Name']);
$Email = mysqli_real_escape_string($connection, $_REQUEST['T_Email']);
$Phone = mysqli_real_escape_string($connection, $_REQUEST['T_Phone']);
$Institution = mysqli_real_escape_string($connection, $_REQUEST['T_Institution']);
$Department = mysqli_real_escape_string($connection, $_REQUEST['T_Department']);
$Subject = mysqli_real_escape_string($connection, $_REQUEST['T_Subject']);

if(!empty($Name) && !empty($Email) && !empty($Phone) && !empty($Institution)){

    $INSERT = "INSERT INTO Teachers(tch_id, tch_name, tch_email, tch_phone, tch_institution, tch_department, tch_subject) VALUES ('{$ID}', '{$Name}', '{$Email}', '{$Phone}', '{$Institution}', '{$Department}', '{$Subject}')";
    $SELECT = mysqli_query($connection, $INSERT);
    if($SELECT){
        echo "Teacher added successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>