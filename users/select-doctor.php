<?php

include('../connection.php');
session_start();


$secretary = $_SESSION['first_name'] . " " . $_SESSION['last_name'];


if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 1;
}

$num_per_page = 05;
$start_from = ($page-1)*05;




if(isset($_POST['next'])){
    $patient_first_name = $_POST['patient_first_name'];
    $patient_last_name = $_POST['patient_last_name'];
    $appointment_time = $_POST['appointment_time'];
    $mobile_number = $_POST['mobile_number'];

    $appointment_date = date('Y-m-d', strtotime($_POST['appointment_date']));

    $patient_id = $_POST['patient_id'];
    $full_name_of_patient = $patient_first_name ." " . $patient_last_name;
    
    
    
    $query_validation_appointment = "SELECT * FROM appointments WHERE patient_id = '$patient_id' ";
    $run_validation = mysqli_query($conn,$query_validation_appointment);

    if(mysqli_num_rows($run_validation) > 0){
        echo "<script>alert('Patient Already Set Appointment') </script> ";
        echo "<script>window.location.href='set-appointment.php' </script>";
        exit();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>




<body>
<br><br>
<div class="container">
    <a href="set-appointment.php">Cancel</a>
    <div class="card">
        <div class="card-body">
            <div class="col-md-3">
                <form action="search-specialization.php" method="POST">
                    <label for="validationCustom04" class="form-label">Specialization</label>
                    <select class="form-select" name="specialization" id="validationCustom04" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="Allergy and immunology">Allergy and immunology</option>
                    <option value="Anesthesiology">Anesthesiology</option>
                    <option value="Dermatology">Dermatology</option>
                    <option value="Diagnostic radiology">Diagnostic radiology</option>
                    <option value="Emergency medicine">Emergency medicine</option>
                    <option value="Family medicine">Family medicine</option>
                    <option value="Internal medicine">Internal medicine</option>
                    <option value="Medical genetics">Medical genetics</option>
                    <option value="Neurology">Neurology</option>
                    <option value="Nuclear medicine">Nuclear medicine</option>
                    <option value="Obstetrics and gynecology">Obstetrics and gynecology</option>
                    <option value="Ophthalmology">Ophthalmology</option>
                    <option value="Pathology">Pathology</option>
                    <option value="Pediatrics">Pediatrics</option>
                    <option value="Physical medicine and rehabilitation">Physical medicine and rehabilitation</option>
                    <option value="Preventive medicine">Preventive medicine</option>
                    <option value="Psychiatry">Psychiatry</option>
                    <option value="Radiation oncology">Radiation oncology</option>
                    <option value="Surgery">Surgery</option>
                    <option value="Urology">Urology</option>
                    </select>
                    <div class="invalid-feedback">
                        Please Select Specialization
                    </div><br>
                    <input type="hidden" name="patient_first_name" value="<?php echo $patient_first_name?>">
                    <input type="hidden" name="patient_last_name" value="<?php echo $patient_last_name?>">
                    <input type="hidden" name="appointment_time" value="<?php echo $appointment_time?>">
                    <input type="hidden" name="appointment_date" value="<?php echo $appointment_date?>">
                    <input type="hidden" name="mobile_number" value="<?php echo $mobile_number?>">
                    <input type="hidden" name="patient_id" value="<?php echo $patient_id?>">
                    <div class="col-12">
                        <input type="submit" name="search" class="btn btn-primary" value="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row mt-4">
        <?php
            $query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
            WHERE users.doctor_or_secretary='doctor' LIMIT $start_from , $num_per_page";
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
            

        ?>
        
    </div>


<?php

$pr_query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
WHERE users.doctor_or_secretary='doctor'";
$pr_result = mysqli_query($conn,$pr_query);
$total_record = mysqli_num_rows($pr_result);

$total_page = ceil($total_record / $num_per_page);

if($page > 1 ){
    echo  "<a href='home.php?page=".($page-1)."' class='btn btn-danger'>Previous</a> ";
}

for($i=1;$i<$total_page;$i++){

    echo  "<a href='home.php?page=".$i."' class='btn btn-primary'>$i</a> ";
}

 if($i > $page ){
    echo  "<a href='home.php?page=".($page+1)."' class='btn btn-danger'>Next</a> ";
}

?>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
