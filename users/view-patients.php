<?php

include('connection.php');
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

//baka mag lagay pa ako ng search patients SHASHAHSHAH 

$query_patients = "SELECT * FROM patients";
$run = mysqli_query($conn,$query_patients);

if(mysqli_num_rows($run) > 0){
    foreach($run as $row){
        ?>


            <h3><?php echo $row ['first_name'] . " ".  $row ['last_name']?></h3>
            <p><?php echo $row ['age']?></p>
            <p><?php echo $row ['gender']?></p>
            <p><?php echo $row ['date_of_birth']?></p>
            <p><?php echo $row ['mobile_number']?></p>
            <p><?php echo $row ['email']?></p>

        <?php
    }
}

?>
</body>
</html>