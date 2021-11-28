<?php

include('../connection.php');
session_start();

if(isset($_GET['patient_id'])){
    $patient_id = $_GET['patient_id'];
    
    $query = "DELETE FROM patients WHERE patient_id = '$patient_id'";
    $run = mysqli_query($conn,$query);

    if($run) {
        echo "<script>alert('Data Deleted') </script>";
        echo "<script>window.location.href='home.php' </script>";
    }
}

?>