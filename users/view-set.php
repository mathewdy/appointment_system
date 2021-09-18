
<?php
include('connection.php');
session_start();
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
}

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
    <a href="set-appointment.php">Back</a> <br>
    <?php
        $query = "SELECT users.doctor_or_secretary,users.email,users.first_name,users.last_name,doctors_details.specialization
        FROM users
        LEFT JOIN doctors_details ON users.id = doctors_details.user_id
        WHERE users.id = '$id'";
        $run = mysqli_query($conn,$query);

        if(mysqli_num_rows($run) > 0){
            foreach($run as $row){
                ?><!----mag seset na to ng patient-->
                    <form action="set-patient.php" method="POST">
                        <label for=""><b>Specialization</b></label>
                        <input type="text" name="specialization" value="<?php echo $row ['specialization']?>" readonly> <br>
                        <label for="">Full Name</label>
                        <input type="text" name="full_name" value="<?php echo $row ['first_name'] . " " . $row ['last_name']?>" readonly> <br>
                        <label for="">Email</label> 
                        <input type="text" name="email" value="<?php echo $row ['email']?>" readonly><br>
                        <input type="submit" name="confirm" value="Next"> 
                    </form>
                <?php
            }
        }
    ?>

</body>
</html>