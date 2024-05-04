<?php 
session_start();
include_once "../connexion/conx.php";
if(!isset($_SESSION['id'])){
  header("location: login.php");
}
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM user_form WHERE id = {$_SESSION['id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
            }
          ?>
          <img src="php/images/<?php echo $row['pp']; ?>" alt="">
          <div class="details">
            <span><?php echo $row['uname']. " " . $row['uprenom'] ?></span>
            <p><?php echo $row['status']; ?></p>
          </div>
        </div>
        <a href="php/logout.php?logout_id=<?php echo $row['id']; ?>" class="logout">Logout</a>
      </header>
      <div class="search">
        <span class="text">Select a user to start chat</span>
        <input type="text" placeholder="Enter name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">
        <?php
          // Fetch all users except the current user
          $currentUserId = $_SESSION['id'];
          $query = "SELECT * FROM user_form WHERE id != $currentUserId";
          $result = mysqli_query($conn, $query);
          if(mysqli_num_rows($result) > 0){
            while($user = mysqli_fetch_assoc($result)){
              echo "<div class='user'>";
              echo "<img src='php/images/{$user['pp']}' alt=''>";
              echo "<div class='details'>";
              // Make the user name clickable
              echo "<span><a href='chat.php?id={$user['id']}'>{$user['uname']} {$user['uprenom']}</a></span>";
              echo "<p>{$user['status']}</p>";
              echo "</div>";
              echo "</div>";
            }
          } else {
            echo "<p>No users found.</p>";
          }
        ?>
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
