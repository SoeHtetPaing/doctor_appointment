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

// all default admin, doctor, patient password is 123

// insertSpeciality($database, "နှလုံးခွဲစိတ်အထူးကု");
// insertSpeciality($database, "အထွေထွေရောဂါကု");
// insertSpeciality($database, "ကင်ဆာရောဂါကု");
// insertSpeciality($database, "ဓာတ်ရောင်ခြည်အထူးကု");
// insertSpeciality($database, "ဆီးချိုရောဂါကု");
// insertSpeciality($database, "ခွဲစိတ်အထူးကု");
// insertSpeciality($database, "စိတ်ရောဂါအထူးကုနှင့် အထွေထွေအတိုင်ပင်ခံ");
// insertSpeciality($database, "အစာအိမ်နှင့် အူလမ်းကြောင်းဆိုင်ရာအထူးကု");
// insertSpeciality($database, "အသည်းရောဂါအထူးကု");
// insertSpeciality($database, "သားဖွား/မီးယပ်အထူးကု");
// insertSpeciality($database, "နားနှာခေါင်းလည်ချောင်းအထူးကု");
// insertSpeciality($database, "ကလေးအထူးကု");
// insertSpeciality($database, "ထိခိုက်ဒဏ်ရာနှင့် အရိုး၊ အကြော၊ အဆစ်ဆိုင်ရာခွဲစိတ်အထူးကု");
// insertSpeciality($database, "ဆီးနှင့်ကျောက်ကပ်အထူးကု");
// insertSpeciality($database, "အရေပြားအထူးကု");
// insertSpeciality($database, "ဦးနှောက်နှင့် အာရုံကြောဆိုင်ရာအထူးကု");
// insertSpeciality($database, "အဆုတ်နှင့် ရင်ခေါင်းရောဂါအထူးကု");
// insertSpeciality($database, "သွေးရောဂါဗေဒဆိုင်ရာအထူးကု");
// insertSpeciality($database, "ဓါတ်မှန်ဘက်ဆိုင်ရာအထူးကု");
// insertSpeciality($database, "ပြန်လည်သန်စွမ်းမှုလေ့ကျင့်ရေးအထူးကု");

// insertAdmin($database, "admin@doctorapp.com", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq');
// insertPageUser($database, "admin@doctorapp.com", 'a');

// insertDoctor($database,"thiri@doctorapp.com", "Thiri Latt", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq', "114008", "09785550066", '2');
// insertDoctor($database,"htunthiri@doctorapp.com", "Htun Thiri", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq', "111088", "097855536566", '2');
// insertDoctor($database,"winhtunoo@doctorapp.com", "Win Htun Oo", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq', "130383", "09970005500", '12');
// insertDoctor($database,"htunhtunwin@doctorapp.com", "Htun Htun Win", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq', "140836", "09970705050", '12');
// insertPageUser($database, "thiri@doctorapp.com", 'd');
// insertPageUser($database, "htunthiri@doctorapp.com", 'd');
// insertPageUser($database, "winhtunoo@doctorapp.com", 'd');
// insertPageUser($database, "htunhtunwin@doctorapp.com", 'd');

// insertPatient ($database, "patient@doctorapp.com", "Yaung War Lin", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq', "Pyay", "100118", "2005-10-05", "09880117303");
// insertPatient ($database, "kyilatt@doctorapp.com", "Kyi Latt Latt", '$2y$10$yqGn1fq9X23bJ.RG6beftulx87zgXnek4KZa5zxQofJ9nJ5A3RZxq', "Pyay", "122118", "1998-05-15", "09881557363");
// insertPageUser($database, "patient@doctorapp.com", 'p');
// insertPageUser($database, "kyilatt@doctorapp.com", 'p');

// insertSchedule ($database, "1", "Thursday Session", "2024-06-27", "9:00:00", 50);
// insertSchedule ($database, "4", "Thursday Session", "2024-06-27", "12:00:00", 25);
// insertSchedule ($database, "2", "Friday Session", "2024-06-28", "12:00:00", 25);
// insertSchedule ($database, "3", "Friday Session", "2024-06-28", "9:00:00", 50);
// insertSchedule ($database, "1", "Sataurday Session", "2024-06-29", "12:00:00", 25);
// insertSchedule ($database, "4", "Sataurday Session", "2024-06-29", "9:00:00", 50);
// insertSchedule ($database, "2", "Sunday Session", "2024-06-30", "9:00:00", 50);
// insertSchedule ($database, "3", "Sunday Session", "2024-06-30", "12:00:00", 25);

// insertAppointment ($database, "1", "1", "5", "2024-06-29");
// insertAppointment ($database, "2", "1", "6", "2024-06-29");
// insertAppointment ($database, "1", "1", "7", "2024-06-30");
// insertAppointment ($database, "2", "2", "7", "2024-06-30");



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


<?php require_once("../layout/header.php"); ?>
    <link rel="stylesheet" href="../css/login.css">
    
    <style>
        body, input {
            font-family: 'Source Serif 4';
        }
        .container{
            animation: transitionIn-X 0.5s;
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
<?php require_once("../layout/footer.php"); ?>