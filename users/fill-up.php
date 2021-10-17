<?php

include('../connection.php');

session_start();
// eto yung mga data ni doctor
$id =$_SESSION['id'];
$email =$_SESSION['email'];
$account_id = $_SESSION['account_id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/fill-up.css">
</head>
<body>

<div class="logo">
        <img src="../css/logo.png" alt="Logo" >
    </div>

<h1><i>Please fill up this form</i></h1><br>
    <div class="container">
    <form action="#" method="POST" enctype="multipart/form-data">
    <h2>Doctor's Details</h2><br>
    <div class="user-details">
        <label for="">Specialization</label>
        <select name="specialization" id="">
            <option value="">Select</option>
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
        </select> <br>
        <label for="">PRC Image</label>
        <input type="file" name="prc_id" id=""> <br>
        <label for="">PRC Number</label>
        <input type="text" name="prc_number"> <br>

        <label for="">Internship</label>
        <input type="text" name="internship"> <br>
        <label for="">Residency</label>
        <input type="text" name="residency"> <br>
        <label for="">HMO</label>
        <input type="text" name="hmo"> <br>

        <label for="">Profile Picture</label>
        <input type="file" name="doc_picture"><br>

        
        <!-- sa terms and agreement 10am to 4pm lang sila for appointment nila sa hospital
        pero mag work sila by tuesday to saturday--->
        <input type="checkbox" name="terms_agreement" value="agree"> <a href="">Terms & Agreement</a> <br><br>
        <div class="submit"><br>
        <input type="submit" name="cancel" value="Cancel">
        </div>
        <div class="submit2"><br>
        <input type="submit" name="add" value="Add info ">
        </div>
        <input type="hidden" name="delete_id" value="<?php echo $id ?>">
    </div>
    </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['add'])){
    date_default_timezone_set("Asia/Manila");
    $date = date("y-m-d");
    $time = date("h:i:s" , time());
    $specialization = $_POST['specialization'];
    
    $prc_number = $_POST['prc_number'];
    $internship = $_POST['internship'];
    $residency = $_POST['residency'];

    $hmo = $_POST['hmo'];

    
    $terms_agreement = $_POST['terms_agreement'];

    
    $prc_id = $_FILES['prc_id']['name'];

    $allowed_extension = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
    $filename = $_FILES ['prc_id']['name'];
    $file_extension = pathinfo($filename , PATHINFO_EXTENSION);

    $doc_picture = $_FILES['doc_picture']['name'];

    $allowed_extension_1 = array('gif' , 'png' , 'jpeg', 'jpg' , 'PNG' , 'JPEG' , 'JPG' , 'GIF');
    $filename_doc = $_FILES ['doc_picture']['name'];
    $file_extension_1 = pathinfo($filename_doc, PATHINFO_EXTENSION);



    if(!in_array($file_extension_1, $allowed_extension_1)){
        echo "not added " . $conn->error  ;
        exit();
    }else if(!in_array($file_extension, $allowed_extension)){
        echo "not added " . $conn->error  ;
        exit();
    }else{

        $query_doctors_details = "INSERT INTO doctors_details (user_id,specialization,prc_id,prc_number,internship,residency,hmo,doc_picture,date_time_created,date_time_updated,remarks) 
        VALUES ('$id' , '$specialization' ,'$prc_id', '$prc_number' , '$internship' ,'$residency','$hmo','$doc_picture' ,'$date $time','$date $time' , NULL)";
        $run_doctors_details = mysqli_query($conn,$query_doctors_details);
        move_uploaded_file($_FILES['prc_id']['tmp_name'], "id_prc/". $_FILES['prc_id'] ['name']);
        move_uploaded_file($_FILES['doc_picture']['tmp_name'], "doc_picture/". $_FILES['doc_picture'] ['name']);
    
        if($run_doctors_details){
            echo "<script>alert('Added Details') </script>";
        }else{
            echo "ERROR: " . $conn->error;
        }
    }
   
}

if(isset($_POST['cancel'])){
    $delete_id = $_POST['delete_id'];

    $delete_doctors_details = "DELETE  FROM doctors_details WHERE user_id='$id'";
    $run_doctors_details = mysqli_query($conn,$delete_doctors_details);

    $delete_users = "DELETE FROM users WHERE id='$id'";
    $run_users = mysqli_query($conn,$delete_users);

    if($run_users && $run_doctors_details){
        echo "BOTH DELETED";
        header("Location: reg-users.php");
    }else{
        echo "not deleted" . $conn->error;
    }

}



?>