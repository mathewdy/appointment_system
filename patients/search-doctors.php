<?php
include('../connection.php');
session_start();
error_reporting(E_ERROR | E_PARSE);


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

<?php
if(isset($_POST['search'])){
    $name_of_doctor = $_POST['name_of_doctor'];
    $specialization = $_POST['specialization'];

    $query = "SELECT * FROM users LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id 
    WHERE users.doctor_or_secretary = 'doctor' AND doctors_details.specialization = '$specialization' ";
    $run = mysqli_query($conn,$query);

    if(mysqli_num_rows($run) > 0){
        foreach($run as $row ){
            ?>

                <div class="col-md-4 mt-3 mb-2" >
                    <div class="card" style="width: 18rem;">
                    <img src="<?php echo "../users/doc_picture/" . $row ['doc_picture']?>" width="255px" height="200px" alt="...">
                        <div class="cardbody">
                        <h2 class="card-title"><?php echo $row ['specialization']?></h2>
                        <h3 class="card-text"><?php echo $row ['first_name']?> <?php echo $row ['last_name']?></h3> <br>
                            <center>
                                <a href="view-profile.php?account_id=<?php echo $row ['account_id']?>" class="btn btn-success" >View Profile</a>
                            </center>
                        </div>
                    </div>
                </div>

            <?php
        }
    }else{
        echo '<div class="text-danger">'. '<h3>'  . "No data" . '</h3>' .'</div>' . $conn->error;
    }

}

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>