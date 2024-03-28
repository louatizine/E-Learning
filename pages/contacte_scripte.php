<?php
require("connexion/conx.php");

// Getting the values from the signup page using $_POST[] and cleaning the data submitted by the user.
$name = $_POST['name'];
$name = mysqli_real_escape_string($con, $name);

$email = $_POST['email'];
$email = mysqli_real_escape_string($con, $email);

$subject = $_POST['subject'];
$subject = mysqli_real_escape_string($con, $subject);
$message = $_POST['message'];
$message = mysqli_real_escape_string($con, $message);

$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";

// Checking whether email id already used for registration
$query = "SELECT * FROM etudiants WHERE email='$email'";
$result = mysqli_query($con, $query)or die($mysqli_error($con));
$num = mysqli_num_rows($result);

if ($num != 0) {
    // Email already exists, insert contact information into the 'contacte' table
    $query = "INSERT INTO contacte(name, email, subject, message) VALUES('$name', '$email', '$subject', '$message')";
    mysqli_query($con, $query) or die(mysqli_error($con));

    // Redirect to contacte page
    header('location: contact.php');
} else if (!preg_match($regex_email, $email)) {
    // Invalid email format, redirect to signup page with a message
    $m = "<span class='red'>Not a valid Email Id</span>";
    header('location: signup.php?m1=' . $m);
} else {
    // Email doesn't exist, redirect to signup page with a message
    $m = "<span class='red'>Email does not exist</span>";
    header('location: signup.php?m1=' . $m);
}
?>
