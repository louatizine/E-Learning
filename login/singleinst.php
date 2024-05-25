<?php
session_start();

// Include the database connection file
include('../connexion/conx.php');

// Check if the course ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $course_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch course details from the database based on the provided course ID
    $sql = "SELECT * FROM popular_courses WHERE id = $course_id";
    $result = mysqli_query($conn, $sql);

    // Check if a course is found with the provided ID
    if ($result && mysqli_num_rows($result) > 0) {
        $course = mysqli_fetch_assoc($result);
    } else {
        // Handle course not found
        echo "Course not found";
        exit;
    }
} else {
    // Handle course ID not provided
    echo "Course ID not provided";
    exit;
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $course['title']; ?></title>
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
    <!-- Header -->
    <?php include("../repite/InstroctorHeader.php"); ?>

    <!-- Course Detail Start -->
    <div class="container-xxl py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 wow fadeInUp">
                    <div class="container">
                        <div class="row g-5 justify-content-center">
                            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                                <h2><?php echo $course['title']; ?></h2>
                                <p><?php echo $course['description']; ?></p>
                                <div class="d-flex">
                                    <small><i class="fa fa-star text-warning"></i> 4.6</small>
                                    <small style="margin-left: 15px;"><i class="fa fa-user-graduate"></i> 5.8L+ Learners</small>
                                    <small style="margin-left: 15px;"><i class="fa fa-user"></i><?php echo $course['level']; ?></small>
                                    <small style="margin-left: 15px;"><i class="fa fa-clock me-2"></i> <?php echo $course['nb_heure']; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 shadow wow fadeInUp" data-wow-delay="0.3s">
                    <div class="image text-center">
                        <h4 class="mt-2 p-2"><?php echo $course['statut']; ?> <small></small></h4>
                        <div class="buttons">
                            <a href="#" class="text-decoration-none text-white btn p-3 w-100 mb-2">ENROLL NOW</a>
                        </div>
                        <div class="list mt-2">
                            <div class="list1 d-flex justify-content-between pt-2 border-bottom">
                                <p><i class="fa fa-clock"></i> Duration</p>
                                <p><?php echo $course['nb_heure']; ?></p>
                            </div>
                            <div class="list2 d-flex justify-content-between pt-2 border-bottom">
                                <p><i class="fa fa-book"></i> Lectures</p>
                                <p>4</p>
                            </div>
                            <div class="list3 d-flex justify-content-between pt-2 border-bottom">
                                <p><i class="fa fa-bolt"></i> Enrolled</p>
                                <p>240 students</p>
                            </div>
                            <div class="list5 d-flex justify-content-between pt-2 border-bottom">
                                <p><i class="fa fa-list"></i> Skill Level</p>
                                <p><?php echo $course['level']; ?></p>
                            </div>
                            <div class="list6 d-flex justify-content-between pt-2 border-bottom">
                                <p><i class="fa fa-list"></i> Deadline</p>
                                <p>Life Time</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Course Detail End -->

    <!-- Footer -->
    <?php include("../repite/footer.php"); ?>

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
