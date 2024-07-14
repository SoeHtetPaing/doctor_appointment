<?php

    //learn from w3schools.com

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
    

    //import database
    require_once("../database/connection.php");
    require_once("../database/operation.php");

    $patient = selectPatientByEmail($database, $useremail);

    $userid= $patient["pid"];
    $username=$patient["pname"];


    if($_POST){
        if(isset($_POST["booknow"])){
            $appno=$_POST["apponum"];
            $scheduleid=$_POST["scheduleid"];
            $date=$_POST["date"];

            insertAppointment($database, $userid, $appno, $scheduleid, $date);

            //echo $apponom;
            header("location: ./appointment.php?action=booking-added&id=".$appno."&titleget=none");

        }
    }