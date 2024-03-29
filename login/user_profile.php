<?php
require_once("../connexion/conx.php");
//session_start();

// Retrieve user data from the database
$_SESSION["id"] = 1; // User's session
$sessionId = $_SESSION["id"];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

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
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: right;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include("../repite/user_header.php"); ?>

    <div class="container">
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
                    <input type="text" id="first_name" name="first_name" value="<?php echo $user['uname']; ?>" required>
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
            <div style="clear: both;"></div>
            <button type="submit">Update</button>
        </form>
    </div>
    <?php include("../repite/footer.php"); ?>

</body>
</html>
