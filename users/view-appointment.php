<?php

include('../connection.php');
session_start();
//HINDI PA TO TAPOS
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/view-appointment.css">
</head>
<body>
    <br>
    <div class="back">
    <form action="home.php" method="POST">
        <input type="submit" name="home" value="Back">
    </form>
    </div>
    <br>
    <h3><i>Search Appointments</i></h3>

    
    <div class="container">
    <form action="#" method="POST">
        <label for="">Select Specialization</label>
        <select name="specialization" id="">
        <option value="Select">-Select-</option>
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
        <input type="submit" name="select" value="Select"> 
    </form>
    </div><br>

<?php


if(isset($_POST['select'])){
    date_default_timezone_set('Asia/Manila');
    $send_date = date("Y-m-29");
    echo '<center>' . $send_date .'</center>'. '<br>';


    $specialization = $_POST['specialization'];
    
    $query_appointment_details = "SELECT appointments.appointment_date,
    appointments.appointment_time,appointments.name_of_doctor,appointments.name_of_patient,
    doctors_details.specialization, appointments.remarks,appointments.id,appointments.date_time_created,appointments.user_id
    FROM appointments
    LEFT JOIN doctors_details ON appointments.user_id = doctors_details.user_id
    WHERE doctors_details.specialization = '$specialization' AND appointments.appointment_date ='2021-10-28' ";

    $run_appointment_details = mysqli_query($conn,$query_appointment_details);

    if($run_appointment_details){
        if(mysqli_num_rows($run_appointment_details) > 0){
            foreach($run_appointment_details as $row){
      


	?>
    <ul class="card-container">   
        <li>
            <div class= "card">
                    <div class="card-body">
                        <p class="card-text">
                            <b><i><label for="">Specialization</label></i></b><br>
                            <?php echo $row ['specialization']?><br><br>
                            <b><i><label for="">Doctor</label></b></i><br>
                            <?php echo $row ['name_of_doctor']?><br><br>
                            <b><i><label for="">Patient</label></b></i><br>
                            <?php echo $row ['name_of_patient']?><br><br>
                            <b><i><label for="">Appointment Date & Time</label></b></i><br>
                            <?php echo $row ['appointment_date'] . " ". $row ['appointment_time']?><br><br>
                            <b><i><label for="">Remarks</label></b></i><br>
                            <?php echo $row ['remarks']?><br><br>
                        </p>
                        <form action="view-details.php" method="POST">
                                <input type="submit" name="edit" value="Edit">
                                <input type="hidden" name="id" value="<?php echo $row ['id']?>">
                                <input type="hidden" name="appointment_date" value="<?php echo $row['appointment_date']?>">
                                <input type="hidden" name="appointment_time" value="<?php echo $row ['appointment_time']?>">
                                <input type="hidden" name="remarks" value="<?php echo $row ['remarks']?>">
                                <input type="hidden" name="name_of_patient" value="<?php echo $row ['name_of_patient']?>">
                                <input type="hidden" name="id_doctor" value="<?php echo $row ['user_id']?>">
                                <input type="hidden" name="date_time_created" value="<?php echo $row ['date_time_created']?>">
                               
                            </form> 
                    </div>        
            </div>
        </li>
    </ul>
    <?php
            }
        }else{
            echo  '<b style="color: black;">'. '<center>'. "No Found " . '</center>'. '</b>' .$conn->error;
        }
    }   

}

?>
</body>
</html>