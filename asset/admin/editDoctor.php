<?php
    //import database
    require_once("../database/connection.php");
    require_once("../database/operation.php");



    if($_POST){
        print_r($_POST);
        $name=$_POST['name'];
        $nrc=$_POST['nrc'];
        $oldemail=$_POST["oldemail"];
        $speciality=$_POST['spec'];
        $email=$_POST['email'];
        $phone=$_POST['Tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $did=$_POST['id00'];
        
        if ($password==$cpassword){
            $error='3';
            $result= selectDoctorIdWithUserRole($database, $email);

            if($result!=null){
                $id2=$result;
            }else{
                $id2=$id;
            }
            
            echo $id2."jdfjdfdh";
            if($id2!=$id){
                $error='1';
                    
            }else{

                $password = password_hash($password, PASSWORD_DEFAULT);

                //$sql ="insert into doctor(docemail,docname,docpassword,docnic,doctel,specialties) values('$email','$name','$password','$nic','$tele',$spec);";
                updateDoctor($database, $did, $email, $name, $password, $nrc, $phone, $speciality);
                updatePageUser($database, $oldemail, $email);
                
            }
            
        }else{
            $error='2';
        }
    
    
        
        
    }else{
        //header('location: signup.php');
        $error='3';
    }
    

    header("location: ./doctors.php?action=edit&error=".$error."&id=".$id);