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

    if(isset($_GET['account_id'])){
        $account_id = $_GET['account_id'];
        

        $query = "SELECT * FROM users
        LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id WHERE doctor_or_secretary = 'doctor' AND account_id='$account_id'";
        $run = mysqli_query($conn,$query);

        if(mysqli_num_rows($run) > 0){
            foreach($run as $row){
                ?>
                    <div class="container">
                    <a href="view-doctors.php" class="btn btn-dark">Cancel</a>

                        <form class="row g-3 needs-validation" enctype="multipart/form-data" action="edit-doctors-profile.php" method="POST" novalidate>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">First name</label>
                                <input type="text" class="form-control" name="first_name" id="validationCustom01" value="<?php echo $row ['first_name']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Last name</label>
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
                                <label for="validationCustom01" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number" id="validationCustom01" pattern="[+][6]{1}[3]{1}[0-9]{10}" value="<?php echo $row ['mobile_number']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                or 
                                Invalid Format
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationDefault04" class="form-label">Specialization</label>
                                <select class="form-select" name="specialization" id="validationDefault04" required>
                                <option selected disabled value="">Choose...</option>
                                <option value="Allergy and immunology">Allergy and immunology</option>
                                <option value="Anesthesiology">Anesthesiology</option>
                                <option value="Dermatology">Dermatology</option>
                                <option value="Diagnostic radiology">Diagnostic radiology</option>
                                <option value="Emergency medicine">Emergency medicine</option>
                                <option value="Family medicine">Family medicine</option>
                                <option value="Internal medicine">Internal medicine</option>
                                <option value="Medical genetics">Medical genetics</option>
                                <option value="Neurology">Neurology</option>
                                <option value="Nuclear medicine">Nuclear medicine</option>
                                <option value="Obstetrics and gynecology">Obstetrics and gynecology</option>
                                <option value="Ophthalmology">Ophthalmology</option>
                                <option value="Pathology">Pathology</option>
                                <option value="Pediatrics">Pediatrics</option>
                                <option value="Physical medicine and rehabilitation">Physical medicine and rehabilitation</option>
                                <option value="Preventive medicine">Preventive medicine</option>
                                <option value="Psychiatry">Psychiatry</option>
                                <option value="Radiation oncology">Radiation oncology</option>
                                <option value="Surgery">Surgery</option>
                                <option value="Urology">Urology</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Internship</label>
                                <input type="text" class="form-control" name="internship" id="validationCustom01" value="<?php echo $row ['internship']?>" required>
                                <div class="invalid-feedback">
                                Input Required
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Residency</label>
                                <input type="text" class="form-control" name="residency" id="validationCustom01" value="<?php echo $row ['residency']?>" required>
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
                            <div class="col-md-4">
                                <label for="validationCustom01" class="form-label">Upload Profile Picture</label>
                                <input type="file" name="doc_picture" class="form-control" aria-label="file example" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-12">
                                <input class="btn btn-primary" name="update" type="submit" value="Save Changes"></input>
                                <input type="hidden" name="account_id" value="<?php echo $row ['account_id']?>">
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
  'use strict'
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

    $account_id = $_POST['account_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $mobile_number = $_POST['mobile_number'];
    $specialization = $_POST['specialization'];
    $internship = $_POST['internship'];
    $residency = $_POST['residency'];
    $hmo = $_POST['hmo'];


     
    date_default_timezone_set("Asia/Manila");
    $time= date("h:i:s", time());
    //year month date
    $date = date('y-m-d');
    
    $doc_picture = $_FILES['doc_picture']['name'];
    $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
    $filename = $_FILES ['doc_picture']['name'];
    $file_extension = pathinfo($filename , PATHINFO_EXTENSION);

    if(!in_array($file_extension, $allowed_extension)){
        echo "image not added"  ;
        exit();
    }else{
        $query_update1 = "UPDATE users set first_name='$first_name' , last_name='$last_name', date_of_birth='$date_of_birth',
        mobile_number = '$mobile_number', date_time_updated='$date $time' WHERE account_id='$account_id'";
        $run_update1 = mysqli_query($conn,$query_update1);

        if($run_update1){
            echo "updated1";
            $query_update2 = "UPDATE doctors_details SET specialization='$specialization', 
            internship='$internship', residency='$residency' ,
            hmo='$hmo', doc_picture='$doc_picture' , date_time_updated='$date $time' WHERE user_id='$account_id'";
            $run_update2 = mysqli_query($conn,$query_update2);
            move_uploaded_file($_FILES["doc_picture"]["tmp_name"], "doc_picture/" . $_FILES["doc_picture"] ["name"]);


            if($run_update2){
                echo "<script>window.location.href='view-doctors.php' </script>";
            }else{
                echo "error" . $conn->error;
            }
        }else{
            echo "error";
        }

    }

}

?>
