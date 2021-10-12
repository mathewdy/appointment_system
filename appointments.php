<?php

include('connection.php');
session_start();
$id = $_SESSION['id'];

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
    <?php

    $query_Appointments = "SELECT appointments.appointment_date, appointments.appointment_time , users.last_name , appointments.date_time_created
    FROM appointments
    LEFT JOIN users ON appointments.users_id = users.id
    WHERE appointments.patients_id = '$id'";
    $run = mysqli_query($conn,$query_Appointments);

    if($run){
        if(mysqli_num_rows($run) > 0){
            foreach($run as $row){
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
                            <td><?php echo $row ['last_name']?></td>
                            <td><?php echo $row ['date_time_created']?></td>
                        </tr>
                    </table>

                <?php
            }
        }
    }
    ?>

    <h3>On going Appointments</h3>
    <?php
    $date = date('y-m-d');
    
    $query_Appointments1 = "SELECT appointments.appointment_date, appointments.appointment_time , users.last_name , appointments.date_time_created
    FROM appointments
    LEFT JOIN users ON appointments.users_id = users.id
    WHERE appointments.patients_id = '$id' AND appointments.appointment_date = '$date'";
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
                            <td><?php echo $row ['last_name']?></td>
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