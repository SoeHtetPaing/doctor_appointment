<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../auth/login.php");
        }

    }else{
        header("location: ../auth/login.php");
    }
    
    
    if($_POST){
        //import database
        require_once("../database/connection.php");
        require_once("../database/operation.php");

        $title=$_POST["title"];
        $did=$_POST["docid"];
        $nop=$_POST["nop"];
        $date=$_POST["date"];
        $time=$_POST["time"];

        insertSchedule($database, $did, $title, $date, $time, $nop);
        header("location: ./schedule.php?action=session-added&title=$title");
        
    }


?>