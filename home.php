<?php
$conn = new mysqli ("localhost" , "root" , "" , "appointment_system") ;

session_start();
echo $_SESSION['email'];

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
    <title>Document</title>
</head>
<body>
    <h2>Book Appointment</h2>
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
    
    <form action="logout.php" method="POST">
        <input type="submit" value="logout">
    </form>
</body>
</html>

<?php


if(isset($_POST['select'])){
    $specialization = $_POST['specialization'];
// unfinished 
    $select_doctors_Details = "SELECT users.first_name,users.last_name,users.mobile_number, users.id, doctors_details.user_id,
    doctors_details.specialization, doctors_details.internship, doctors_details.residency,
    doctors_details.hmo, doctors_details.doc_picture
    FROM users
    LEFT JOIN doctors_details ON users.id = doctors_details.user_id WHERE specialization = '$specialization'";
    $run_doctors_Details = mysqli_query($conn,$select_doctors_Details);

    if($run_doctors_Details){
        echo '<b>'.$specialization . " Section ".'</b>';
        
       if(mysqli_num_rows($run_doctors_Details) > 0)
        foreach($run_doctors_Details as $row){
                ?>
                <table>
                <thead>
                    <tr>
                        <th><b>Doctor</b></th>
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
                            <a href="doctors-profile.php?id=<?php echo $row ['id']?>">View Profile</a>
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