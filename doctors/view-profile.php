<?php

include('../connection.php');
session_start();

$account_id = $_SESSION['account_id'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <a href="home.php">Back</a>
    <h2>Your Profile</h2>

    <?php

    $query = "SELECT * FROM users 
    LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id WHERE users.account_id = '$account_id'";
    $run = mysqli_query($conn,$query);

    if(mysqli_num_rows($run) > 0){
        foreach($run as $row){
            ?>  

                Account Id: <?php echo $row ['account_id']?>  <br>
                Profile Picture: <img src="<?php echo "profile_picture/" .$row['doc_picture']; ?>" alt="Profile Picture" width="200px" height="200px"> <br>
                First Name: <?php echo $row ['first_name']?> <br>
                Last Name:  <?php echo $row ['last_name']?> <br>
                Mobile Number:  <?php echo $row ['mobile_number']?> <br>
                Specialization:  <?php echo $row ['specialization']?> <br>
                Internship:  <?php echo $row ['internship']?> <br>
                Residency:  <?php echo $row ['residency']?> <br>
                HMO:  <?php echo $row ['hmo']?> <br>

                <a href="edit-profile.php?account_id=<?php echo $row ['account_id']; ?>">Edit Profile</a>
            <?php
        }
    }
    ?>
</body>
</html>