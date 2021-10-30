<?php
include('connection.php');
session_start();



if(empty($_SESSION['email'])){
    echo "<script> window.location.href='login-patient.php'</script>";
}


?>


<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <title>Document</title>
</head>
<body>
  
    <!--kulang ako ng side bar-->
    <h2>Book Appointment</h2>
    <div class="navbar_home">
        <ul>
            <li>
                <a href="#">Home</a>
            </li>
        </ul>
    </div>
    <div class="navbar_doctors">
        <ul>
            <li>
                <a href="">Doctors</a>
            </li>
        </ul>
    </div>
    <div class="logout">
        <form action="logout.php" method="POST">
            <input type="submit" value="Log Out">
        </form>
    </div>
   
    <div class="appointments">
        <a href="appointments.php">Your Appointments</a>
    </div>

    <div class="container">

    <form action="#" method="POST">
        <div class="specialization">
            <label for="">Specialization: </label>
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
        </div>
    </form>
    


<?php


if(isset($_POST['select'])){
    $specialization = $_POST['specialization'];
// unfinished 
    $select_doctors_Details = "SELECT users.first_name,users.last_name,users.mobile_number, doctors_details.hmo,
    doctors_details.user_id,doctors_details.specialization,doctors_details.doc_picture,doctors_details.internship,
    doctors_details.residency,doctors_details.hmo
    FROM users
    LEFT JOIN doctors_details ON users.account_id = doctors_details.user_id
    WHERE doctors_details.specialization = '$specialization'";
    $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);

    if($run_doctors_Details){
        ?>

            <div class="specialization1">
                <?php echo $specialization ?>
            </div>

        <?php
        
        if(mysqli_num_rows($run_doctors_Details) > 0)
        foreach($run_doctors_Details as $row){
                ?>
                
                    <table class="table">
                    <thead>
                        <tr>
                            <th><b>Doctors</b></th>
                            <th><b>Specialization</b></th>
                            <th><b>HMO</b></th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        
                            <td><?php echo $row ['first_name'] . $row ['last_name']?></td>
                            <td><?php echo $row ['specialization']?></td>
                            <td><?php echo $row ['hmo']?></td>
                            <td><img src="<?php echo "users/doc_picture/" .$row['doc_picture']; ?>" alt="Doc Image" width="100px"></td>
                            <td>
                                <a href="doctors-profile.php?account_id=<?php echo $row ['user_id']?>">View Profile</a>
                            </td>
                        </tr>
                    </tbody>
                    </table>

                <?php
        }else{
            echo "No Found " .$conn->error;
        }
    }
}


?>
</div>

</body>
</html>