<?php
//learn from w3schools.com
session_start();
if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
        header("location: ../auth/login.php");
    }
}else{
    header("location: ../auth/login.php");
}


//import database
require_once("../database/connection.php");
require_once("../database/operation.php");
if($_POST){
    //print_r($_POST);
    $name=$_POST['name'];
    $nrc=$_POST['nic'];
    $speciality=$_POST['spec'];
    $email=$_POST['email'];
    $phone=$_POST['Tele'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
    
    if ($password==$cpassword){
        $error='3';
        $result = selectUserRoleByEmail($database, $email);
        if($result!=null){
            $error='1';
        }else{
            $password = password_hash($password, PASSWORD_DEFAULT);
            insertDoctor($database, $email, $name, $password, $nrc, $phone, $speciality);
            insertPageUser($database, $email, 'd');
            
            $error= '4';
            
        }
        
    }else{
        $error='2';
    }


    
    
}else{
    //header('location: signup.php');
    $error='3';
}

header("location: ./doctors.php?action=add&error=".$error);