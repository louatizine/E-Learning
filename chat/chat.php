<?php 
session_start();
require_once("../connexion/conx.php");

if(!isset($_SESSION['id'])){
  header("location: login.php");
  exit; // Add an exit after redirecting to prevent further execution
}

// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
  $user_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = mysqli_query($conn, "SELECT * FROM user_form WHERE id = '{$user_id}'");
  if(mysqli_num_rows($sql) > 0){
    $row = mysqli_fetch_assoc($sql);
  } else {
    // Redirect to users.php if user ID doesn't exist
    header("location: users.php");
    exit; // Add an exit after redirecting to prevent further execution
  }
} else {
  // Redirect to users.php if no user ID is provided
  header("location: users.php");
  exit;
}

include_once "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../login/img/<?php echo htmlspecialchars($row['pp']); ?>" alt="">
        <div class="details">
          <span><?php echo htmlspecialchars($row['uname']. " " . $row['uprenom']); ?></span>
          <p><?php echo htmlspecialchars($row['status']); ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo htmlspecialchars($user_id); ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>
</body>
</html>
