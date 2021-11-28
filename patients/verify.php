<?php

include('../connection.php');

if(isset($_GET['email']) && isset($_GET['v_code']))
{
    $email = $_GET['email'];
    $v_code = $_GET['v_code'];
    $query = "SELECT * FROM `patients` WHERE `email` = '$email' AND `v_code` = '$v_code'";
    $run_query = mysqli_query($conn,$query);

    if($run_query){
        $status_valid = "SELECT email_status WHERE email='$email'";
        $run_status_valid = mysqli_query($conn,$status_valid);
        if($run_status_valid == '0'){
            $update = "UPDATE patients SET email_status ='1' WHERE email='$email'";
            $run_update = mysqli_query($conn,$update);
            echo "<script>alert('Account Verified')</script>";
            echo "<script>window.location.href='login-patient.php' </script>";
        }else{
            echo "<script>alert('Please Verify account on Gmail')</script>";
        }
    }else{
        echo "<script>alert('Something Went Wrong')</script>";
    }
}

?>