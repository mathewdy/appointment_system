<?php

include('../connection.php');
session_start();


require_once __DIR__.'/vendor/autoload.php';


if(isset($_POST['appointment_set'])){
    $mobile_number = $_POST['mobile_number'];

    $patient_id = $_POST['patient_id'];
    $appointment_date1 = date('Y-m-d', strtotime($_POST['appointment_date']));
    $appointment_time = $_POST['appointment_time'];
    $account_id = $_POST['account_id'];
    $name_of_doctor = $_POST['name_of_doctor'];
    $name_of_secretary = $_POST['name_of_secretary'];
    $name_of_patient = $_POST['name_of_patient'];

    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    //year month date
    $date = date('y-m-d');
    
    $remarks = "Pending Appointment";

    $query_insert = "INSERT INTO appointments (appointment_date,appointment_time,account_id,name_of_doctor,name_of_secretary,patient_id,
    name_of_patient,date_time_created,date_time_updated,remarks) VALUES ('$appointment_date1' ,'$appointment_time' , '$account_id' , '$name_of_doctor',
    '$name_of_secretary' ,'$patient_id', '$name_of_patient' , '$date $time' , '$date $time', '$remarks')";
    $run_insert = mysqli_query($conn,$query_insert);
    $msg = "Hi! this is your appointment details from Novaliches General Hospital. Your appointment date & time is on $appointment_date1 $appointment_time , and your doctor is $name_of_doctor please go to your appointment schedule on time. Thank you so much! ";

    if($run_insert) {
        $messagebird = new MessageBird\Client('PH3gUfd3eRJKimCHXcsy70gJC');
        $message = new MessageBird\Objects\Message;
        $message->originator = '+639156915704';
        $message->recipients = $mobile_number;
        $message->body = $msg;
        $response = $messagebird->messages->create($message);
        echo "sucess";
        echo "<script>window.location.href='appointment.php' </script>";
    }else{
        echo "error" . $conn->error;
    }
    
}



?>