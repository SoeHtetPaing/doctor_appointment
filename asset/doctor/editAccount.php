<?php
    
    //import database
    require_once("../database/connection.php");
    require_once("../database/operation.php");



    if($_POST){
        //print_r($_POST);
        $name=$_POST['name'];
        $oldemail=$_POST["oldemail"];
        $nrc=$_POST['nrc'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $sqlmain = "select doctor.did from doctor inner join page_user on doctor.demail=page_user.email where page_user.email='$email';";
            $result= filterData($database, $sqlmain);

            //$resultqq= $database->query("select * from doctor where docid='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["did"];
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from doctor where docemail='$email';");
                //$did= $resultqq1->fetch_assoc()["docid"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";

                $password = password_hash($cpassword, PASSWORD_DEFAULT);
                updateDoctor($database, $id, $email, $name, $password, $nrc, $tele, $spec);
                updatePageUser($database, $oldemail, $email);
                
                $error= '4';
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: ./settings.php?action=edit&error=".$error."&id=".$id);
