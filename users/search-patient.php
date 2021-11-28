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
            <table class="table table-responsive  table-hover caption-top" id="table_data">
                <caption style="font-size: 20px;">List of Patients</caption>
                    <thead>
                        <tr>
                            <th scope="col">Patient ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Set Appointment </th>
                            
                        </tr>
                    </thead>
                   <?php

                    if(isset($_POST['search'])){

                        $search = $_POST['search'];  


                        $query = "SELECT * FROM patients WHERE first_name LIKE '$search%' || last_name LIKE '$search%' || patient_id LIKE '$search' LIMIT 5";
                        $run = mysqli_query($conn,$query);
                        if($run){
                            if(mysqli_num_rows($run) > 0){
                                foreach($run as $row){
                                    ?>
    
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row ['patient_id']?></td>
                                            <td><?php echo $row ['first_name']?></td>
                                            <td><?php echo $row ['last_name']?></td>
                                            <td>
                                                <a href="set-patient.php?patient_id=<?php echo $row ['patient_id']?>">Set Appointment</a>
                                            </td>
                                        </tr>
                                    </tbody>
    
                                    <?php
                                }
                            }else{
                                echo "No data". $conn->error;
                            }
                        }

                    }

                        
                    ?>
            </table>  
        </div>  
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>