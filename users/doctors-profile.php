<?php

session_start();
include('connection.php');

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

    $id = $_GET['id'];

    $select_doctors_Details = "SELECT users.first_name,users.last_name,users.mobile_number, users.id, doctors_details.user_id,
    doctors_details.specialization, doctors_details.internship, doctors_details.residency,
    doctors_details.hmo, doctors_details.doc_picture
    FROM users
    LEFT JOIN doctors_details ON users.id = doctors_details.user_id WHERE users.id = '$id'";
    $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);

    if(mysqli_num_rows($run_doctors_Details) > 0){
        foreach ($run_doctors_Details as $row){
            ?>

                <form action="set-patient.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row ['id']?>">
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

