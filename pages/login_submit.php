<?php

require_once("connexion/conx.php");

// Récupération des données du formulaire de connexion
$email = mysqli_real_escape_string($con, $_POST['email']);
$password = md5(mysqli_real_escape_string($con, $_POST['password']));

// Requête pour vérifier si l'email et le mot de passe correspondent dans la table Student
$query_student = "SELECT id, email FROM student WHERE email='$email' AND password='$password'";
$result_student = mysqli_query($con, $query_student);

// Requête pour vérifier si l'email et le mot de passe correspondent dans la table Instructor
$query_instructor = "SELECT id, email FROM instructor WHERE email='$email' AND password='$password'";
$result_instructor = mysqli_query($con, $query_instructor);

if (mysqli_num_rows($result_student) == 0 && mysqli_num_rows($result_instructor) == 0) {
    // Si l'email et le mot de passe ne correspondent pas dans les deux tables, redirection vers la page de connexion avec un message d'erreur
    header('location: login.php?error=Please enter correct Email and Password');
    exit;
} else {
    // Si l'email et le mot de passe correspondent dans l'une des tables, démarrage de la session et redirection vers une autre page
    session_start();
    if(mysqli_num_rows($result_student) > 0) {
        $row = mysqli_fetch_array($result_student);
    } else {
        $row = mysqli_fetch_array($result_instructor);
    }
    $_SESSION['email'] = $row['email'];
    $_SESSION['user_id'] = $row['id'];
    // Redirection vers une page appropriée en fonction du rôle (student ou instructor)
    if(mysqli_num_rows($result_student) > 0) {
        header('location: student_dashboard.php');
    } else {
        header('location: instructor_dashboard.php');
    }
    exit;
}

?>
