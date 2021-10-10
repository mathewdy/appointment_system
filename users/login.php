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
</head>
<body>
    <h3>Login</h3>  
    <form action="#" method="POST">
        <label for="">Email</label>
        <input type="email" name="email" >
        <label for="">Account ID</label>
        <input type="text" name="account_id">
        <input type="submit" name="login" value="Log In">

    </form>
    <a href="reg-users.php">Sign Up</a>
</body>
</html>

<?php
if(isset($_POST['login'])){
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
?>