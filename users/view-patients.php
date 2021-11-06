<?php

include('../connection.php');
session_start();
if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login.php'</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/view-patients.css">
</head>
<body>
 
<br>
<div class="back">
    <form action="home.php" method="POST">
        <input type="submit" name="home" value="Back">
    </form>
</div>

<h2><i>Data of Patients</i></h2>
<?php

//baka mag lagay pa ako ng search patients SHASHAHSHAH 

$query_patients = "SELECT * FROM patients";
$run = mysqli_query($conn,$query_patients);

if(mysqli_num_rows($run) > 0){
    foreach($run as $row){
        ?>
        <ul class="card-container">   
            <li>
                <div class= "card">
                        <div class="card-body">
                            <h3><?php echo $row ['first_name'] . " ".  $row ['last_name']?></h3><br>
                            <b><i><label for="">Age</label></i></b><br>
                            <?php echo $row ['age']?><br><br>
                            <b><i><label for="">Gender</label></b></i><br>
                            <?php echo $row ['gender']?><br><br>
                            <b><i><label for="">Birthday</label></b></i><br>
                            <?php echo $row ['date_of_birth']?><br><br>
                            <b><i><label for="">Contact Number</label></b></i><br>
                            <?php echo $row ['mobile_number']?><br><br>
                            <b><i><label for="">Email</label></b></i><br>
                            <?php echo $row ['email']?><br><br>
                        </p>
                        </div>        
                </div>
            </li>
        </ul>
        <?php
    }
}else{
    echo "No Patients ". $conn->error;
}

?>
</body>
</html>