<?php

include('../connection.php');
session_start();
$name_of_patient = $_SESSION['first_name'] . " " . $_SESSION['last_name'];
$patient_id = $_SESSION['patient_id'];
$patient_mobile_number = $_SESSION['mobile_number'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>

<div class="container">
    <a href="home2.php">Back</a>
    <div class="card">
        <div class="card-body">
            <?php

                if(isset($_GET['account_id'])){
                    $account_id =  $_GET['account_id'];
                    $query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
                    WHERE users.doctor_or_secretary = 'doctor' AND users.account_id = '$account_id'";
                    $run = mysqli_query($conn,$query);

                    if(mysqli_num_rows($run) > 0){
                        foreach ($run as $row ){
                            ?>
                            <form class="row g-3 needs-validation" method="POST"  action=""  novalidate>
                            <input type="hidden" name="patient_id" value="<?php echo $patient_id?>">
                            <input type="hidden" name="name_of_patient" value="<?php echo $name_of_patient?>">
                            <input type="hidden" name="account_id" value="<?php echo $row ['account_id']?>">
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">First name</label>
                                <input type="text" class="form-control" id="validationCustom01" name="first_name" value="<?php echo $row ['first_name']?>" readonly required>
                                <div class="invalid-feedback">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Last name</label>
                                <input type="text" class="form-control" id="validationCustom01" name="last_name" value="<?php echo $row ['last_name']?>" readonly required>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" id="validationCustom01" name="mobile_number" value="<?php echo $row['mobile_number']?>" readonly required>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Specialization</label>
                                <input type="text" class="form-control" id="validationCustom01" name="specialization" value="<?php echo $row ['specialization']?>" readonly required>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">HMO</label>
                                <input type="text" class="form-control" id="validationCustom01" name="hmo" value="<?php echo $row ['hmo']?>" readonly required>
                                <div class="invalid-feedback">
                                    
                                </div>
                            </div>

                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip01" class="form-label">Time</label>
                                <select class="form-select" id="validationTooltip01" name="appointment_time" required>
                                <option selected disabled value="">Appointment Time</option>
                                <option value="09:00:00 AM">09:00 AM</option>
                                <option value="09:30:00 AM">09:30 AM</option>
                                <option value="10:00:00 AM">10:00 AM</option>
                                <option value="10:30:00 AM">10:30 AM</option>
                                <option value="11:00:00 AM">11:00 AM</option>
                                <option value="11:30:00 AM">11:30 AM</option>
                                <option value="12:00:00 PM">12:00 PM</option>
                                <option value="12:30:00 PM">12:30 PM</option>
                                <option value="01:00:00 PM">01:00 PM</option>
                                <option value="01:30:00 PM">01:30 PM</option>
                                <option value="02:00:00 PM">02:00 PM</option>
                                <option value="02:30:00 PM">02:30 PM</option>
                                <option value="03:00:00 PM">03:00 PM</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Please Select Time
                                </div>
                            </div>

                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip01" class="form-label">Date</label>
                                <input type="text" class="form-control" name="appointment_date" id="datepicker" required>
                                <div class="invalid-tooltip">
                                    Please Select Date
                                </div>
                            </div>

                            <div class="col-12">
                                <input class="btn btn-primary" type="submit" name="appointment_set" value="Appointment Set">
                            </div>

                            

                            </form>
                            <?php
                        }
                    }
                }

            ?>
        </div>
    </div>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<script>     
    $(function() {
        var date_today = new Date();
        $( "#datepicker" ).datepicker({
            minDate: date_today,
            minDate: 4,
            beforeShowDay: function(d) {
                var day = d.getDay()
                return [(day != 0 && day != 1)];
              
            }
        });
    });
</script>

</body>
</html>


<?php

require_once __DIR__.'/vendor/autoload.php';


if(isset($_POST['appointment_set'])){

    $appointment_date = date('Y-m-d', strtotime($_POST['appointment_date']));
    $appointment_time = $_POST['appointment_time'];
    $account_id = $_POST['account_id'];

    $fname_doctor = $_POST['first_name'];
    $lname_doctor = $_POST['last_name'];
    $name_of_doctor = $fname_doctor . " " . $lname_doctor;

    $patient_id = $_POST['patient_id'];
    $name_of_patient = $_POST['name_of_patient'];

    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    $date = date('y-m-d');
    $remarks = "Pending Appointment";
    $msg = "Hi! this is your appointment details from Novaliches General Hospital. Your appointment date & time is on $appointment_date $appointment_time , and your doctor is $name_of_doctor please go to your appointment schedule on time. Thank you so much! ";
    

    $query_validation = "SELECT * FROM appointments WHERE patient_id = '$patient_id'";
    $run_validation = mysqli_query($conn,$query_validation);

    if(mysqli_num_rows($run_validation) > 0) {
        echo "<script>alert('You still have an appointment') </script>";
        echo "<script>window.location.href='home2.php' </script>";
    }else{
        $query_insert = "INSERT INTO appointments (appointment_date,appointment_time,account_id,name_of_doctor,name_of_secretary,patient_id,name_of_patient,date_time_created,date_time_updated,remarks)
        VALUES ('$appointment_date', '$appointment_time', '$account_id', '$name_of_doctor', NULL, '$patient_id', '$name_of_patient', '$date $time', '$date $time' , '$remarks')" ;
        $run_insert = mysqli_query($conn,$query_insert);
        
        if($run_insert){
        
            $messagebird = new MessageBird\Client('PH3gUfd3eRJKimCHXcsy70gJC');
            $message = new MessageBird\Objects\Message;
            $message->originator = '+639156915704';
            $message->recipients = $patient_mobile_number;
            $message->body = $msg;
            $response = $messagebird->messages->create($message);
            echo "sucess";
            echo "<script>window.location.href='appointments.php' </script>";
        }else{
            echo "error". $conn->error;
        }
    }

}

?>
