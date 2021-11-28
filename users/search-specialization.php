<?php


include('../connection.php');
session_start();
$secretary = $_SESSION['first_name'] . " " . $_SESSION['last_name'];



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
<div class="container py-5">
    <div class="row mt-4">
        <a href="select-doctor.php">Back</a>
        <?php

        if(isset($_POST['search'])){    
            $specialization = $_POST['specialization'];
            

            $patient_first_name = $_POST['patient_first_name'];
            $patient_last_name = $_POST['patient_last_name'];
            $appointment_time = $_POST['appointment_time'];
            $mobile_number = $_POST['mobile_number'];
        
            $appointment_date = date('Y-m-d', strtotime($_POST['appointment_date']));
        
            $patient_id = $_POST['patient_id'];
            $full_name_of_patient = $patient_first_name ." " . $patient_last_name;
            
        

            $query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
            WHERE users.doctor_or_secretary='doctor' AND specialization='$specialization'";
            $run = mysqli_query($conn,$query);
            $check = mysqli_num_rows($run) > 0;

            if($check){
                while($row = mysqli_fetch_array($run)){
                    ?>
                    <div class="col-md-4 mt-3">
                        <div class="card">
                            <img src="<?php echo "doc_picture/" .$row ['doc_picture'] ?>" width="200px" height="200px" class="card-omg-top"  alt="doctor">
                            <div class="card-body" >
                                <form action="add-appointment.php" method="POST">
                                <h2 class="card-title"><?php echo $row ['specialization']?></h2>
                                <p class="card-text"><?php echo $row ['first_name']?> <?php echo $row ['last_name']?></p>
                                <input type="hidden" name="appointment_date" value="<?php echo $appointment_date?>">
                                <input type="hidden" name="appointment_time" value="<?php echo $appointment_time?>">
                                <input type="hidden" name="account_id" value="<?php echo $row ['account_id']?>">
                                <input type="hidden" name="name_of_doctor" value="<?php echo $row ['first_name'] . " " .$row['last_name']?>">
                                <input type="hidden" name="name_of_secretary" value="<?php echo $secretary?>">
                                <input type="hidden" name="name_of_patient" value="<?php echo $patient_first_name . " " . $patient_last_name ?>">
                                <input type="hidden" name="patient_id" value="<?php echo $patient_id?>">
                                <input type="hidden" name="mobile_number" value="<?php echo $mobile_number?>">
                                <input type="submit" class="btn btn-success" name="appointment_set" value="Select Doctor">
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }else{
                echo "no data found"; 
            }
            
        }
        ?>
        
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>