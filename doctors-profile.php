<?php

include('connection.php');
session_start();
$patients_id = $_SESSION['patient_id'];
$email = $_SESSION['email'];
$mobile_number = $_SESSION['mobile_number'];


$first_name=$_SESSION['first_name'];
$last_name = $_SESSION['last_name'];
$name_of_patient = $first_name . " " . $last_name;

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/doctors-patients-profile.css">
    <title>Document</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   
    <script>     
    $(function() {
        var date_today = new Date();
        $( "#datepicker" ).datepicker({
            minDate: date_today,
            beforeShowDay: function(d) {
                
                var day = d.getDay()
                return [(day != 0 && day != 1)];
            }
        });
    });
    </script>
</head>
<body>
<div class="gen-container">
<section class="content-header">
    <button style="width:100px; height:35px;"><a style="text-decoration:none; color:black; font-size:16px;" href="home.php" id="backbtn">Back</a></button>
    <div class="logo">
        <img src="css/logo.png" alt="Logo">
    </div>
    <span class="header-title">
        <h1 style="color:white; font-family:sans-serif; font-size:25px; text-align:center;" class="title">Book an Appointment</h1>
    </span>
</section>
    <?php

        $id = $_GET['account_id'];

        $select_doctors_Details = "SELECT users.first_name,users.last_name,users.mobile_number,
        doctors_details.doc_picture,doctors_details.specialization,doctors_details.user_id,users.id ,
        doctors_details.internship,doctors_details.residency,doctors_details.hmo
        FROM users 
        LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id
        WHERE users.account_id = '$id'";
        $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);


        if(mysqli_num_rows($run_doctors_Details) > 0){
            foreach($run_doctors_Details as $row){
                ?>
                <form action="" method="POST">
                <div class="row">
                        <div class="column">
                    <p style="text-align:center;"><img src="<?php echo "users/doc_picture/" . $row ['doc_picture'] ?>" width="100px" alt="Image"> </p>
                    <br>
                    <p>Name: <input style="background:none; border:none; font-size:19px;" type="text" name="name_of_doctor" value="<?php echo $row ['first_name']. " " . $row ['last_name']?>" readonly> </p>
                    <p>Specialization: <?php echo $row ['specialization']?> </p>
                    <p>Internship: <?php echo $row ['internship']?> </p>
                    <p>Residency: <?php echo $row ['residency']?> </p>
                    <p>HMO: <?php echo $row ['hmo']?></p>
                    </div>
                   
                
                    <div class="column">
                    <input type="hidden" name="id_doctor" value="<?php echo $row ['user_id']?>">
                        <label style="font-size:20px;" for="">Click to Select Date</label>
                        <br>
                        <br>
                        <br>
                        <i class="fa fa-calendar" style="font-size:30px; color:black;"></i> <input style="background: none; border: 2px solid black; border-radius:5px;"type="text" name="appointment_date" id="datepicker" readonly>
                            <select style="background: none; border: 2px solid black; border-radius:5px" name="appointment_time" id="">
                                <option value="9:00am - 9:30am">9:00am - 9:30am</option>
                                <option value="10:00am - 10:30am">10:00am - 10:30am</option>
                                <option value="11:00am -11:30am">11:00am -11:30am</option>
                                <option value="12:00pm - 12:30pm">12:00pm - 12:30pm</option>
                                <option value="1:00pm - 1:30pm">1:00pm - 1:30pm</option>
                                <option value="2:00pm - 2:30pm">2:00pm - 2:30pm</option>
                                <option value="3:00pm - 3:30pm">3:00pm - 3:30pm</option>
                                <option value="4:00pm - 4:30pm">4:00pm - 4:30pm</option>
                            </select>
                            <br>
                            <br>
                        <p style="text-align:center; font-family:sans-serif;"><input type="submit" name="book_appointment" value="Book Appointment"></p>
                    </div>
                 </div>
                </form>
                <?php
            }
        }

    ?>
    


<?php

/*
require_once __DIR__.'/vendor/autoload.php';
*/
if(isset($_POST['book_appointment'])){

    //dito ko din i sesend yung sms notification nya
    $name_of_doctor = $_POST['name_of_doctor'];
    $appointment_date = date('y-m-d' , strtotime($_POST['appointment_date']));
    $appointment_time = $_POST['appointment_time'];
    $name_of_patient = $_SESSION['first_name'] . " " . $_SESSION['last_name'];

    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    $date = date('y-m-d');

    $id_doctor = $_POST['id_doctor'];
    $remarks = "Pending Appointment";

    $msg = "Hi! this is your appointment details from Novaliches General Hospital. 
    Your appointment date & time is on $appointment_date $appointment_time , and your doctor is $name_of_doctor please go to your appointment schedule on time. Thank you so much! ";

    $query_appointments = "INSERT INTO appointments (appointment_date,appointment_time,user_id,name_of_doctor,name_of_secretary,
    name_of_patient,date_time_created,date_time_updated,remarks) VALUES 
    ('$appointment_date' , '$appointment_time' , '$id_doctor' , '$name_of_doctor' , NULL , '$name_of_patient', '$date $time',  '$date $time' ,'$remarks')";
    $run_appointments = mysqli_query($conn,$query_appointments); 

    if($run_appointments){

        // eto na lang eedit ko hahahahahaha 
      echo "<script>alert('Appointment Success'); window.location.href='home.php'; </script>";
    
      /*
      $messagebird = new MessageBird\Client('hzPlSRE4OFahwg9ZI80xfqhpr');
      $message = new MessageBird\Objects\Message;
        $message->originator = '+639614507751';
        $message->recipients = $mobile_number;
        $message->body = $msg;
        $response = $messagebird->messages->create($message);
        echo "sucess";
        */
        
      
    }else{
        echo "Error" . $conn->error;
    }
}

?>
</div>
</body>
</html>