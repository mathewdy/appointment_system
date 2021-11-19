<?php

include('../connection.php');

session_start();
echo $code =  $_SESSION['code'];
echo $email = $_SESSION['email'];

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
    <form action="validate.php" method="POST">

    <h3>Please enter your new account id Here. To verify it's you </h3>
        <input type="text" name="account_id">
        <input type="submit" name="confirm" value="Confirm">
    </form>
    <a href="login.php">Cancel</a>
    
</body>
</html>

<?php

if(isset($_POST['confirm'])){

    $account_id = $_POST['account_id'];

    if($code != $account_id){
        echo "wrong account id";
    }else{
        $query = "UPDATE users SET account_id = '$account_id' WHERE email = '$email'";
        $run = mysqli_query($conn,$query);

        if($run){
            echo "<script>alert('Account Updated Successfully') </script>";
            echo "<script>window.location.href ='login.php' </script>";
            
        }else{
            echo "error";
        }
    }

}

?>