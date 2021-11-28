<?php

include('../connection.php');
session_start();

$sec_fname = $_SESSION['first_name'];
$sec_lname = $_SESSION['last_name'];

$full_name_sec = $sec_fname . " " . $sec_lname ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <a href="appointment.php">Back</a>
    </div>

<?php

if(isset($_GET['patient_id'])){
    $patient_id = $_GET['patient_id'];

    $query = "SELECT * FROM appointments WHERE patient_id = '$patient_id'";
    $run = mysqli_query($conn,$query);

    if(mysqli_num_rows($run) > 0){
        foreach($run as $row){
            ?>
                <div class="container">

                    <form class="row g-3 needs-validation" action="#" method="POST" novalidate>
                        <div class="col-md-4">
                            <input type="hidden" name="patient_id" value="<?php echo $row ['patient_id']?>">
                            <input type="hidden" name="account_id" value="<?php echo $row ['account_id']?>">
                            <label for="validationCustom01" class="form-label">Appointment Date</label>
                            <input type="text" class="form-control" name="appointment_date" id="validationCustom01" value="<?php echo $row ['appointment_date']?>" required readonly>
                            <div class="invalid-feedback">
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Appointment Time</label>
                            <input type="text" class="form-control" name="appointment_time" id="validationCustom01" value="<?php echo $row ['appointment_time']?>" required readonly>
                            <div class="invalid-feedback">
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Name of Doctor</label>
                            <input type="text" class="form-control" name="name_of_doctor" id="validationCustom01" value="<?php echo $row ['name_of_doctor']?>" required readonly>
                            <div class="invalid-feedback">
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom01" class="form-label">Name of Patient</label>
                            <input type="text" class="form-control" name="name_of_patient" id="validationCustom01" value="<?php echo $row ['name_of_patient']?>" required readonly>
                            <div class="invalid-feedback">
                            
                            </div>
                        </div>
                        <div class="col-12">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Update
                        </button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Update Remarks</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-6">
                                    <label for="validationCustom04" class="form-label"></label>
                                    <select class="form-select" id="validationCustom04" name="update_remarks" required>
                                    <option selected disabled value="">Choose...</option>
                                    <option value="Pending Appointment">Pending Appointment</option>
                                    <option value="Patient Arrived">Patient Arrived</option>
                                    <option value="Cancelled Appointment">Cancelled Appointment</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Remarks Update
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="update" value="Update Set">
                            </div>
                            </div>
                        </div>
                        </div>
                    </form>
                    
                </div>
            <?php
        }
    }
}

?>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>


<?php


if(isset($_POST['update'])){
    $patient_id = $_POST['patient_id'];
    $update_remarks = $_POST['update_remarks'];
    $account_id = $_POST['account_id'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $name_of_doctor = $_POST['name_of_doctor'];
    $name_of_patient = $_POST['name_of_patient'];

    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    //year month date
    $date = date('y-m-d');

    if($update_remarks == 'Patient Arrived'){
        $query_insert_appointment_history = "INSERT INTO appointment_history (appointment_date,appointment_time,account_id,
        name_of_doctor,name_of_secretary,patient_id,name_of_patient,date_time_created,date_time_updated,remarks) VALUES 
        ('$appointment_date' , '$appointment_time' ,'$account_id' , '$name_of_doctor' , '$full_name_sec', 
        '$patient_id', '$name_of_patient', '$date $time', '$date $time', '$update_remarks')";
        $run_insert_appointment_history = mysqli_query($conn,$query_insert_appointment_history);

        if($run_insert_appointment_history){
            echo "added to database";
            $query_delete = "DELETE FROM appointments WHERE appointment_date = '$appointment_date' AND patient_id = '$patient_id' AND name_of_doctor='$name_of_doctor'
            AND account_id = '$account_id'  ";
            $run_delete = mysqli_query($conn,$query_delete);
            if($run_delete){
                echo "<script>window.location.href='appointment.php' </script>";
            }
        }else{
            echo "error" . $conn->error;
        }
    }

    if($update_remarks == 'Cancelled Appointment'){
        $query_insert_appointment_history = "INSERT INTO appointment_history (appointment_date,appointment_time,account_id,
        name_of_doctor,name_of_secretary,patient_id,name_of_patient,date_time_created,date_time_updated,remarks) VALUES 
        ('$appointment_date' , '$appointment_time' ,'$account_id' , '$name_of_doctor' , '$full_name_sec', 
        '$patient_id', '$name_of_patient', '$date $time', '$date $time', '$update_remarks')";
        $run_insert_appointment_history = mysqli_query($conn,$query_insert_appointment_history);

        if($run_insert_appointment_history){
            echo "added to database";
            $query_delete = "DELETE FROM appointments WHERE appointment_date = '$appointment_date' AND patient_id = '$patient_id' AND name_of_doctor='$name_of_doctor'
            AND account_id = '$account_id'  ";
            $run_delete = mysqli_query($conn,$query_delete);
            if($run_delete){
                echo "<script>window.location.href='appointment.php' </script>";
            }
        }else{
            echo "error" . $conn->error;
        }
    }

}

?>