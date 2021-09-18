<?php
include('connection.php');
session_start();


if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login-patient.php'</script>";
}
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
    <h3>Home</h3>
    <!----pili muna sya dito dashboard kuno---->
    <a href="set-appointment.php">Set Appointment</a> <br>
    <a href="view-appointment.php">View Appointments / Confirm Appointments</a> <br>
    <a href="">View Doctors</a> <br>
    <a href="">View Patients</a> <br>
    <form action="logout.php" method="POST">
        <input type="submit" name="logout" value="Log Out">
    </form>

</body>
</html>
<?php
//sa set appointment dapat makapg set sya ng appointment sa user. 
// mamaya dapat matanong ko din kay sir 

?>