<?php
include('../connexion/conx.php');

// SQL query to fetch categories
$sql = "SELECT * FROM category";

// Execute the query
$result = mysqli_query($conn, $sql);

// Fetch all categories
$category = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result set
mysqli_free_result($result);

// Close the connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
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
    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center px-3">Categories</h6>
                <h1 class="mb-5" style="color: #fb873f;">Popular Topics to Explore</h1>
            </div>
            <div class="row g-2 m-2">
                <?php foreach ($category as $item): ?>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="content shadow p-3 mb-2 wow fadeInUp" data-wow-delay="0.3s">
                        <?php
                        $image = $item['picture']; // Corrected accessing the 'picture' key
                        ?>
                        <!-- Image source modified to fetch image dynamically -->
                        <img src="../login/img/<?php echo $image; ?>" class="img-fluid" alt="">
                        <h5 class="my-2">
                            <a href="#" class="text-center"><?php echo $item['title']; ?></a>
                        </h5>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>

</html>
