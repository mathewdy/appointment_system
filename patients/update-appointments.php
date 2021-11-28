<?php

include("../connection.php");


session_start();

if(isset($_POST['update'])){

    $appointment_time = $_POST['appointment_time'];
    $appointment_date = date('Y-m-d', strtotime($_POST['appointment_date']));
    $update_remarks = $_POST['update_remarks'];
    $patient_id = $_POST['patient_id'];
    
    $account_id = $_POST['account_id'];
    $name_of_doctor = $_POST['name_of_doctor'];

    $patient_full_name = $_POST['patient_full_name'];

    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    $date = date('y-m-d');


    if($update_remarks == 'Cancelled Appointment'){

        $query_insert1 = "INSERT INTO appointment_history (appointment_date,appointment_time,account_id,name_of_doctor,name_of_secretary,
        patient_id,name_of_patient,date_time_created,date_time_updated,remarks) VALUES
        ('$appointment_date', '$appointment_time', '$account_id', '$name_of_doctor',NULL, '$patient_id', '$patient_full_name', '$date $time', '$date $time' , '$update_remarks') ";
        $run_insert1 = mysqli_query($conn,$query_insert1);
       

        if($run_insert1){ 
            echo "added";
            $query_delete = "DELETE FROM appointments WHERE patient_id = '$patient_id'";
            $run_delete = mysqli_query($conn,$query_delete);

            echo "<script>window.location.href='appointments.php' </script>";
        }

    }else if($update_remarks == 'Pending Appointment'){
        $query_update = "UPDATE appointments SET appointment_date = '$appointment_date', appointment_time = '$appointment_time', remarks='$update_remarks' WHERE patient_id = '$patient_id'";
        $run_update = mysqli_query($conn,$query_update);
    
        if($run_update) {
            echo "<script>window.location.href='appointments.php' </script>";
        }else{
            echo "error" .$conn->error;
        }
    }


    
}


?>