<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="../css/edit-profile.css">
</head>
<body>
    

    <div class="cancel">
    <a class="btn btn-primary" href="view-profile.php" role="button">Cancel</a>
    </div>

<?php

    //di pa to tapos
    include('../connection.php');
    session_start();

    if(isset($_GET['account_id'])){
        $account_id = $_GET['account_id'];

        $query = "SELECT * FROM users 
        LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id WHERE users.account_id = '$account_id'";
        $run = mysqli_query($conn,$query);

        if(mysqli_num_rows($run) > 0){
            foreach($run as $row ){
                ?>
            
                <div class="gen-container">
                <form class="row g-3 needs-validation" action="edit-profile.php?account_id=<?php echo $row ['account_id']?>" method="POST" enctype="multipart/form-data"  novalidate>
                
                <div class="container">
                <label for="">Profile Picture: </label>
                <img src="<?php echo "profile_picture/" .$row['doc_picture']; ?>" alt="Profile Picture" width="200px" height="200px"> <br>
                </div>


                <div class="col-md-4">
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" class="form-control w-75" name="doc_picture" id="inputGroupFile01" required>
                        <div class="invalid-feedback">
                            File Required
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">First name</label>
                    <input type="text" class="form-control" name="first_name" id="validationCustom01" value="<?php echo $row ['first_name']?>" required>
                    <div class="invalid-feedback">
                    Please Input First Name
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Last name</label>
                    <input type="text" class="form-control" name="last_name" id="validationCustom01" value="<?php echo $row['last_name']?>" required>
                    <div class="invalid-feedback">
                    Please Input Last Name
                    </div>
                </div>
                

                <div class="col-md-4">
                    <label for="validationCustom01"  class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="validationCustom01"  required>
                    <input type="text" class="form-control" id="validationCustom01" name="date_of_birth" value="<?php echo $row ['date_of_birth']?>" id="" readonly>
                </div>


                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_number" id="validationCustom01" value="<?php echo $row['mobile_number']?>" required>
                    <div class="error">
                       
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="validationDefault04" class="form-label">Specialization</label>
                    <select class="form-select" id="validationDefault04" name="specialization" required>
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
                        <div class="invalid-feedback">
                        Please Select Specialization
                        </div>
                        <input type="text" class="form-control" name="specialization" value="<?php echo $row ['specialization']?>" readonly> <br>
                </div>
                
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Internship</label>
                    <input type="text" class="form-control" id="validationCustom01" name="internship"  value="<?php echo $row['internship']?>" required>
                    <div class="invalid-feedback">
                    Please Input Internship
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Residency</label>
                    <input type="text" class="form-control" id="validationCustom01" name="residency"  value="<?php echo $row['residency']?>" required>
                    <div class="invalid-feedback">
                    Please Input Residency
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">HMO</label>
                    <input type="text" class="form-control" id="validationCustom01" name="hmo"  value="<?php echo $row['hmo']?>" required>
                    <div class="invalid-feedback">
                    Please Input HMO
                    </div>
                </div>
                
                <div class="col-12">
                    <input class="btn btn-primary" type="submit" value="Update" name="update">
                </div>

                <input type="hidden" name="account_id" value="<?php echo $row ['account_id']?>">
                </form>

                </div>    
                <?php
                
            }
        }
    }
?>
</body>
</html>

<?php

if(isset($_POST['update'])){



    $account_id = $_POST['account_id'];

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth =  $_POST['date_of_birth'];
    $mobile_number = $_POST['mobile_number'];
    $specialization = $_POST['specialization'];
    $internship = $_POST['internship'];
    $residency = $_POST['residency'];
    $hmo = $_POST['hmo'];

    $doc_picture = $_FILES['doc_picture']['name'];
    $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
    $filename = $_FILES ['doc_picture']['name'];
    $file_extension = pathinfo($filename , PATHINFO_EXTENSION);

    if(strlen($mobile_number) > 13 || strlen($mobile_number) < 13){
        
        echo "<h4>" . "Mobile Number is Invalid" . "</h4>";
        exit();
       
    }

    if(strpos($mobile_number,"+63") !== FALSE){
        
    }else{
    
        echo "<h4>" . "Mobile Number is Invalid2" . "</h4>";
        exit();
        
    }
    if(!in_array($file_extension, $allowed_extension)){
        echo "image not added"  ;
       exit();
    }



    $query_update = "UPDATE users SET first_name='$first_name' , last_name='$last_name',
    date_of_birth = '$date_of_birth', mobile_number='$mobile_number' WHERE account_id = '$account_id'";
    $run_update1  = mysqli_query($conn,$query_update);

    if($run_update1){
        echo "data updated1";
        
        $query_update2 = "UPDATE doctors_details SET specialization= '$specialization', internship='$internship',
        residency='$residency', hmo='$hmo' , doc_picture='$doc_picture' WHERE user_id='$account_id'";
        $run_update2 = mysqli_query($conn,$query_update2);

        if($run_update2){
            echo "<script>window.location.href='view-profile.php' </script>";
        }else{
            echo "error update 2". $conn->error;
        }
    }else{
        echo "error " . $conn->error;
    }


}
?>


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