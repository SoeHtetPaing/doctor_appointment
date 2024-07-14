<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../auth/login.php");
        } else {
                     
            if($_GET){
                require_once("../database/connection.php");
                require_once("../database/operation.php");
                
                $id=$_GET["id"];
        
                deleteSchedule($database, $id);
        
                header("location: ./schedule.php");
            }
        }

    }else{
        header("location: ../auth/login.php");
    }