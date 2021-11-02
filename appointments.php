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
    <title>Document</title>
</head>
<body>
    <a href="home.php">Back</a>
    <h3>Your Appointments</h3>

    <!--gagawa ako dito ng history ng appointments nya--->
    

    
                
    <table>
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

    <h3>On going Appointments</h3>
    
    
    <?php
    
    $date = date('y-m-d');
    
    $query_Appointments1 = "SELECT * FROM appointments WHERE appointments.name_of_patient = '$full_name' AND appointments.appointment_date = '$date'";
    $run1 = mysqli_query($conn,$query_Appointments1);

    if($run1){
        if(mysqli_num_rows($run1) > 0){
            foreach($run1 as $row1){
                ?>

                    <table>
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
            echo "No appointments yet";
        }
    }
    
    ?>
</body>
</html>
