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
        <div class="col-md-2"></div>
            <table class="table table-responsive table-striped table-hover caption-top" id="table_data">
                <caption style="font-size: 20px;">List of Patients</caption>
                    <thead>
                        <tr>
                            <th scope="col">Patient ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Options</th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php
                    if(isset($_POST['search'])){
                        $search = $_POST['search'];

                        if(strlen($search) > 1){
                            $query = "SELECT * FROM patients WHERE first_name LIKE '$search%' || last_name LIKE '$search%'";
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
                                                <td><?php echo $row ['date_of_birth']?></td>
                                                <td><?php echo $row ['mobile_number']?></td>
                                                <td><?php echo $row ['email']?></td>
                                                <td>
                                                <a href="edit-patient.php?patient_id=<?php echo $row['patient_id']?>" class="btn btn-secondary">Edit</a>
                                            
                                                </td>
                                                <td>
                                                <a href="delete-patient.php?patient_id=<?php echo $row ['patient_id']?>" class="btn btn-danger"> Delete </a>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>

                                        <?php
                                    }
                                }else{
                                    echo '<div class="text-danger">'. '<h3>'  . "No data" . '</h3>' .'</div>' . $conn->error;
                                }
                            }
                        }else{
                    ?>
    <div class="container">
        <div class="table-responsive">
                <table class="table table-responsive table-striped table-hover caption-top" id="table_data">
                        <?php
                            $query = "SELECT * FROM patients";
                            $run = mysqli_query($conn,$query);

                            if(mysqli_fetch_assoc($run) > 0){
                                foreach($run as $row){
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $row ['patient_id']?></td>
                                        <td><?php echo $row ['first_name']?></td>
                                        <td><?php echo $row ['last_name']?></td>
                                        <td><?php echo $row ['date_of_birth']?></td>
                                        <td><?php echo $row ['mobile_number']?></td>
                                        <td><?php echo $row ['email']?></td>
                                        <td>
                                        <a href="edit-patient.php?patient_id=<?php echo $row['patient_id']?>" class="btn btn-secondary">Edit</a>
                                        </td>
                                        <td>
                                        <a href="delete-patient.php?patient_id=<?php echo $row ['patient_id']?>" class="btn btn-danger"> Delete </a>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                                }
                            }
                        ?>
                    <?php
                }
            }
        ?>
                </table>
            </div>
        </div>
    </div>

</body>
</html>

