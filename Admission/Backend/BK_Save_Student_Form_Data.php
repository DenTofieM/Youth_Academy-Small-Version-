<?php

include "../Database/DB_Connector.php";

$connection = DB_Connection_Start();

$cnt = 0;
$ID = "";

$SELECT = "SELECT * FROM Students";
if($result = mysqli_query($connection, $SELECT)){
    if(mysqli_num_rows($result)>0){
        while($row = mysqli_fetch_array($result)){
            $cnt = $cnt+1;
        }
        mysqli_free_result($result);
    }
}

$cnt = $cnt+1;
if($cnt>=1 && $cnt<=9) $ID = "SID-000".$cnt;
elseif($cnt>=10 && $cnt<=99) $ID = "SID-00".$cnt;
elseif($cnt>=100 && $cnt<=999) $ID = "SID-0".$cnt;
else $ID = "SID-".$cnt;

$Name = mysqli_real_escape_string($connection, $_REQUEST['S_Name']);
$Email = mysqli_real_escape_string($connection, $_REQUEST['S_Email']);
$Phone = mysqli_real_escape_string($connection, $_REQUEST['S_Phone']);
$School = mysqli_real_escape_string($connection, $_REQUEST['S_School']);
$Roll = mysqli_real_escape_string($connection, $_REQUEST['S_Roll']);
$Registration = mysqli_real_escape_string($connection, $_REQUEST['S_Registration']);
$Batch = mysqli_real_escape_string($connection, $_REQUEST['S_Batch']);

if(!empty($Name) && !empty($Email) && !empty($Phone) &&  !empty($Batch)){
    /*if(isset($_FILES['S_Image'])){
        $img_name = $_FILES['S_Image']['name'];
        $img_type = $_FILES['S_Image']['type'];
        $tmp_name = $_FILES['S_Image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_ext = end($img_explode);

        $extentions = ['png', 'jpeg', 'jpg'];

        if(in_array($img_ext, $extentions)===true){
            $date = date('dmy');
            $time = time();
            $new_img_name = $date.'_'.$time.'.'.$img_ext;

            if(move_uploaded_file($tmp_name, "Storage/".$new_img_name)){
                $INSERT = "INSERT INTO Students(st_id, st_name, st_email, st_phone, st_institution, st_image) VALUES ('{$ID}', '{$Name}', '{$Phone}', '{$Email}', '{$Institution}','{$new_img_name}')";

                $SELECT = mysqli_query($connection, $INSERT);
                if($SELECT){
                    echo "Student added successfully";
                }
                else echo "Something wrong here.please check!";
            }
        }
    }*/
    $INSERT = "INSERT INTO Students(std_id, std_name, std_email, std_phone, std_school, std_roll, std_reg, std_batch) VALUES ('{$ID}', '{$Name}', '{$Email}', '{$Phone}', '{$School}', '{$Roll}', '{$Registration}', '{$Batch}')";
    $SELECT = mysqli_query($connection, $INSERT);
    if($SELECT){
        echo "Student added successfully";
    }
    else echo "Something wrong here.please check!";
}
else echo "Some information missing. please fill all requirememt.";
DB_Connection_Close($connection);

?>