<?php
    //import database
    require_once("../database/connection.php");
    require_once("../database/operation.php");


    if($_POST){
        // print_r($_POST);
        $name=$_POST['name'];
        $nrc=$_POST['nrc'];
        $oldemail=$_POST["oldemail"];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $tele=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $id=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';

            $sqlmain= "select patient.pid from patient inner join page_user on patient.pemail=page_user.email where page_user.email='$email';";
            $result = filterData($database, $sqlmain);

            //$resultqq= $database->query("select * from doctor where docid='$id';");
            if($result->num_rows==1){
                $id2=$result->fetch_assoc()["pid"];
            }else{
                $id2=$id;
            }
            

            if($id2!=$id){
                $error='1';
                //$resultqq1= $database->query("select * from doctor where docemail='$email';");
                //$did= $resultqq1->fetch_assoc()["docid"];
                //if($resultqq1->num_rows==1){
                    
            }else{

                //$sql1="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
                $password = password_hash($cpassword, PASSWORD_DEFAULT);
                updatePatient($database, $id, $email, $name, $password, $nrc, $tele, $address);
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