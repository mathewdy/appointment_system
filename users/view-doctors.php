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
    <link rel="stylesheet" href="../css/view-doctors.css">
</head>
<body>
    <br>
    <div class="back">
    <form action="home.php" method="POST">
        <input type="submit" name="home" value="Back">
    </form>
    </div>
    
<br>    
<h3><i>View Doctors</i></h3>

    
    <div class="container">
    <form action="#" method="POST">
        <label for="">Specialization</label>
        <select name="specialization" id="">
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
        <input type="submit" name="select" value="Select"> 
    </form>
    </div>
    
    

<?php


if(isset($_POST['select'])){
    $specialization = $_POST['specialization'];
// unfinished 
    $select_doctors_Details = "SELECT users.first_name,users.last_name,doctors_details.specialization,
    doctors_details.hmo,doctors_details.doc_picture,doctors_details.user_id
    FROM users
    LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id
    WHERE doctors_details.specialization = '$specialization'";
    $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);

    if($run_doctors_Details){
        echo '<b>'.'<center>'.$specialization . " Section ".'</center>' .'</b>';
        
        if(mysqli_num_rows($run_doctors_Details) > 0)
        foreach($run_doctors_Details as $row){
        ?>
        <ul class="card-container">   
            <li>
                <div class= "card">
                    <div class="image">
                    <img src="<?php echo "doc_picture/" .$row['doc_picture']; ?>" alt="Doc Image" width="200px" height="200px">
                    </div>    
                    <br>
                        <div class="card-body">
                            <h4 class="card-title"> <?php echo $row ['first_name'] . $row ['last_name']?> </h4>
                            <h5 class="card-title"> <?php echo $row ['specialization']?> </h5>
                            <p class="card-text">
                                <?php echo $row ['hmo']?>
                            </p>
                            <div class="profile">
                            <form action="whole-profile-doc.php?user_id=<?php echo $row ['user_id']?>" method="POST">
                                <input type="submit" name="home" value="View Profile">
                            </form>
                            </div>
                        </div>        
                </div>
            </li>
        </ul>
        <?php
        }else{
            
            echo  '<b style="color: white;">'. "No Found " . '</b>' .$conn->error;
        }
    }
}


?>
</body>
</html>
