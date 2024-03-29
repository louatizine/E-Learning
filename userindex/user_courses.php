<?php
// Start the session before any output
session_start();

// Include the database connection file
include('../connexion/conx.php');

// Fetch enrolled courses for the current user
$user_id = $_SESSION['user_id']; // Assuming you have a 'user_id' stored in the session
$sql = "SELECT * FROM enrolled_courses WHERE user_id = $user_id"; // Assuming you have a 'user_id' column in the 'enrolled_courses' table
$result = mysqli_query($conn, $sql);
$enrolled_courses = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrolled Courses</title>
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
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl py-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5" style="color: #fb873f;">Enrolled Courses</h1>
        </div>
        <div class="container">
            <div class="row g-3 py-3">
                <?php foreach ($enrolled_courses as $course): ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item shadow">
                            <div class="p-2 pb-0">
                                <h5 class="mb-1"><?php echo $course['title']; ?></h5>
                                <p>Level: <?php echo $course['level']; ?></p>
                                <p>Duration: <?php echo $course['nb_heure']; ?></p>
                                <p>Price: <?php echo $course['price']; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>
