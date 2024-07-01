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

if($_POST){

    $result= selectUserRoles($database);

    $fname=$_SESSION['person']['fname'];
    $lname=$_SESSION['person']['lname'];
    $name=$fname." ".$lname;
    $address=$_SESSION['person']['address'];
    $nrc=$_SESSION['person']['nrc'];
    $dob=$_SESSION['person']['dob'];
    $email=$_POST['newemail'];
    $phone=$_POST['phone'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    
    if ($newpassword==$cpassword){
        $newpassword = password_hash($newpassword, PASSWORD_DEFAULT);
        $result= selectUserRoleByEmail($database, $email);
        if($result!= null){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
        }else{
            insertPatient($database, $email, $name, $newpassword, $address, $nrc, $dob, $phone);
            insertPageUser($database, $email, 'p');

            //print_r("insert into patient values($pid,'$email','$fname','$lname','$newpassword','$address','$nrc','$dob','$phone');");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: ../patient/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>';
    }



    
}else{
    //header('location: register.php');
    $error='<label for="promter" class="form-label"></label>';
}

?>

<?php require_once("../layout/header.php"); ?>
    <link rel="stylesheet" href="../css/register.css">
        
    
    <style>
        body, input {
            font-family: 'Source Serif 4';
        }
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body></body>
    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">It's Okey, Now Create User Account.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="newemail" class="form-label">Email: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                </td>
                
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="tele" class="form-label">Mobile Number: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="tel" name="phone" class="input-text"  placeholder="09xxxxxxxxx" pattern="^09[0-9]{9}$" >
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="newpassword" class="form-label">Create New Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="cpassword" class="form-label">Conform Password: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required>
                </td>
            </tr>
     
            <tr>
                
                <td colspan="2">
                    <?php echo $error ?>

                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                </td>
                <td>
                    <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Login</a>
                    <br><br><br>
                </td>
            </tr>

                    </form>
            </tr>
        </table>

    </div>
</center>
<?php require_once("../layout/footer.php"); ?>