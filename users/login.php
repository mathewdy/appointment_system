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
    <script src= "https://kit.fontawesome.com/b99e675b6e.js" ></script>
</head>
<body>

    <div class="wrapper">
        <div class="navbar">
            <ul>
                <li>
                <!----pili muna sya dito dashboard kuno----><br>
                <a href="set-appointment.php"><i class="fas fa-calendar-check"></i> Set Appointment</a> <br>
                <a href="view-appointment.php"><i class="far fa-calendar-check"></i> View Appointments</a> <br>
                <a href="view-doctors.php"><i class="fas fa-user-md"></i> View Doctors</a> <br>
                <a href="view-patients.php"><i class="fas fa-user-injured"></i> View Patients</a> <br>
                </li>
            </ul>
        </div>
    </div> 
    <form action="#" method="POST">
    <div class="login">
        <br><br><br><br><br><br>
        <h3>Welcome!</h3>  
        <div class="inputs">
            <input type="email" name="email" placeholder="  Email:"><br>
            <input type="text" name="account_id"  placeholder="  Account ID:"><br>
            </div>
            <input type="submit" name="login" value="Log In"><br><br>
        <a href="reg-users.php">No account? Sign Up</a>
    </div>
    </form>
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