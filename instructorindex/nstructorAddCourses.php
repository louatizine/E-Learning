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
    $target_directory = "../login/img";
    $target_file = $target_directory . basename($_FILES['picture']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an image
    $check = getimagesize($_FILES['picture']['tmp_name']);
    if ($check !== false) {
        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
        } else {
            // Check file size (max 5MB)
            if ($_FILES['picture']['size'] > 5 * 1024 * 1024) {
                echo "Sorry, your file is too large.";
            } else {
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                } else {
                    // Upload file
                    if (move_uploaded_file($_FILES['picture']['tmp_name'], $target_file)) {
                        // Insert data into popular_courses table
                        $insert_query = "INSERT INTO popular_courses (title, nb_heure, statut, level, price, picture, instructor_id, description) VALUES ('$title', '$nb_heure', '$statut', '$level', '$price', '$target_file', '$instructor_id', '$description')";
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
<style>
    /* Global Styles */
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f8f9fa;
}

.container {
  max-width: 600px;
  margin: 50px auto;
  background-color: #fff;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

.success-message {
  color: green;
  margin-bottom: 10px;
}

.error-message {
  color: red;
  margin-bottom: 10px;
}

/* Form Styles */
.form-group {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

input[type="text"],
input[type="number"],
input[type="date"],
select,
textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
}

select {
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url('data:image/svg+xml;utf8,<svg fill="%23777" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
  background-repeat: no-repeat;
  background-position: right 10px top 50%;
  background-size: 15px;
}

textarea {
  resize: vertical;
  height: 100px;
}

input[type="submit"] {
  background-color: #721c04;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 12px 20px;
  cursor: pointer;
  font-size: 16px;
  width: calc(100% - 22px); /* Adjust width to match description textarea */
}

input[type="submit"]:hover {
  background-color: #0056b3;
}

.file-input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-size: 16px;
  background-color: #fff;
  cursor: pointer;
  outline: none;
}

@media screen and (max-width: 768px) {
  .container {
    max-width: 90%;
    margin: 50px auto;
  }
}

</style></head>
<body>

<div class="container">
    <h2>Add New Course</h2>
    <?php if(isset($success_message)) { ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php } ?>
    <?php if(isset($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php } ?>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="nb_heure">Hours:</label>
            <input type="number" id="nb_heure" name="nb_heure" required>
        </div>
        <div class="form-group">
            <label for="statut">Status:</label>
            <select id="statut" name="statut" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select>
        </div>
        <div class="form-group">
            <label for="level">Level:</label>
            <select id="level" name="level" required>
                <option value="Beginner">Beginner</option>
                <option value="Intermediate">Intermediate</option>
                <option value="Advanced">Advanced</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="picture">Picture:</label>
            <input type="file" id="picture" name="picture" accept="image/*" required>
        </div>
        <!-- No need to show instructor_id input field, as it's fetched from session -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</div>

</body>
</html>
