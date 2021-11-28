<?php
//auto insert

include('connection.php');


//dapat automatic na syang mag sesend sa mga doctors ng notifications

//ETO NA YUNG FUCKING COOOOOOOOOOOOOOOOOOOOOOOODEEEE!!!!!!!!!! NAISIP KO LANG TO NGAYONG ARAW 
// OCTOBER 9, 2021 , 4:05AM, kase nag twwerrrk kami sa kabilang thesis HASHAHSHAHS; 


/*SELECT appointments.appointment_date, appointments.user_id, users.mobile_number ,COUNT(*)
FROM appointments
LEFT JOIN users ON appointments.user_id = users.account_id
WHERE appointments.appointment_date = '2021-10-27'
GROUP BY appointments.user_id 

*/
?>

<?php

$date_today = date('Y-m-d');
echo $date_today;
$query = "SELECT appointments.appointment_date, appointments.user_id, users.mobile_number ,COUNT(*)
FROM appointments
LEFT JOIN users ON appointments.user_id = users.account_id
WHERE appointments.appointment_date = '$date_today'
GROUP BY appointments.user_id";
$run = mysqli_query($conn,$query);

if(mysqli_num_rows($run) > 0){
    foreach($run as $row){
        
        ?>
        <h3>Number of patients</h3>
        <p><?php echo $row ["COUNT(*)"]?></p>
        <h3>Appointment Date</h3>
        <p><?php echo $row ['appointment_date']?></p>
        <h3>user id</h3>
        <p><?php echo $row ['user_id']?></p>
        <h3>mobile_number</h3>
        <p><?php echo $row ['mobile_number']?></p>

        <?php

        $user_id = $row['user_id'];
        $mobile_number = $row['mobile_number'];
        $number_of_patients = $row['COUNT(*)'];
        $appointment_date = $row['appointment_date'];

        $insert = "INSERT INTO sample (number_of_patients,appointment_date,user_id,mobile_number)
        VALUES ('$number_of_patients', '$appointment_date', '$user_id', '$mobile_number')";
        $run = mysqli_query($conn,$insert);
        if($run){
        echo "added to databse";
        /*
        
        require_once __DIR__.'/vendor/autoload.php';
        $msg = "Hi doc goodmorning! You are about to expect of a total of number of patients ($number_of_patients) this day. 
        $date_today";
        $messagebird = new MessageBird\Client('nqTXgi1Iub31CdkqAMOkItRut');
        $message = new MessageBird\Objects\Message;
        $message->originator = '+639156915704';
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

