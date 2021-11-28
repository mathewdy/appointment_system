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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    
<a href="view-doctors.php">Back</a>
<?php

if(isset($_GET['account_id'])){
   $account_id = $_GET['account_id'];

    $query = "SELECT * FROM users
    LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id WHERE doctor_or_secretary = 'doctor' AND account_id='$account_id'";

    $run = mysqli_query($conn,$query);

    if(mysqli_num_rows($run) > 0){
        foreach($run as $row){
           ?>  
           <center>
                <div class="container">
                    <div class="card text-white bg-info mb-3 p-3 mb-2 bg-primary text-white" style="max-width: 540px; border-radius: 20px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="<?php echo "doc_picture/" . $row['doc_picture'] ?>" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row ['first_name'] . " " . $row ['last_name']?></h5>
                                        <b><label class="card-text text-dark">Specialization</label> </b>
                                        <p class="card-text text-dark"><?php echo $row ['specialization']?></p>
                                        <b><label class="card-text text-dark">Mobile Number</label> </b>
                                        <p class="card-text text-dark"><?php echo $row ['mobile_number']?></p>
                                        <b><label class="card-text text-dark">Email</label> </b>
                                        <p class="card-text text-dark"><small class="text-muted"></small><?php echo $row ['email']?></p>
                                        <b><label class="card-text text-dark">Date of Birth</label> </b>
                                        <p class="card-text text-dark"><?php echo $row ['date_of_birth']?></p>
                                        <b><label class="card-text text-dark">Internship</label></b>
                                        <p class="card-text text-dark"><?php echo $row ['internship']?></p>
                                        <b><label class="card-text text-dark">Residency</label></b>
                                        <p class="card-text text-dark"><?php echo $row ['residency']?></p>
                                        <b><label class="card-text text-dark">HMO</label></b>
                                        <p class="card-text text-dark"><?php echo $row ['hmo']?></p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
            <?php
        }
    }
}

?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>