<?php
session_start();

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

        // Fetch instructor/user information based on the instructor ID
        $instructor_id = $course['instructor_id'];
        $instructor_sql = "SELECT * FROM user_form WHERE id = $instructor_id";
        $instructor_result = mysqli_query($conn, $instructor_sql);

        if ($instructor_result && mysqli_num_rows($instructor_result) > 0) {
            $instructor = mysqli_fetch_assoc($instructor_result);
        }
    } else {
        echo "Course not found";
        exit;
    }
} else {
    echo "Course ID not provided";
    exit;
}

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="google-translate-customization" content="9f841e7780177523-3214ceb76f765f38-gc38c6fe6f9d06436-c">
    </meta>

    <title></title>
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
    <link href=".../css/style.css" rel="stylesheet">

</head>
<style>
    .tabs ul li {
        list-style-type: none;
    }

    .tabs ul li a {
        font-size: 25px;
        color: #4e4e4e !important;
        font-weight: 500;
    }

    .tabs ul li a.active {
        color: #f69050 !important;
    }

    .tabs ul li a:hover {
        color: #f69050 !important;
    }

    #more {
        display: none;
    }

    button {
        border: none;
        color: #f69050;
    }
</style>

<body>
    <?php include '../repite/InstroctorHeader.php'; ?>

    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Course</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-white" href="courses.php">Course</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page"><?php echo $course['title']; ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Course Detail Start -->
    <div class="container-xxl py-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 wow fadeInUp">

                    <div class="container">
                        <div class="row g-5 justify-content-center">

                            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.3s">
                                <h2><?php echo $course['title']; ?></h2>
                                <p>Start at the beginning by learning HTML basics — an important foundation for building and editing web pages.

                                </p>
                                <div class="d-flex">
                                    <small><i class="fa fa-star text-warning"></i>
                                        4.6</small>
                                    <small style="margin-left: 15px;"><i class="fa fa-user-graduate"></i> 5.8L+
                                        Learners
                                    </small>
                                    <small style="margin-left: 15px;"><i class="fa fa-user"></i><?php echo $course['statut']; ?></small>
                                    <small style="margin-left: 15px;"><i class="fa fa-clock me-2"></i> <?php echo $course['nb_heure']; ?></small>

                                </div>
                                <div class="image-div text-left mt-3">
                                <?php
                                            $image = $instructor["pp"];
                                            ?>
                                    <img src="img/<?php echo $image; ?>" title="<?php echo $image; ?>" alt="" style="height: 40px; width: 40px; border-radius: 50%;">
                                    <span style="margin-left: 10px;"><b>Instructor Name </b><?php echo $instructor['uname']; ?> <?php echo $instructor['uprenom']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="container-fluid wow fadeInUp mt-5 tabs">


                        <!-- Tab panes -->
                        <div class="tab-content mt-4">

                            <div class="tab-pane container active" id="Overview">
                                <h2>About this Course</h2>
                                <p><?php echo $course['description']; ?></p>



                                <h2 class="mt-4">
                                    Skills you'll gain
                                </h2>

                                <span class="badge rounded-pill text-white bg-primary px-4 py-2 m-2" style="font-size: 15px; font-weight: normal;">Structure pages with HTML</span>

                                <span class="badge rounded-pill text-white bg-primary px-4 py-2 m-2" style="font-size: 15px; font-weight: normal;">Present data with tables</span>

                                <span class="badge rounded-pill text-white bg-primary px-4 py-2 m-2" style="font-size: 15px; font-weight: normal;">Write cleaner HTML</span>


                            </div>


                            <div class="container" id="Instructor">
                                <h2 class="mt-4">About the Instructor</h2>
                                <div class="image-div text-left mt-4">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-6">
                                            <?php
                                            $image = $instructor["pp"];
                                            ?>
                                            <img src="img/<?php echo $image; ?>" title="<?php echo $image; ?>" alt="" style="height: 150px; width: 150px; border-radius: 50%;">
                                        </div>
                                        <div class="col-lg-9 col-md-6 mt-2">
                                            <h5><?php echo $instructor['uname']; ?></h5>
                                            <p>Developer</p>
                                        </div>
                                    </div>
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

    <!-- Course Detail End -->


    <!-- Footer Start -->
    <?php include("../repite/footer.php"); ?>
    <!-- Footer End -->

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