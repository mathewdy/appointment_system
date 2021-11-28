<?php

include('../connection.php'); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <!--login-->





<div class="container">
<a href="homepage.php">Home</a>
<a href="abowut.php">About</a><br><br>
    <div class="logo">
        <img src="../css/logo.png" alt="Logo"  style="border-radius: 500px;">
    </div>
    <br>
</div>


<div class="container">
    <h3>Welcome!</h3>
        <form action="#" method="POST" class="row g-3 needs-validation" novalidate>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Email</label>
            <input type="email" class="form-control" id="validationCustom01" name="email"  required>
            <div class="invalid-feedback">
                Input Required
            </div>
        </div>
        <div class="col-md-4">
            <label for="validationCustom01" class="form-label">Password</label>
            <input type="password" class="form-control" id="validationCustom01" name="password"  required>
            <div class="invalid-feedback">
                Input Required
            </div>
        </div>
        <div class="col-12">
            <input class="btn btn-primary" type="submit" name="login" value="Login">
        </div>
            
            <a class="link" href="registration.php" class="link-info">No account? Sign up</a>
            <a href="forgot-password.php">Forgotten Password?</a>
        <div>
            <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr"></div>
        </div>
        </form>
        
</div>
    <!----pag na click ko to pupunta na ako sa registartion-->
<script>
    (function () {
'use strict'

    var forms = document.querySelectorAll('.needs-validation')

    Array.prototype.slice.call(forms)
    .forEach(function (form) {
        form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    })
})()
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>

<?php
session_start();

if(isset($_POST['login']) && $_POST['g-recaptcha-response'] != ""){

    $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
    $response_data = json_decode($verify_response);

        if($response_data->success){

        $email = $_POST['email'];
        $password = ($_POST['password']);
        
        $query = "SELECT * FROM patients WHERE email='$email' AND password = '$password'";
        $result = mysqli_query($conn,$query);

        //kinuha ko lahat ng result is = to 1
        if($result){
            if(mysqli_num_rows($result) == 1){
                //getting array sa database
                $result_fetch = mysqli_fetch_assoc($result);
                //call out ko yung 'status_valid' sa database
                //kapag == 1 makakapag log in, . 
                // validation ng password syempre SHAHSHAHS 
                if($result_fetch['email_status'] == 1)
                {
                    if(($_POST['password'] == $result_fetch['password'])){
                        // makakapag login kapag tama
                        $_SESSION['logged_in'] = true;
                        $_SESSION['patient_id'] = $result_fetch['patient_id'];
                        $_SESSION['email'] = $result_fetch['email'];
                        $_SESSION['first_name'] = $result_fetch ['first_name'];
                        $_SESSION['last_name'] = $result_fetch['last_name'];
                        $_SESSION['mobile_number'] = $result_fetch['mobile_number'];
                        //redirection of new page
                        header("Location:home2.php");
                    }else{
                        //password incorrect
                        echo "<script>alert('Password Incorrect')</script>";
                    
                    }
                }else{  //di pa verified account
                    echo "<script>alert('Please verify your email address')</script>";
                }
                
            }else{//walang account
                echo "<script>alert('Account not found.')</script>";
            }
        }
    }

}


?>