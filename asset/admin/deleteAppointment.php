<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../auth/login.php");
        }

    }else{
        header("location: ../auth/login.php");
    }
    
    
    if($_GET){
        //import database
        require_once("../database/connection.php");
        require_once("../database/operation.php");
        $id=$_GET["id"];

        deleteAppointment($database, $id);
        
        header("location: ./appointment.php");
    }