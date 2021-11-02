<?php
session_start();
include('../connection.php');
$name_of_secretary = $_SESSION['first_name'] .  " " . $_SESSION['last_name'];


if(isset($_POST['select_doctor'])){
    $id = $_POST['id'];
    $name_of_doctor = $_POST['name_of_doctor'];
    $specialization = $_POST['specialization'];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/set-patient.css">
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
    <br>
    <div class="back">
    <form action="set-appointment.php" method="POST">
        <input type="submit" name="cancel" value="Cancel">
    </form>
    </div>
    <?php
    
    //query patients

    $query_patients = "SELECT * FROM patients";
    $run_patients = mysqli_query($conn,$query_patients);

    ?>
    
    <h1><i>Select Patient</i></h1>
    <form action="#" method="POST">
        <!--id ata to ng doctor SHAHSHA nakalimutan ko na --->
        <input type="text" name="id_doctor" value="<?php echo $id?>">
        <select name="name_of_patient" id="">
            <option value="">-Select-</option>
            <?php foreach ($run_patients as $row) {?>
                <option value="<?php echo $row ['first_name']. " " . $row ['last_name'] ?>">
                <?php echo $row ['first_name'] . " " .$row ['last_name']?></option>
            <?php } ?>
        </select> <br>
        
        <label for="">Click to Select Date & Time</label><br>
        <i class="fa fa-calendar" style="font-size:28px"></i> <input type="text" name="appointment_date" id="datepicker" readonly>
        <select name="appointment_time" id="">
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
        <label for=""><b>Doctor: </b></label>
        <input type="text" name="name_of_doctor" value="<?php echo $name_of_doctor?>">
        <label for=""><b>Specialization</b></label>
        <input type="text" name="specialization" value="<?php echo $specialization?>">
        <input type="submit" name="select_patient" value="Confirm">
    </form>
 
</body>
</html>

<?php

if(isset($_POST['select_patient'])){
    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    $date = date('y-m-d');
    $remarks = "Pending Appointment";
    $name_of_doctor = $_POST['name_of_doctor'];
    $name_of_patient = $_POST['name_of_patient'];
    $id_doctor =  $_POST['id_doctor'];
    $appointment_date = date('y-m-d', strtotime($_POST['appointment_date']));
    $appointment_time = $_POST['appointment_time'];

    if($name_of_patient == ""){
        echo "no patient";
    }

    $query_appointment = "INSERT INTO appointments (appointment_date,appointment_time,user_id,name_of_doctor,name_of_secretary,name_of_patient,
    date_time_created,date_time_updated,remarks) VALUES ('$appointment_date' , '$appointment_time','$id_doctor','$name_of_doctor',
    '$name_of_secretary' , '$name_of_patient' , '$date $time' , '$date $time', '$remarks')";

    $run_appointment = mysqli_query($conn,$query_appointment);

    if($run_appointment) {
        echo "<script> window.alert('Succesfully Updated'); window.location.href='home.php'; </script>";
    }else{
        echo "<script>alert('Something went wrong'); </script>" . $conn->error;
    }
}






?>
