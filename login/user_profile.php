<?php
require_once("../connexion/conx.php");
session_start();

// Retrieve user data from the database
$sessionId= $_SESSION['user_id'] ; 
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM user_form WHERE id = $sessionId"));

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update profile picture
    if (isset($_FILES["image"]["name"])) {
        $id = $_POST["id"];
        $name = $_POST["first_name"];

        $imageName = $_FILES["image"]["name"];
        $imageSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        // Image validation
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $imageName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "
            <script>
                alert('Invalid Image Extension');
                window.location.href = 'user_profile.php';
            </script>
            ";
            exit;
        } elseif ($imageSize > 1200000) {
            echo "
            <script>
                alert('Image Size Is Too Large');
                window.location.href = 'user_profile.php';
            </script>
            ";
            exit;
        } else {
            $newImageName = $name . " - " . date("Y.m.d") . " - " . date("h.i.sa"); // Generate new image name
            $newImageName .= '.' . $imageExtension;
            $query = "UPDATE user_form SET pp = '$newImageName' WHERE id = $id"; // Update profile picture in the database
            mysqli_query($conn, $query);
            move_uploaded_file($tmpName, 'img/' . $newImageName);
        }
    }

    // Update other user information
    $id = $_POST["id"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $uname = $_POST["uname"];
    $uprenom = $_POST["uprenom"];
    $adresse = $_POST["adresse"];
    $level = $_POST["level"];

    $query = "UPDATE user_form SET uname = '$uname', email = '$email', phone = '$phone', uname = '$uname', uprenom = '$uprenom', adresse = '$adresse', level = '$level' WHERE id = $id";
    mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Secret Coder: Login</title>
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
  #container {
        max-width: 600px;
        max-height:800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #FFFFFF;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);}
        .upload {
            width: 125px;
            position: relative;
            margin: auto;
        }

        .upload img {
            border-radius: 50%;
            border: 4px solid #DCDCDC;
            width: 125px;
            height: 125px;
            object-fit: cover;
        }

        .upload .round {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #00B4FF;
            width: 32px;
            height: 32px;
            line-height: 33px;
            text-align: center;
            border-radius: 50%;
            overflow: hidden;
        }

        .upload .round input[type="file"] {
            position: absolute;
            transform: scale(2);
            opacity: 0;
        }
        .inputs {
            margin-top: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: inline-block;
            width: 150px;
            font-weight: bold;
        }
        .input-group input[type="text"],
        .input-group input[type="email"] {
            width: calc(100% - 160px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            
            border-radius: 4px;
            
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    
</style>
</head>
<body>
<?php include '../repite/user_header.php'; ?>
<div id="container">
<h2>Update Profile</h2>

        <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
            <div class="upload">
                <?php
                $id = $user["id"];
                $name = $user["uname"];
                $image = $user["pp"];
                ?>
                <img src="img/<?php echo $image; ?>" title="<?php echo $image; ?>">
                <div class="round">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="first_name" value="<?php echo $name; ?>">
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                    <i class="fa fa-camera" style="color: #fff;"></i>
                </div>
            </div>
            <div class="inputs">
                <div class="input-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="uname" value="<?php echo $user['uname']; ?>" required>
                </div>
                <div class="input-group">
                    <label for="email">Email Address:</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="input-group">
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>" required>
                </div>
                <div class="input-group">
                    <label for="uprenom">User Prenom:</label>
                    <input type="text" id="uprenom" name="uprenom" value="<?php echo $user['uprenom']; ?>">
                </div>
                <div class="input-group">
                    <label for="adresse">Address:</label>
                    <input type="text" id="adresse" name="adresse" value="<?php echo $user['adresse']; ?>">
                </div>
                <div class="input-group">
                    <label for="level">Level:</label>
                    <input type="text" id="level" name="level" value="<?php echo $user['level']; ?>">
                </div>
            </div>
            <button type="submit" class="btn text-light w-100 py-3" style="background-color:#fb873f">Update</button>
            
        </form>
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
