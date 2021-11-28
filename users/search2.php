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
            <table class="table table-responsive table-striped table-hover caption-top" id="table_data">
                    <thead>
                        <tr>
                            <th scope="col">Account ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">Mobile Number</th>
                            <th scope="col">Email</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    if(isset($_POST['search']))
                    {

                        $search = $_POST['search'];
                        
                        $query= "SELECT * FROM users 
                        LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id WHERE first_name LIKE '$search%' || doctor_or_secretary LIKE 'doctors%' ||
                         last_name LIKE '$search%' || account_id LIKE '$search%' || specialization LIKE '$search%'";
                        $run_query = mysqli_query($conn,$query);

                        if($run_query){
                            if(mysqli_num_rows($run_query)){
                                foreach($run_query as $row){
                                    ?>
                                        <tr>
                                            <td><?php echo $row ['account_id']?></td>
                                            <td><?php echo $row ['first_name']?></td>
                                            <td><?php echo $row ['last_name']?></td>
                                            <td><?php echo $row ['specialization']?></td>
                                            <td>
                                                <a href="view-doctors-profile.php?account_id=<?php echo $row ['account_id']?>"  class="btn btn-info">View</a>
                                            </td>
                                            <td>
                                                <a href="edit-doctors-profile.php?account_id=<?php echo $row ['account_id']?>" class="btn btn-secondary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="delete-doctors-profile.php?account_id=<?php echo $row ['account_id']?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo '<div class="text-danger">'. '<h3>'  . "No data" . '</h3>' .'</div>' . $conn->error;
                            }
                        }
                    }
                    ?>
                    </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>