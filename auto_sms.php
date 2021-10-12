<?php
//auto insert

include('connection.php');

//dapat automatic na syang mag sesend sa mga doctors ng notifications

//ETO NA YUNG FUCKING COOOOOOOOOOOOOOOOOOOOOOOODEEEE!!!!!!!!!! NAISIP KO LANG TO NGAYONG ARAW 
// OCTOBER 9, 2021 , 4:05AM, kase nag twwerrrk kami sa kabilang thesis HASHAHSHAHS; 

$date_today = date('y-m-d');
$query = "SELECT appointments.appointment_date, appointments.id_doctor, users.mobile_number ,COUNT(*)
FROM appointments
LEFT JOIN users ON appointments.id_doctor = users.id
WHERE appointments.appointment_date = '$date_today'
GROUP BY appointments.id_doctor ";
$run = mysqli_query($conn,$query);

if(mysqli_num_rows($run) > 0){
    foreach($run as $row){

        
        ?>
        <label for=""><b>  Id Doctor </b></label>
        <p><?php echo $row ['id_doctor']?></p>

        <label for=""><b>Mobile Number</b></label>
        <p><?php echo $row ['mobile_number']?></p>

        <label for=""><b>Number of patients today</b></label>
        <p><?php echo $row ["COUNT(*)"]?></p>

        <label for=""><b>Appointment Date</b></label>
        <p><?php echo $row ['appointment_date']?></p>
        <?php


        $id_of_doctor = $row["id_doctor"];
        $mobile_number = $row["mobile_number"];
        $number_of_patients = $row["COUNT(*)"];
        $appointment_date = $row["appointment_date"];

        $insert = "INSERT INTO sample (number_of_patients,appointment_date,id_doctor,mobile_number)
        VALUES ('$number_of_patients', '$appointment_date', '$id_of_doctor','$mobile_number')";
        $run = mysqli_query($conn,$insert);

        if($run){
        echo "added to databse";
        /*
        require_once __DIR__.'/vendor/autoload.php';
        $msg = "Hi doc goodmorning! You are about to expect of a total $number_of_patients this day. 
        $date_today";
        $messagebird = new MessageBird\Client('T8vuK9B6RqjBuBVDQ6rQ3lHhJ');
        $message = new MessageBird\Objects\Message;
        $message->originator = '+639614507751';
        $message->recipients = $mobile_number;
        $message->body = $msg;
        $response = $messagebird->messages->create($message);
        var_dump($response);
        echo "sms sent";
        */

        }else{
        echo "error" . $conn->error;
        }

    }
}
?>