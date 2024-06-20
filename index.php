<?php require_once("./asset/database/connection.php"); ?>
<?php require_once("./asset/database/creation.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cutive+Mono&family=PT+Sans+Narrow:wght@400;700&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./asset/css/style.css">
    <link rel="stylesheet" href="./asset/css/intro.css">
    
    <title>Doctor Appointment</title>
    <style>
        body, input {
            font-family: 'Source Serif 4';
        }
        table{
            animation: transitionIn-Y-bottom 0.5s;
        }
    </style>
        
</head>
<body>
    
    <div class="full-height">
        <center>
        <table border="0">
            <tr>
                <td width="80%">
                    <font class="pj-logo">Doctor Appointment</font>
                    <font class="pj-logo-sub">| အကောင်းဆုံး ကျန်းမာရေးအဖော်မွန်</font>
                </td>
                <td width="10%">
                   <a href="./asset/auth/login.php"  class="non-style-link"><p class="nav-item">LOGIN</p></a>
                </td>
                <td  width="10%">
                    <a href="./asset/auth/register.php" class="non-style-link"><p class="nav-item" style="padding-right: 10px;">REGISTER</p></a>
                </td>
            </tr>
            
            <tr>
                <td  colspan="3">
                    <p class="heading-text">ကျန်းမာပျော်ရွှင်သော ‌နေ့ရက်များဆီသို့...</p>

                </td>
            </tr>
            <tr>
                <td  colspan="3">
                    <p class="sub-text2">ဒီနေ့ ကျန်းမာရေးမကောင်းဘူးလား?<br>စိုးရိန်မနေပါနဲ့ Doctor Appointment မှာ သင်စိတ်ကြိုက်ဆရာဝန်ဖြင့် ချိန်းဆိုပြသနိုင်ပါပြီ... <br>
                    ကျွန်ုပ်တို့ဆီမှာ သင့်ကျန်းမာရေးအတွက် အကောင်းဆုံးဝန်ဆောင်မှုများ ရရှိနိုင်ပါပြီ... ယခုပင် ချိန်းဆိုမှုများ ပြုလုပ်လိုက်ပါ...</p>
                </td>
            </tr>
            <tr>
                
                <td colspan="3">
                    <center>
                    <a href="./asset/auth/login.php" >
                        <input type="button" value="Make Appointment" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                    </a>
                </center>
                </td>
                
            </tr>
            <tr>
                <td colspan="3">
                   
                </td>
            </tr>
        </table>
        <p class="sub-text2 footer-ucsp">&copy;2024 | UCSP</p>
    </center>
    
    </div>
</body>
</html>