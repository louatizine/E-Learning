<?php
session_start(); // Start the session

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit;
}

include('../connexion/conx.php');

if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $nb_heure = mysqli_real_escape_string($conn, $_POST['nb_heure']);
    $statut = mysqli_real_escape_string($conn, $_POST['statut']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $instructor_id = $_SESSION['user_id']; // Instructor ID from session

    // File upload handling
    $target_directory = "../login/img/";
    if (!file_exists($target_directory)) {
        mkdir($target_directory, 0777, true);
    }
    $target_filename = basename($_FILES['picture']['name']);
    $target_file = $target_directory . $target_filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES['picture']['tmp_name']);
    if ($check !== false) {
        // Handle duplicate file names
        if (file_exists($target_file)) {
            $unique_suffix = time() . '_' . uniqid();
            $target_filename = $unique_suffix . '.' . $imageFileType;
            $target_file = $target_directory . $target_filename;
        }

        // Check file size (max 5MB)
        if ($_FILES['picture']['size'] > 5 * 1024 * 1024) {
            $error_message = "Sorry, your file is too large.";
        } else {
            // Allow certain file formats
            $allowed_formats = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageFileType, $allowed_formats)) {
                $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            } else {
                // Upload file
                if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
                    // Insert data into popular_courses table, store only the filename
                    $insert_query = "INSERT INTO popular_courses (title, nb_heure, statut, level, price, picture, instructor_id, description) VALUES ('$title', '$nb_heure', '$statut', '$level', '$price', '$target_filename', '$instructor_id', '$description')";
                    if (mysqli_query($conn, $insert_query)) {
                        $success_message = "Course added successfully!";
                    } else {
                        $error_message = "Error inserting course data: " . mysqli_error($conn);
                    }
                } else {
                    $error_message = "Sorry, there was an error uploading your file.";
                }
            }
        }
    } else {
        $error_message = "File is not an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="../css/style3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .navbar-custom .navbar-brand p {
            color: black;
        }
        .navbar-custom .navbar-brand span {
            color: #721c04;
        }
        .navbar-custom .navbar-toggler-icon {
            color: #721c04;
        }
        .navbar-custom .navbar-toggler {
            border: 2px solid #721c04;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-custom navbar-expand-lg sticky-top">
  <div class="container-fluid">
    <a href="../login/profilUser.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
      <p class="m-0 fw-bold" style="font-size: 25px;">Iteam<span>learning</span></p>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<div class="container">
    <h2>Add New Course</h2>
    <?php if(isset($success_message)) { ?>
        <div class="alert alert-success"><?php echo $success_message; ?></div>
    <?php } ?>
    <?php if(isset($error_message)) { ?>
        <div class="alert alert-danger"><?php echo $error_message; ?></div>
    <?php } ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nb_heure">Hours:</label>
            <input type="number" id="nb_heure" name="nb_heure" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="statut">Status:</label>
            <select id="statut" name="statut" class="form-control" required>
                <option value="Active">Paid</option>
                <option value="Inactive">Free</option>
            </select>
        </div>
        <div class="form-group">
            <label for="level">Level:</label>
            <select id="level" name="level" class="form-control" required>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="picture">Picture:</label>
            <input type="file" id="picture" name="picture" class="form-control" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group mt-3">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
