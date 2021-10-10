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
    <a href="home.php">Back</a>
    <?php

    $query_whole_profile_Doc = "SELECT users.first_name, users.last_name , users.mobile_number, doctors_details.specialization ,doctors_details.internship,
    doctors_details.residency,doctors_details.hmo,doctors_details.doc_picture, users.doctor_or_secretary
    FROM users 
    LEFT JOIN doctors_details ON users.id = doctors_details.user_id 
    WHERE users.doctor_or_secretary = 'doctor'";
    $run = mysqli_query($conn,$query_whole_profile_Doc);

    if(mysqli_num_rows($run) > 0){
        foreach ($run as $row){
            ?>

                <h2><?php echo $row ['specialization']?></h2>
                <p><?php echo $row ['first_name'] . $row ['last_name']?></p>
                <p><?php echo $row ['mobile_number']?></p>
                <p><?php echo $row ['internship']?></p>
                <p><?php echo $row ['residency']?></p>
                <p><?php echo $row ['hmo']?></p>
                <img src="<?php echo "doc_picture/" . $row ['doc_picture']?>" width="100px" alt="Doctor Pic">

            <?php
        }
    }
    ?>
</body>
</html>