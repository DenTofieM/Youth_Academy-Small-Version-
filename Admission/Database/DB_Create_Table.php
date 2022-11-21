<?php

include ('DB_Connector.php');

// ____________ Admin Table ________________

function Create_Admin_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Admins (
        admin_id VARCHAR(16) UNIQUE PRIMARY KEY,
        admin_name VARCHAR(50) NOT NULL,
        admin_email VARCHAR(50) NOT NULL,
        admin_phone VARCHAR(15) NOT NULL,
        admin_password VARCHAR(255) NOT NULL,
        admin_token VARCHAR(255),
        red_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Batch Table ________________
function Create_Batchs_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Batchs (
        bat_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        bat_name VARCHAR(20) UNIQUE NOT NULL,
        bat_capacity INT(7),
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Student Table ________________

function Create_Students_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Students (
        std_id VARCHAR(16) NOT NULL PRIMARY KEY,
        std_name VARCHAR(50) NOT NULL,
        std_email VARCHAR(50) NOT NULL UNIQUE,
        std_phone VARCHAR(20) NOT NULL UNIQUE,
        std_school VARCHAR(50),
        std_roll VARCHAR(20),
        std_reg VARCHAR(20),
        std_batch VARCHAR(20) NOT NULL,
        INDEX par_ind (std_batch),  
        CONSTRAINT fk_batch_1 FOREIGN KEY (std_batch)  REFERENCES Batchs(bat_name)  ON DELETE CASCADE  ON UPDATE CASCADE,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Subject Table ________________

function Create_Subjects_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Subjects (
        sub_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        sub_name VARCHAR(30) UNIQUE NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Subject and Lecture Table ________________

function Create_Subjects_And_Lecture_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Sublecture (
        lec_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        lec_sub_name VARCHAR(30) NOT NULL,
        lec_name VARCHAR(30) NOT NULL,
        lec_topic VARCHAR(30) NOT NULL,
        INDEX par_ind (lec_sub_name),  
        CONSTRAINT fk_subject_1 FOREIGN KEY (lec_sub_name)  REFERENCES Subjects(sub_name)  ON DELETE CASCADE  ON UPDATE CASCADE,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Teacher Table ________________

function Create_Teachers_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Teachers (
        tch_id VARCHAR(16) NOT NULL PRIMARY KEY,
        tch_name VARCHAR(50) NOT NULL UNIQUE,
        tch_email VARCHAR(50) NOT NULL UNIQUE,
        tch_phone VARCHAR(20) NOT NULL UNIQUE,
        tch_institution VARCHAR(50),
        tch_department VARCHAR(20),
        tch_subject VARCHAR(20) NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Subject and Lecture Table ________________

function Create_Schedules_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Schedules (
        schd_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        schd_subject VARCHAR(50) NOT NULL,
        schd_lecture VARCHAR(50) NOT NULL,
        schd_date DATE NOT NULL,
        schd_starting_time TIME NOT NULL,
        schd_ending_time TIME NOT NULL,
        schd_teacher VARCHAR(50) NOT NULL,
        schd_batch VARCHAR(20) NOT NULL,
        
        INDEX par_ind1 (schd_batch),  
        CONSTRAINT fk_batch_2 FOREIGN KEY (schd_batch)  REFERENCES Batchs(bat_name)  ON DELETE CASCADE  ON UPDATE CASCADE,
        
        INDEX par_ind3 (schd_teacher),  
        CONSTRAINT fk_teacher_1 FOREIGN KEY (schd_teacher)  REFERENCES Teachers(tch_id)  ON DELETE CASCADE  ON UPDATE CASCADE,
        
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Exam Type Table ________________

function Create_ExamTypes_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS ExamTypes (
        ext_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ext_type VARCHAR(30) UNIQUE NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    //mysqli_query($connection, $CREATE_TABLE);
    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Examination Table ________________

function Create_Examinations_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Examinations (
        exam_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        exam_ext_type VARCHAR(30) NOT NULL,
        exam_sub_name VARCHAR(20) NOT NULL,
        exam_lec_id INT(11),
        exam_date DATE NOT NULL,
        exam_starting_time TIME NOT NULL,
        exam_time_duration INT(3) NOT NULL,
        exam_total_mark INT(4),
        exam_batch VARCHAR(20) NOT NULL,
        
        INDEX par_ind2 (exam_sub_name),  
        CONSTRAINT fk_subject_2 FOREIGN KEY (exam_sub_name)  REFERENCES Subjects(sub_name)  ON DELETE CASCADE  ON UPDATE CASCADE,
        INDEX par_ind3 (exam_batch),  
        CONSTRAINT fk_batch_3 FOREIGN KEY (exam_batch)  REFERENCES Batchs(bat_name)  ON DELETE CASCADE  ON UPDATE CASCADE,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    //mysqli_query($connection, $CREATE_TABLE);
    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Result Table ________________
function Create_Results_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Results (
        res_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        res_std_id VARCHAR(20) NOT NULL,
        res_exam_id INT(11) NOT NULL,
        res_mark VARCHAR(20) NOT NULL,

        INDEX par_ind1 (res_std_id),  
        CONSTRAINT fk_student FOREIGN KEY (res_std_id)  REFERENCES Students(std_id)  ON DELETE CASCADE  ON UPDATE CASCADE,
        
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Class Message Table ________________

function Create_Class_Message_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS ClassMessages (
        clmsg_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        clmsg_message VARCHAR(20) NOT NULL,
        clmsg_schd_id INT(11) NOT NULL,
        clmsg_tch_id VARCHAR(20) NOT NULL,

        
        INDEX par_ind2 (clmsg_tch_id),  
        CONSTRAINT fk_teacher_2 FOREIGN KEY (clmsg_tch_id)  REFERENCES Teachers(tch_id)  ON DELETE CASCADE  ON UPDATE CASCADE,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Exam Message Table ________________
function Create_Exam_Message_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS ExamMessages (
        exmsg_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        exmsg_message VARCHAR(20) NOT NULL,
        exmsg_exam_id INT(11) NOT NULL,

        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Class Message Story Table ________________

function Create_Class_Message_Story_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Cmsgstory (
        cms_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        cms_clmsg_id VARCHAR(20) NOT NULL,
        cms_reciever_id INT(11) NOT NULL,

        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

// ____________ Exam Message Story Table ________________
function Create_Exam_Message_Story_Table(){
    $connection = DB_Connection_Start();

    $CREATE_TABLE = "CREATE TABLE IF NOT EXISTS Emsgstory (
        ems_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        ems_res_id VARCHAR(20) NOT NULL,
        ems_reciever_id INT(11) NOT NULL,

        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $statement = $connection->prepare($CREATE_TABLE);
    $statement->execute();
    $statement->close();

    DB_Connection_Close($connection);
}

?>