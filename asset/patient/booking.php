<?php require_once("../layout/header.php"); ?>  
    <link rel="stylesheet" href="../css/admin.css">

    <style>
        body, input {
            font-family: 'Source Serif 4';
        }
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
    
    
</head>
<body>
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

    date_default_timezone_set('Asia/Yangon');

    $today = date('Y-m-d');


    //echo $userid;
    //echo $username;
    
    ?>
    <div class="container">
        <div class="menu">
            <table class="menu-container" border="0">
                <tr>
                    <td style="padding:10px" colspan="2">
                        <table border="0" class="profile-container">
                            <tr>
                                <td width="25%" style="padding-left:20px" >
                                    <img src="../img/patient-pp-v1.png" alt="" width="100%" style="border-radius:50%">
                                </td>
                                <td style="padding:0px;margin:0px;">
                                    <p class="profile-title"><?php echo substr($username,0,50)  ?></p>
                                    <p class="profile-subtitle"><?php echo substr($useremail,0,50)  ?></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="../auth/logout.php" ><input type="button" value="Log out" class="logout-btn btn-primary-soft btn"></a>
                                </td>
                            </tr>
                    </table>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-home " >
                        <a href="./index.php" class="non-style-link-menu "><div><p class="menu-text">Home</p></a></div></a>
                    </td>
                </tr>
                <tr class="menu-row">
                    <td class="menu-btn menu-icon-doctor">
                        <a href="./doctors.php" class="non-style-link-menu"><div><p class="menu-text">All Doctors</p></a></div>
                    </td>
                </tr>
                
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-session menu-active menu-icon-session-active">
                        <a href="./schedule.php" class="non-style-link-menu non-style-link-menu-active"><div><p class="menu-text">Scheduled Sessions</p></div></a>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-appoinment">
                        <a href="./appointment.php" class="non-style-link-menu"><div><p class="menu-text">My Bookings</p></a></div>
                    </td>
                </tr>
                <tr class="menu-row" >
                    <td class="menu-btn menu-icon-settings">
                        <a href="./settings.php" class="non-style-link-menu"><div><p class="menu-text">Settings</p></a></div>
                    </td>
                </tr>
                
            </table>
        </div>
        
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="./schedule.php" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text">Back</font></button></a>
                    </td>
                    <td >
                            <form action="./schedule.php" method="post" class="header-search">

                                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Search Doctor name or Email or Date (YYYY-MM-DD)" list="doctors" >&nbsp;&nbsp;
                                        
                                        <?php
                                            echo '<datalist id="doctors">';
                                            $sql1 = "select distinct * from  doctor;";
                                            $sql2 = "select distinct * from  schedule group by title;";

                                            $list11 = filterData($database, $sql1);
                                            $list12 = filterData($database, $sql2);

                                            foreach ($list11 as $value) {
                                                $d=$value["docname"];
                                               
                                                echo "<option value='$d'><br/>";
                                               
                                            };


                                            foreach ($list12 as $value) {
                                                $d=$value["title"];
                                               
                                                echo "<option value='$d'><br/>";
                                            };

                                            echo ' </datalist>';
                                        ?>
                                        
                                
                                        <input type="Submit" value="Search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        </form>
                    </td>
                    <td width="15%">
                        <p style="font-size: 14px;color: rgb(119, 119, 119);padding: 0;margin: 0;text-align: right;">
                            Today's Date
                        </p>
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                                
                                echo $today;

                                

                        ?>
                        </p>
                    </td>
                    <td width="10%">
                        <button  class="btn-label"  style="display: flex;justify-content: center;align-items: center;"><img src="../img/calendar.svg" width="100%"></button>
                    </td>


                </tr>
                
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                        <!-- <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49);font-weight:400;">Scheduled Sessions / Booking / <b>Review Booking</b></p> -->
                        
                    </td>
                    
                </tr>
                
                
                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                            
                        <tbody>
                        
                            <?php
                            
                            if(($_GET)){
                                
                                
                                if(isset($_GET["id"])){
                                    

                                    $id=$_GET["id"];

                                    $sqlmain= "select * from schedule inner join doctor on schedule.did=doctor.did where schedule.sid=$id order by schedule.sdate desc";

                                    //echo $sqlmain;
                                    $result = filterData($database, $sqlmain)->fetch_assoc();

                                    // var_dump($result);

                                    $scheduleid=$result["sid"];
                                    $title=$result["title"];
                                    $docname=$result["dname"];
                                    $docemail=$result["demail"];
                                    $scheduledate=$result["sdate"];
                                    $scheduletime=$result["stime"];

                                    $sql2="select * from appointment where sid=$id";
                                    //echo $sql2;
                                     $result12= $database->query($sql2);
                                     $appno=($result12->num_rows)+1;
                                    
                                    echo '
                                        <form action="./completeBooking.php" method="post">
                                            <input type="hidden" name="scheduleid" value="'.$scheduleid.'" >
                                            <input type="hidden" name="apponum" value="'.$appno.'" >
                                            <input type="hidden" name="date" value="'.$today.'" >

                                        
                                    
                                    ';
                                     

                                    echo '
                                    <td style="width: 50%;" rowspan="2">
                                            <div  class="dashboard-items search-items"  >
                                            
                                                <div style="width:100%">
                                                        <div class="h1-search" style="font-size:25px;">
                                                            Session Details
                                                        </div><br><br>
                                                        <div class="h3-search" style="font-size:18px;line-height:30px">
                                                            Doctor name:  &nbsp;&nbsp;<b>'.$docname.'</b><br>
                                                            Doctor Email:  &nbsp;&nbsp;<b>'.$docemail.'</b> 
                                                        </div>
                                                        <div class="h3-search" style="font-size:18px;">
                                                          
                                                        </div><br>
                                                        <div class="h3-search" style="font-size:18px;">
                                                            Session Title: '.$title.'<br>
                                                            Session Scheduled Date: '.$scheduledate.'<br>
                                                            Session Starts : '.$scheduletime.'<br>
                                                            Channeling fee : <b>15,000 </b>Ks

                                                        </div>
                                                        <br>
                                                        
                                                </div>
                                                        
                                            </div>
                                        </td>
                                        
                                        
                                        
                                        <td style="width: 25%;">
                                            <div  class="dashboard-items search-items">
                                            
                                                <div style="width:100%;padding-top: 15px;padding-bottom: 15px;">
                                                        <div class="h1-search" style="font-size:20px;line-height: 35px;margin-left:8px;text-align:center;">
                                                            Your Appointment Number
                                                        </div>
                                                        <center>
                                                        <div class=" dashboard-icons" style="margin-left: 0px;width:90%;font-size:70px;font-weight:800;text-align:center;color:var(--btnnictext);background-color: var(--btnice)">'.$appno.'</div>
                                                    </center>
                                                       
                                                        </div><br>
                                                        
                                                        <br>
                                                        <br>
                                                </div>
                                                        
                                            </div>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="Submit" class="login-btn btn-primary btn btn-book" style="margin-left:10px;padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;width:95%;text-align: center;" value="Book now" name="booknow"></button>
                                            </form>
                                            </td>
                                        </tr>
                                        '; 
                                        




                                }



                            }
                            
                            ?>
 
                            </tbody>

                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>
                       
                        
                        
            </table>
        </div>
    </div>
    
    
   
    </div>

<?php require_once("../layout/footer.php"); ?>
