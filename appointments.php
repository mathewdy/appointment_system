<?php

include('connection.php');
session_start();
$id = $_SESSION['patient_id'];
$full_name = $_SESSION['first_name'] . " ". $_SESSION['last_name'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/appointments.css">
    <title>Document</title>
</head>
<body>
    <div class="gen-container">
<section class="content-header">
    <button><a style="text-decoration:none; color:black;" href="home.php">Back</a></button>
    <div class="logo">
        <img src="css/logo.png" alt="Logo">
    </div>
</section>
    <h3 style="color:white; font-family:sans-serif; font-size:25px; text-align:center;">Your Appointments</h3>

    <!--gagawa ako dito ng history ng appointments nya--->
    

    
                
    <table id="appointment">
        <tr>
            <th>Appointment Date</th>
            <th>Appointment Time</th>
            <th>Doctor</th>
            <th>Date Submitted </th>
        
        </tr>
        <?php
        $query_appointments = "SELECT * FROM appointments WHERE appointments.name_of_patient = '$full_name'";
        $run_appointments = mysqli_query($conn,$query_appointments);

        if($run_appointments){
            if(mysqli_num_rows($run_appointments)> 0){
                foreach($run_appointments as $row){
                        ?>

                            <tr>
                                <td><?php echo $row ['appointment_date']?></td>
                                <td><?php echo $row ['appointment_time']?></td>
                                <td><?php echo $row ['name_of_doctor']?></td>
                                <td><?php echo $row ['date_time_created']?></td>
                            </tr>

                        <?php
                
                    }
                }
            }

        ?>
    </table>

    <h3 style="color:white; font-family:sans-serif; font-size:25px; text-align:center;">On going Appointments</h3>
    
    
    <?php
    
    $date = date('y-m-d');
    
    $query_Appointments1 = "SELECT * FROM appointments WHERE appointments.name_of_patient = '$full_name' AND appointments.appointment_date = '$date'";
    $run1 = mysqli_query($conn,$query_Appointments1);

    if($run1){
        if(mysqli_num_rows($run1) > 0){
            foreach($run1 as $row1){
                ?>

                    <table id="ongoing">
                        <tr>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Doctor</th>
                            <th>Date Submitted:</th>
                        </tr>
                        <tr>
                            <td><?php echo $row ['appointment_date']?></td>
                            <td><?php echo $row ['appointment_time']?></td>
                            <td><?php echo $row ['name_of_doctor']?></td>
                            <td><?php echo $row ['date_time_created']?></td>
                        </tr>
                    </table>

                    
                <?php
            }
        }else{
            echo '<b style="color: white; font-family:sans-serif; font-size:15px;">'. '<center>'. "No appointments yet" . '</center>'. '</b>';
        }
    }
    
    ?>
</body>
</html>
