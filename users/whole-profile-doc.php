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
    <link rel="stylesheet" href="../css/whole-profile-doc.css">
</head>
<body>
    <br>
        <div class="back">
        <form action="home.php" method="POST">
            <input type="submit" name="home" value="Back">
        </form>
        </div><br><br>
    <?php
    $id = $_GET['user_id'];

    $query_whole_profile_Doc = "SELECT users.doctor_or_secretary, users.account_id,users.first_name,
    users.last_name,users.gender,users.mobile_number,doctors_details.specialization,
    doctors_details.hmo,doctors_details.doc_picture,doctors_details.internship,doctors_details.residency
    FROM users
    LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id
    WHERE doctors_details.user_id = '$id'";
    $run = mysqli_query($conn,$query_whole_profile_Doc);

    if(mysqli_num_rows($run) > 0){
        foreach ($run as $row){
            ?>
            <ul class="card-container">   
                <li>
                    <div class= "card">   
                        <br>
                            <div class="card-body">
                                <h5 class="card-title"> <?php echo $row ['first_name'] . $row ['last_name']?> </h5>
                                <h4 class="card-title"> <?php echo $row ['specialization']?> </h4>
                                <p class="card-text">
                                    <b><i><label for="">Contact Number</label></b></i><br>
                                    <?php echo $row ['mobile_number']?><br>
                                    <b><i><label for="">Internship</label></b></i><br>
                                    <?php echo $row ['internship']?><br>
                                    <b><i><label for="">Residency</label></b></i><br>
                                    <?php echo $row ['residency']?><br>
                                    <b><i><label for="">HMO</label></b></i><br>
                                    <?php echo $row ['hmo']?>
                                </p>
                            </div> <br>
                            <div class="image">
                                <img src="<?php echo "doc_picture/" . $row ['doc_picture']?>" width="200px" height="200px">
                            </div>        
                    </div>
                </li>
            </ul>
            <?php
        }
    }
    ?>
</body>
</html>