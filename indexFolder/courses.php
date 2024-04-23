<?php
//session_start(); // Start the session if not already started
//echo "Session User ID: " . $_SESSION['user_id']; // Debug statement

include('../connexion/conx.php');

$user_id = $_SESSION['user_id'];
// if(isset($_SESSION['user_id'])) {
//     $user_id = $_SESSION['user_id']; // Get the user ID from the session
// } else {
//     $user_id = 1; 
// }

$sql = "SELECT * FROM popular_courses";
$result = mysqli_query($conn, $sql);
$category = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

if(isset($_POST['enroll'])) {
    $course_id = $_POST['course_id'];
    $course_title = $_POST['course_title'];
    $course_level = $_POST['course_level'];
    $course_hours = $_POST['course_hours'];
    $course_price = $_POST['course_price'];
    
    $sql = "INSERT INTO enrolled_courses (course_id, title, level, nb_heure, price, user_id) 
            VALUES ('$course_id', '$course_title', '$course_level', '$course_hours', '$course_price', $user_id)";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courses</title>
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
            <h6 class="section-title bg-white text-center px-3">Popular Courses</h6>
            <h1 class="mb-5" style="color: #fb873f;">Explore new and trending free online courses</h1>
        </div>
        <div class="container">
            <div class="row g-4 py-2">
                <?php foreach ($category as $item): ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item shadow">
                            <div class="position-relative overflow-hidden text-light image">
                                <img class="img-fluid" src="img/course-1.jpg" alt="">
                                <?php if ($item['statut'] == 'free'): ?>
                                    <div style="position:absolute;top: 15px;left: 16px; font-size:12px; border-radius:3px; background-color:#fb873f;" class="px-2 py-1 fw-bold text-uppercase">FREE</div>
                                <?php endif; ?>
                            </div>
                            <div class="p-2 pb-0">
                                <h5 class="mb-1"><a href="single.html" class="text-dark"><?php echo ($item['title']) ?></a></h5>
                            </div>
                            <div class="d-flex">
                                <small class="flex-fill text-center py-1 px-2"><i class="fa fa-user me-2"></i><?php echo ($item['level']) ?></small>
                            </div>
                            <div class="d-flex">
                                <small class="flex-fill text-left p-2 px-2"><i class="fa fa-clock me-2"></i><?php echo ($item['nb_heure']) ?></small>
                                <small class="py-1 px-2 fw-bold fs-6 text-center"><?php echo ($item['price']) ?></small>
                                <form method="post" action="">
                                    <input type="hidden" name="course_id" value="<?php echo $item['id']; ?>">
                                    <input type="hidden" name="course_title" value="<?php echo $item['title']; ?>">
                                    <input type="hidden" name="course_level" value="<?php echo $item['level']; ?>">
                                    <input type="hidden" name="course_hours" value="<?php echo $item['nb_heure']; ?>">
                                    <input type="hidden" name="course_price" value="<?php echo $item['price']; ?>">
                                    <button type="submit" name="enroll" class="btn btn-primary">Enroll Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <a class="btn text-light py-3 px-5 mt-2 mb-5" href="courses.html">All Courses</a>
    </div>
    <!-- Courses End -->
</body>

</html>