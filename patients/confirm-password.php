<?php
include('../connection.php');
session_start();
$email = $_SESSION['email'];
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMail($email){
    require ("PHPMailer.php");
    require("SMTP.php");
    require("Exception.php");

    $mail = new PHPMailer(true);

    try {
        //Server settings
       
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'mathewmelendez123123123@gmail.com';                     //SMTP username
        $mail->Password   = '62409176059359';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('mathewmelendez123123@gmail.com', 'Novaliches General Hospital');
        $mail->addAddress($email);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Password Reset';
        $mail->Body    = "We heard that you lost your password. Sorry about that. But don't worry. You already reset the password. Please
        disregard this message. Thank you so much! ";
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
    
}

$error = NULL;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<div class="container mt-5">
    <a href="home2.php">Cancel</a>
        <form class="row g-2 needs-validation" method="POST" action="#"  onsubmit="return myfunction()" novalidate>
            <center>
                <div class="col-md-5">
                    <label for="validationCustom01" class="form-label">Please Enter password</label>
                    <input type="password" class="form-control" name="password1" id="validationCustom01" value="" required>
                        <span id="messages" style="background-color: red; color: white;"> 

                        </span>
                </div>
                <div class="col-md-5">
                    <label for="validationCustom01" class="form-label">Please Enter password</label>
                    <input type="password" class="form-control" name="password2" id="validationCustom01" value="" required>
                        <span id="messages" style="background-color: red; color: white;"> 

                        </span>
                </div>
            <div class="col-12">
                <input class="btn btn-primary" type="submit" name="reset" value="Reset Password">
            </div>
            </center>
        </form>
</div>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>

    function myfunction(){


    var a= document.getElementById("password1").value;
    var b = document.getElementById("password2").value;


    if(a ==""){
        document.getElementById("messages").innerHTML="Please fill the password";
        return false;
    }

    if(a.length < 5){
        document.getElementById("messages").innerHTML="Password is too short";
        return false;
    }

    if(a.length > 25){
        document.getElementById("messages").innerHTML="Password is too long";
        return false;
    }

    if(a!=b){
        document.getElementById("messages").innerHTML="Password doesn't match";
        return false;
    }

}

</script>

</body>

</html>

<?php

if(isset($_POST['reset'])){
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    $email = $_SESSION['email'];


    if($password1 != $password2){
        echo "<script>alert('Password Doesn't Match') </script>";
    }

    $query_update = "UPDATE patients SET password = '$password1' WHERE email='$email' ";
    $run = mysqli_query($conn,$query_update) && sendMail($email);

    if($run){
        echo "<script>alert('Password Updated') </script>";
        echo "<script>window.location.href='login-patient.php' </script>";
    }
}

?>