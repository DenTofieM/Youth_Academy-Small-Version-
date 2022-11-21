<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$Name = mysqli_real_escape_string($connection, $_REQUEST['Name']);


if(!empty($Name)){
    $Flag = true;
    $SELECT = "SELECT * FROM Batchs WHERE bat_name='$Name'";
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
        $INSERT = "INSERT INTO Batchs(bat_name) VALUES ('{$Name}')";
        $SELECT = mysqli_query($connection, $INSERT);
        if($SELECT){
            echo "New Batch Created Successfully";
        }
        else echo "Something wrong here.please check!";
    }else echo "This Batch Already Created!!!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>