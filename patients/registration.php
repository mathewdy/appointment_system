<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<?php

include('../connection.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
function sendMail($email,$vkey){
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
        $mail->Subject = 'Email Verification from Novaliches General Hospital ';
        $mail->Body    = "Thanks for registration! Hello $email welcome to <b> NGH </b> 
        Click the link to verify the email address. Thank you so much! ♥ 
        <a href='http://localhost/appointment_system/patients/verify.php?email=$email&v_code=$vkey'>Verify</a>' " ;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
    
}

session_start();

$error = NULL;
?>  
<body>
<div class="container">
    <br>
    <br>
    <div class="logo">
        <img src="../css/logo.png" alt="Logo"  style="border-radius: 500px;">
    </div>
  

    <br>
</div>
    
<div class="container">
    <form action="" class="row g-3 needs-validation" action="#" method="POST"  onsubmit="return myfunction()">

        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
            <div class="invalid-feedback">
                Input Field Required
            </div>
        </div>

        <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Password</label>
            <input type="password" class="form-control" id="passwords" name="password" value="" required>
                <span id="messages" style="background-color: red; color: white;"> 

                </span>
        </div>

        <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Confirm Password</label>
        <input type="password" id="passwordss" class="form-control" name="password2" value="" required>
            <span id="messages">
                
            </span>
        </div>

        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" required>
            <div class="invalid-feedback">
                Input Field Required
            </div>
        </div>

        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name"  required>
            <div class="invalid-feedback">
                Input Field Required
            </div>
        </div>


        <div class="col-md-4">
                <label for="validationCustom01" class="form-label">Age</label>
                <input type="text" class="form-control" name="age"  required>
                <div class="invalid-feedback">
                    Input Field Required
                </div>
            </div>
        <div class="col-md-4 p-2">
        <label for="validationCustom01" class="form-label">Gender:</label>
            <div class="row g-2 border bg-white">
                <div class="col-5">
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" required value="Male">
                        <label class="form-check-label" for="inlineRadio1">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2"  required value="Female">
                        <label class="form-check-label" for="inlineRadio2">Female</label>
                    </div>
                </div>
                <div class="invalid-feedback">
                    Gender Required
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="date_of_birth"  required>
            <div class="invalid-feedback">
                Input Field Required
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Mobile Number</label>
            <input type="text" class="form-control" name="mobile_number" pattern="[+][6]{1}[3]{1}[0-9]{10}" placeholder="+63" required>
            <div class="invalid-feedback">
                Input Required
                or use correct format
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">HMO</label>
            <input type="text" class="form-control" name="hmo"  required>
            <div class="invalid-feedback">
                Input Field Required
            </div>
        </div>

        <div class="col-12">
            <input type="submit" name="register" class="btn btn-primary" value="Registration">
        </div>

        <div>
            <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr"></div>
        </div>
    </form>
    <a class="link" href="login-patient.php" class="link-info">Already a user? Log In</a>
</div>


<script>

    function myfunction(){


    var a= document.getElementById("passwords").value;
    var b = document.getElementById("passwordss").value;


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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

<?php
if(isset($_POST['register']) && $_POST['g-recaptcha-response'] != ""){

    $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
    $response_data = json_decode($verify_response);

    if($response_data->success){

        $email = $_POST['email'];
        $password = ($_POST['password']);
        $password2 = ($_POST['password2']);
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $date_birth  = $_POST['date_of_birth'];
        $phone_number = $_POST['mobile_number'];

        date_default_timezone_set("Asia/Manila");
        $time= date("h:i:s", time());
        $date = date('y-m-d');
    
        $hmo = $_POST['hmo'];

        $patient_id = "2020".rand('55555','999999');
    
        //validation ng email
        $vkey = md5(rand('10000' , '9999'));
        $email_status = 0 ;
        //validation ng email
        $query_email = "SELECT * FROM patients WHERE email='$email'";
        $run_email = mysqli_query($conn,$query_email);

        if(mysqli_num_rows($run_email) > 0){
            echo "<script>alert('Email already use')</script>";
        }elseif($phone_number == 11){
            echo "numbers must be 11";
        }elseif($password != $password2){
            echo "<script>alert('Password Incorrect')</script>";
        }else{
            //insert into database 
            $patient_form = "INSERT INTO patients (email,password,first_name,last_name,age,gender,date_of_birth,mobile_number,hmo,patient_id,v_code,email_status,date_time_created,date_time_updated,remarks)
            VALUES ('$email' ,'$password' ,'$first_name' ,'$last_name' , '$age' , '$gender' , '$date_birth' , '$phone_number','$hmo','$patient_id', '$vkey' , '$email_status' ,'$date  $time', '$date $time', NULL )";
            //call out yung query , then isama si sendMail para ma valid yung email.
            $run_form = mysqli_query($conn,$patient_form) && sendMail($email, $vkey) ;

            if($run_form){
                echo "<script>alert('Registration Successful')</script>";
                echo "<script>window.location.href='login-patient.php' </script>";
            }else{
                echo "Error". $conn->error;
            }
        }
    }   
}
echo "" . $conn->error ; 

?>