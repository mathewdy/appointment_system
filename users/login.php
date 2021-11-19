<?php
include('../connection.php');
session_start();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/login-users.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src= "https://kit.fontawesome.com/b99e675b6e.js" ></script>
</head>
<body>

    
    <form action="login.php" method="POST">
    <div class="login">
        <br><br><br><br><br><br>
        <h3>Welcome Secretary!</h3>  
        <div class="inputs">
            <input type="email" name="email" placeholder="  Email:"><br>
            <input type="text" name="account_id"  placeholder="  Account ID:"><br>
            </div>
            <input type="submit" name="login" value="Log In"><br><br>
        <a href="reg-users.php">No account? Sign Up</a>
        <!-----wala pa tong function--->
        <a href="#">Forgot account id?</a>
    </div>
        <div>
            <div class="g-recaptcha" data-sitekey="6LeDhkEdAAAAAOowHWu_1sVH7vjlVwgZeJHhp3tr">
        </div>
    <a href="../doctors/login.php">Doctor's Portal</a>
    <a href="../login-patient.php">Patient's Portal</a>
    </form>
</body>
</html>

<?php
if(isset($_POST['login']) && $_POST['g-recaptcha-response'] != ""){

    $secret = '6LeDhkEdAAAAADaqjnG1pIM6UkVcS6shpF7nsRo1';
    $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'] );
    $response_data = json_decode($verify_response);

        if($response_data->success){

            $email = $_POST['email'];
            $account_id = $_POST['account_id'];

            $query_users = "SELECT * FROM users WHERE email ='$email' AND account_id = '$account_id'";
            $run_users = mysqli_query($conn,$query_users);

            if($run_users){
                if(mysqli_num_rows($run_users) == 1){
                    $result = mysqli_fetch_assoc($run_users);
                    if($result['email_status'] == 1){
                        if($result['doctor_or_secretary'] == 'doctor'){
                            echo "Access Denied";
                            exit();
                        }
                            if($_POST['account_id'] == $result['account_id']){
                                $_SESSION['email'] = $result['email'];
                                $_SESSION['account_id'] = $result['account_id'];
                                $_SESSION['first_name'] =$result['first_name'];
                                $_SESSION['last_name'] = $result['last_name'];
                                header("Location: home.php");
                            }else{
                                echo "Account id / Email Error :" .$conn->error;
                            }
                        }else{
                            echo "please verify your email address" . $conn->error;
                        }
                    }else{
                    echo "account not found" . $conn->error;
                }
        }
    }
}
?>