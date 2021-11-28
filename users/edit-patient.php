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


    <?php

    
    if(isset($_GET['patient_id'])){
        $patient_id = $_GET['patient_id'];
        $query = "SELECT * FROM patients WHERE patient_id = '$patient_id'";
        $run = mysqli_query($conn,$query);

        if(mysqli_num_rows($run) > 0){
            foreach($run as $row){
                ?>
                    <div class="container">
                        <a href="home.php">Cancel</a>
                        <form class="row g-3 needs-validation" method="POST" action="edit-patient.php" novalidate>
                            <input type="hidden" name="patient_id" value="<?php echo $row ['patient_id']?>">
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">First name</label>
                                <input type="text" class="form-control" name="first_name" id="validationCustom01" value="<?php echo $row ['first_name']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="validationCustom01" value="<?php echo $row ['last_name']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" name="date_of_birth" id="validationCustom01" value="<?php echo $row ['date_of_birth']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Age</label>
                                <input type="text" class="form-control" name="age" id="validationCustom01" value="<?php echo $row ['age']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-md-4 p-2">
                            <label for="validationCustom01" class="form-label">Gender:</label>
                                <div class="row g-2 border bg-white">
                                    <div class="col-5">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" required>
                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female" required>
                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                        </div>
                                        <input type="text" value="<?php echo $row ['gender']?>">
                                    </div>
                                    <div class="invalid-feedback">
                                        Gender Required
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number" id="validationCustom01" value="<?php echo $row ['mobile_number']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">HMO</label>
                                <input type="text" class="form-control" name="hmo" id="validationCustom01" value="<?php echo $row ['hmo']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-12">
                            <input  class="btn btn-primary" name="update" type="submit" value="Update Info">
                        </div>
                        </form>
                    </div>
                <?php
            }
        }
    }


    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
(function () {
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>
</body>
</html>

<?php


if(isset($_POST['update'])){

    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile_number = $_POST['mobile_number'];
    $hmo = $_POST['hmo'];

    $query_update = "UPDATE patients SET first_name='$first_name', last_name='$last_name', date_of_birth='$date_of_birth',
    age = '$age', gender='$gender', mobile_number='$mobile_number', hmo='$hmo' WHERE patient_id='$patient_id'";
    $run_update = mysqli_query($conn,$query_update);

    if($run_update){
        echo "<script>window.location.href='home.php' </script>";
    }else{
        echo "error". $conn->error;
    }


}

?>