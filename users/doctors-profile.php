<?php

session_start();
include('../connection.php');

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
    <a href="set-appointment.php">Back</a>
    <?php

    $id = $_GET['account_id'];
    

    $select_doctors_Details = "SELECT users.first_name,users.last_name,users.mobile_number,
    doctors_details.doc_picture,doctors_details.specialization,doctors_details.user_id,users.id 
    FROM users 
    LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id
    WHERE users.account_id = '$id'";
    
    $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);

    if(mysqli_num_rows($run_doctors_Details) > 0){
        foreach ($run_doctors_Details as $row){
            ?>

                <form action="set-patient.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row ['user_id']?>">
                    <label for="">Doctor : </label>
                    <input type="text" name="name_of_doctor" value="<?php echo $row ['first_name']. " " . $row ['last_name']?>"><br>
                    <label for="">Specialization: </label>
                    <input type="text" name="specialization" value="<?php echo $row ['specialization']?>"> <br>
                    <input type="submit" name="select_doctor" value="Select">

                </form>

            <?php
        }
    }
    
?>
    
</body>
</html>

