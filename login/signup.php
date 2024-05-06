


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Signup</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/icon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #FFFFFF;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    #container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #FFFFFF;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    #form-group {
        margin-bottom: 20px;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="password"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding-right: 30px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23000000'%3E%3Cpath d='M7 10l5 5 5-5z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 15px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    @media (max-width: 768px) {
        #container {
            margin: 20px auto;
            padding: 10px;
        }
    }
</style>

</head>

<body>
    <?php include '../repite/header.php'; ?>

    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Signup</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="index.html">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Signup</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>



    <div id="container">
    <h1 class="mb-5 bg-white text-center px-3">Signup</h1>
   
    <form action="signup_submit.php" method="post" class="row g-4 wow fadeInUp" data-wow-delay="0.5s">
    <!-- Existing form fields -->
    <div id="form-group">
        <label for="name" style="color:black">Name:</label>
        <input type="text" class="form-control" id="name" name="uname" placeholder="Enter your name" required>
    </div>
    <div id="form-group">
        <label for="email" style="color:black">Email:</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div id="form-group">
        <label for="password" style="color:black">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div id="form-group">
        <label for="cpassword" style="color:black">Confirm Password:</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm your password" required>
    </div>
    <div id="form-group">
        <label for="user_type" style="color:black">User Type:</label>
        <select id="user_type" name="user_type" required>
            <option value="user">Student</option>
            <option value="instructor">Instructor</option>
        </select>
    </div>
    <!-- New fields for birthday and gender -->
    <div id="form-group">
        <label for="birthday" style="color:black">Birthday:</label>
        <input type="date" class="form-control" id="birthday" name="birthday" required>
    </div>
    <div id="form-group">
        <label for="gender" style="color:black">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    <center>
        <input type="submit" name="submit" value="Register now" class="btn text-light w-100 py-3" style="background-color:#721c04;">
        <p>Already have an account? <a href="login.php">Login now</a></p>
    </center>
</form>

  
</div>
    <!-- Signup End -->
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