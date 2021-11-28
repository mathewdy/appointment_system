<?php

include('../connection.php');
session_start();

if(isset($_GET['account_id'])){
    $account_id = $_GET['account_id'];
    
    $query = "DELETE FROM users WHERE account_id = '$account_id'";
    $run = mysqli_query ($conn,$query);

    if($run){
        echo "<script>alert('deleted info') </script>";
        echo "<script>window.location.href='view-doctors.php' </script>";
    }else{
        echo "error" . $conn->error;
    }
}

?>