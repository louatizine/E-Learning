<?php
$conn = mysqli_connect("localhost", "root", "", "education") or die(mysqli_error($con));
if (session_status() == PHP_SESSION_NONE) {
    //session_start();
}
?>
