<?php
include('../connexion/conx.php');

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['uname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $user_type = $_POST['user_type'];
    $birthday = $_POST['birthday']; 
    $gender = $_POST['gender']; 
    $select = "SELECT * FROM user_form WHERE email = '$email'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $error[] = 'Password not matched!';
        } else {
            $insert = "INSERT INTO user_form(uname, email, password, user_type, birthday, gender) VALUES('$name','$email','$pass','$user_type','$birthday','$gender')";
            if (mysqli_query($conn, $insert)) {
                header('location: login.php');
                exit;
            } else {
                $error[] = 'Error inserting user data!';
            }
        }
    }
}
?>
