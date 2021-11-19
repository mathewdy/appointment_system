<?php

include('../connection.php');
session_start();

echo $_SESSION['email'];
echo $_SESSION['account_id'];


if(empty($_SESSION['email'])){
    echo "<script>window.location.href='login.php' </script>";
}

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
    <h3>Hello Dr. <?php echo $_SESSION['first_name']?></h3>
    <a href="view-profile.php">View Profile</a> <br>

    <a href="logout.php">Log Out</a>
</body>
</html>