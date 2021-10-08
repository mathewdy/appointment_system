<?php

include('connection.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="home.php">Back</a>
    <h3>Search Appointments</h3>
    
    
    <form action="#" method="POST">
        <label for="">Select Specialization</label>
        <select name="specialization" id="">
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
</body>
</html>

<?php


if(isset($_POST['select'])){
    date_default_timezone_set('Asia/Manila');
    $send_date = date("Y-m-d");
    echo $send_date . '<br>';

    $specialization = $_POST['specialization'];
    
    $query_appointment_details = "SELECT appointments.appointment_date,appointments.appointment_time,appointments.id_doctor,
    appointments.name_of_patient,appointments.date_time_created,appointments.remarks, appointments.id,doctors_details.specialization,
    users.first_name,users.last_name ,users.mobile_number 
    FROM appointments 
    LEFT JOIN doctors_details ON appointments.id_doctor = doctors_details.user_id 
    LEFT JOIN users ON appointments.id_doctor = users.id WHERE specialization = '$specialization' 
    AND appointment_date = '$send_date'";

    $run_appointment_details = mysqli_query($conn,$query_appointment_details);

    if($run_appointment_details){
        if(mysqli_num_rows($run_appointment_details) > 0){
            foreach($run_appointment_details as $row){
                ?>

                    <table>
                        <tr>
                            <th>Specialization</th>
                            <th>Name of Doctor</th>
                            <th>Name of Patient</th>
                            <th>Date & Time</th>
                            <th>Remarks</th>
                        </tr>
                        <tr>
                            <td><?php echo $row ['specialization']?></td>
                            <td><?php echo $row ['first_name'] . $row ['last_name']?></td>
                            <td><?php echo $row ['name_of_patient']?></td>
                            <td><?php echo $row ['appointment_date'] . " ". $row ['appointment_time']?></td>
                            <td><?php echo $row ['remarks']?></td>
                            <td>
                                <form action="view-details.php" method="POST">
                                    <input type="submit" name="edit" value="Edit">
                                    <input type="hidden" name="id" value="<?php echo $row ['id']?>">
                                    <input type="hidden" name="appointment_date" value="<?php echo $row['appointment_date']?>">
                                    <input type="hidden" name="appointment_time" value="<?php echo $row ['appointment_time']?>">
                                    <input type="hidden" name="remarks" value="<?php echo $row ['remarks']?>">
                                    <input type="hidden" name="name_of_patient" value="<?php echo $row ['name_of_patient']?>">
                                    <input type="hidden" name="id_doctor" value="<?php echo $row ['id_doctor']?>">
                                    <input type="hidden" name="date_time_created" value="<?php echo $row ['date_time_created']?>">
                                   
                                </form> 
                                                               
                            </td>
                        </tr>
                        
        
                    
                    </table>

                <?php
            }
        }else{
            echo "no appointment" . $conn->error;
        }
    }   

}

?>