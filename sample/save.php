<?php

/*
$conn = new mysqli ("localhost" , "root" , ""  , "que");

if(isset($_POST['Id'])){
    $sql = "INSERT INTO info(username,full_name)
    VALUES ('".$_POST["postUsername"]."' , '".$_POST["postFullName"]."')";
    $run = mysqli_query($conn,$sql);

    if($run){
        echo "added to db";
    }else{
        echo "ERROR " .$conn->error;
    }
}
*/

$date = date('m/d/y');
echo $date;
?>