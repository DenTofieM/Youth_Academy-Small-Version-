<?php

/*
    All Database Connection Start and Finish from this page.
*/

function DB_Connection_Start(){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Youth";

    $DB_Connection = new mysqli($servername, $username, $password, $dbname);
    return $DB_Connection;
}

function DB_Connection_Close($DB_Connection){
    $DB_Connection->close();
}

?>