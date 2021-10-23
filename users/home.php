<?php
include('../connection.php');
session_start();


if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/home-users.css">
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
 
    <br>
    <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="Log Out">
    </form>

</body>
</html>
<?php
//sa set appointment dapat makapg set sya ng appointment sa user. 
// mamaya dapat matanong ko din kay sir 

?>