<?php


include('../connection.php');
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
<div class="container">
    <div class="table-responsive">
        <table class="table table-responsive  table-striped table-hover caption-top" id="table_data">
            <caption style="font-size: 20px;">List of Patients</caption>
                <thead>
                    <tr>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Appointment Time</th>
                        <th scope="col">Name of Doctor</th>
                        <th scope="col">Doctor ID</th>
                        <th scope="col">Name of Patient</th>
                        <th scope="col">Patient ID</th>
                    </tr>
                </thead>
                <?php

                    if(isset($_POST['search'])){
                        $search = $_POST['search'];
                        

                        $query = "SELECT * FROM appointment_history WHERE appointment_date LIKE '$search%' || 
                        name_of_doctor LIKE '$search%' || name_of_patient LIKE '$search%' || patient_id LIKE '$search%' ";
                        $run = mysqli_query($conn,$query);

                        if(mysqli_num_rows($run) > 0){
                            foreach($run as $row ){
                                ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row ['appointment_date']?></td>
                                            <td><?php echo $row ['appointment_time']?></td>
                                            <td><?php echo $row ['name_of_doctor']?></td>
                                            <td><?php echo $row ['account_id']?></td>
                                            <td><?php echo $row ['name_of_patient']?></td>
                                            <td><?php echo $row ['patient_id']?></td>
                                        </tr>
                                    </tbody>
                                <?php
                            }
                        }else{
                            echo '<div class="text-danger">'. '<h3>'  . "No data" . '</h3>' .'</div>' . $conn->error;
                        }
                    }

                ?>

        </table>
    </div>
</div>                    
                    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>