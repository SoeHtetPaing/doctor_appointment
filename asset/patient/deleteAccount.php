<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../auth/login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../auth/login.php");
    }

    
    if($_GET){
        //import database
        require_once("../database/connection.php");
        require_once("../database/operation.php");
        $id=$_GET["id"];

        $patient = selectPatientById($database, $id);
        $email = $patient["pemail"];

        deletePageUser($database, $email);
        deleteAppointmentByPatientId($database, $id);
        deletePatient($database, $email);
        
        print_r($email);
        header("location: ../auth/login.php");
    }