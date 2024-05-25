<?php 
  session_start();
  if(isset($_SESSION['id'])){
    header("location: users.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat and Payment</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      text-decoration: none;
      font-family: 'Poppins', sans-serif;
    }
    body{
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #f7f7f7;
    }
    .wrapper{
      max-width: 500px;
      margin: 50px auto;
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    form {
      display: flex;
      flex-direction: column;
    }
    form header {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      text-align: center;
    }
    .field {
      margin-bottom: 20px;
    }
    .field label {
      font-size: 16px;
      font-weight: bold;
      margin-bottom: 5px;
    }
    .field input[type="text"],
    .field input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
    }
    .field input[type="text"]:focus,
    .field input[type="password"]:focus {
      border-color: #721c04;
    }
    .field button input[type="submit"] {
      width: calc(100% - 20px); /* Adjusted width to match container */
      margin: 0 auto; /* Centered button */
      padding: 12px;
      font-size: 17px;
      background-color: #721c04;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      box-sizing: border-box; /* Added box-sizing */
    }
    .field button input[type="submit"]:hover {
      background-color: #6a1a03;
    }
    .link {
      text-align: center;
      margin-top: 20px;
      font-size: 16px;
    }
    .link a {
      color: #721c04;
      text-decoration: none;
    }
    .link a:hover {
      text-decoration: underline;
    }
    /* Payment section styling */
    .title {
      font-size: 20px;
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 10px;
    }
    .inputBox {
      margin-bottom: 15px;
    }
    .inputBox span {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }
    .inputBox input[type="text"],
    .inputBox input[type="number"] {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
    }
    
    /* Navbar styling */
    nav.navbar {
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 15px 0;
    }
    .navbar-brand p {
      color: #333;
      font-size: 25px;
      font-weight: bold;
    }
    .navbar-brand span {
      color: #721c04;
    }
    .navbar-toggler {
      border: none;
    }
    .navbar-toggler:hover {
      opacity: 0.8;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
  <div class="container-fluid">
    <a href="../login/user_index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
      <p class="m-0 fw-bold">Iteam<span>learning</span></p>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<div class="wrapper">
  <section class="form login">
    <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
      <div class="error-text"></div>
      <div class="field input">
        <label>Email Address</label>
        <input type="text" name="email" placeholder="Enter your email" required>
      </div>
      <div class="field input">
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
        <i class="fas fa-eye"></i>
      </div>

      <!-- Payment Section -->
      <div class="title">Payment</div>
      <div class="inputBox">
        <span>Cards Accepted:</span>
        <img src="card_img.png" alt="Cards Accepted">
      </div>
      <div class="inputBox">
        <span>Name on Card:</span>
        <input type="text" placeholder="Name on Card">
      </div>
      <div class="inputBox">
        <span>Credit Card Number:</span>
        <input type="number" placeholder="1111-2222-3333-4444">
      </div>
      <div class="inputBox">
        <span>Exp Month:</span>
        <input type="text" placeholder="January">
      </div>
      <div class="field button">
        <input type="submit" name="submit" value="Continue to Chat">
      </div>
    </form>
  </section>
</div>
<script src="javascript/pass-show-hide.js"></script>
<script src="javascript/login.js"></script>
</body>
</html>

