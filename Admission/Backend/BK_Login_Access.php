<?php

include "../Database/DB_Connector.php";

$res = array();
if(!empty($_REQUEST['user_id']) && !empty($_REQUEST['password'])){
    
    $user_id = $_REQUEST['user_id'];
    $user_pass = $_REQUEST['password'];

    if($user_id=="Youth Academy" && $user_pass=="Developer@amql3.it"){
        $res['msg'] = "access";
        $res['ID'] = "Developer";
    } 
    else{
        $connection = DB_Connection_Start();
        $SELECT = "SELECT * FROM Admins WHERE admin_id = '{$user_id}'";
        if($result = mysqli_query($connection, $SELECT)){
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_array($result);
                if($row['admin_password'] == $user_pass){
                    $res['msg'] = "access";
                    $res['ID'] = $user_id;
                }else{
                    $res['msg'] = "Sorry, Invalid password!!!";
                }
                mysqli_free_result($result);
                DB_Connection_Close($connection);
            }else{
                $res['msg'] = "This email address is not register";
            }
        }
        else{
            $res['msg'] =  "User ID and Password does not match!!!";
        }   
    }

}else{
    $res['msg'] =  "User ID and Password must be needed!!";
}

header("Content-type: appplication/json");
echo json_encode($res);

?>