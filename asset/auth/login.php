<?php
session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

// Set the new timezone
date_default_timezone_set('Asia/Yangon');
$date = date('Y-m-d');

$_SESSION["date"]=$date;


//import database
require_once("../database/connection.php");
require_once("../database/operation.php");

// insertSpeciality($database, "Emergency");
// insertAdmin($database, "admin@doctorapp.com", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq');
// insertPageUser($database, "admin@doctorapp.com", 'a');
// insertDoctor($database,"thiri@doctorapp.com", "Thiri Latt", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq', "114008", "09785550066", '1');
// insertPageUser($database, "thiri@doctorapp.com", 'd');


if($_POST){

    $email=$_POST['useremail'];
    $password=$_POST['userpassword'];
    
    $error='<label for="promter" class="form-label"></label>';

    $result= selectUserRoleByEmail($database, $email);
    if($result!=null){
        $utype=$result["urole"];
        if ($utype=='p'){
            $patient = selectPatientByEmail($database, $email);
            $password_check = password_verify($password, $patient["ppassword"]);
            if ($password_check){


                //   Patient dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='p';
                
                header('location: ../patient/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid password</label>';
            }

        }elseif($utype=='a'){
            $admin = selectAdminByEamil($database, $email);
            $password_check = password_verify($password, $admin["apassword"]);
            if ($password_check){


                //   Admin dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='a';
                
                header('location: ../admin/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid password</label>';
            }


        }elseif($utype=='d'){
            $doctor = selectDoctorByEmail($database, $email);
            $password_check = password_verify($password, $doctor["dpassword"]);
            if ($password_check){

                //   doctor dashbord
                $_SESSION['user']=$email;
                $_SESSION['usertype']='d';
                header('location: ../doctor/index.php');

            }else{
                $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Wrong credentials: Invalid password</label>';
            }

        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">We cant found any acount for this email.</label>';
    }
    
}else{
    $error='<label for="promter" class="form-label">&nbsp;</label>';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&family=PT+Sans+Narrow:wght@400;700&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">

    <title>Doctor Appointment</title>

    <style>
        body, input {
            font-family: 'Source Serif 4';
        }
    </style>
    
</head>
<body>
    <center>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Have a nice day!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Login with your details to continue</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="Email Address" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Password: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="Password" required>
                </td>
            </tr>


            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>

            <tr>
                <td>
                    <input type="submit" value="Login" class="login-btn btn-primary btn">
                </td>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Don't have an account&#63; </label>
                    <a href="./register.php" class="hover-link1 non-style-link">Sign Up</a>
                    <br><br><br>
                </td>
            </tr>         
                    </form>
        </table>

    </div>
</center>
</body>
</html>