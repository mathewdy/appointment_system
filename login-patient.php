<?php

include('connection.php'); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--login-->
    <form action="#" method="POST">
        <h3>Login</h3>
        <label for="">Email</label>
        <input type="email" name="email"> <br>
        <label for="">Password</label>
        <input type="password" name="password"> <br>
        <input type="submit" name="login" value="Login">
    </form>
    <!----pag na click ko to pupunta na ako sa registartion-->
    <a href="reg-patient.php">Registration For Patient</a>

</body>
</html>

<?php
session_start();

if(isset($_POST['login'])){
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
                    $_SESSION['id'] = $result_fetch['id'];
                    $_SESSION['email'] = $result_fetch['email'];
                    $_SESSION['first_name'] = $result_fetch ['first_name'];
                    $_SESSION['last_name'] = $result_fetch['last_name'];
                    $_SESSION['mobile_number'] = $result_fetch['mobile_number'];
                    //redirection of new page
                    header("Location:home.php");
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


?>