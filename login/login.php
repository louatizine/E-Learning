<?php
require_once("../connexion/conx.php");
session_start();
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        var_dump($row[0]);
        $user_id = $row['id']; 
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['uname'];
             header('location:admin_dashboard.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['uname'];
            $_SESSION['user_id'] = $user_id;
            header('location:user_index.php');
        } elseif ($row['user_type'] == 'instructor') {
            $_SESSION['user_name'] = $row['uname'];
            $_SESSION['user_id'] = $user_id; 
            header('location:single.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title> Login</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">
<link href="img/icon.png" rel="icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="../lib/animate/animate.min.css" rel="stylesheet">
<link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<style>
    /* Form styles */
    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color:#FFFFFF;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    form h3 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
        text-align: center;
    }

    form input[type="email"],
    form input[type="password"],
    form input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
        transition: border-color 0.3s ease;
    }

    form input[type="email"]:focus,
    form input[type="password"]:focus {
        outline: none;
        border-color: #007bff;
    }

    form input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
    }

    form input[type="submit"]:hover {
        background-color: #0056b3;
    }

    form p {
        text-align: center;
    }

    form a {
        color: #007bff;
    }

    .error-msg {
        color: red;
    }
</style>
</head>
<body>
<?php include '../repite/header.php'; ?>
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5" >
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Login</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Login</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-2 mt-4">
    <div class="container">
        <div class="row g-4 wow fadeInUp" data-wow-delay="0.5s ">
            <center>
                <form action="" method="post" class="shadow p-4" style="max-width: 550px;">
                <h1 class="mb-5 bg-white text-center px-3">Login</h1>
                    <?php if (isset($error)) : ?>
                        <?php foreach ($error as $error_msg) : ?>
                            <span class="error-msg "><?php echo $error_msg; ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <input type="email" id="email" name="email" class="form-control"required placeholder="Enter your email">
                    <input type="password" id="password"  class="form-control"name="password" required placeholder="Enter your password">
                    <input type="submit" id="submit" name="submit" value="Login now" class="btn text-light w-100 py-3" style="background-color:#fb873f">
                    <p>Don't have an account? <a href="signup.php">Register now</a></p>
                </form>
            </center>
        </div>
    </div>
</div>
<?php include("../repite/footer.php"); ?>
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
