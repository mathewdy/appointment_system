<?php

session_start();
$_SESSION['email'];
unset($_SESSION['email']);

echo "<script>alert('logout') </script>";
echo "<script>window.location.href='login.php' </script>";

?>