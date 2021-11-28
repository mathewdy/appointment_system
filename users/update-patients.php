<?php

include('../connection.php');

session_start();

if(isset($_POST['update_patient'])){

   
    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $hmo = $_POST['hmo'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $mobile_number = $_POST['mobile_number'];

    $query = "UPDATE patients SET first_name = '$first_name', last_name = '$last_name', email='$email',
    hmo = '$hmo', age='$age', gender='$gender' ,date_of_birth='$date_of_birth', mobile_number='$mobile_number' WHERE patient_id ='$patient_id'";
    $run = mysqli_query($conn,$query);

    if($run){
        echo "<script>alert('updated') </script>";
        echo "<script>window.location.href='home.php' </script>";
    }else{
        echo "error";
    }
}
?>