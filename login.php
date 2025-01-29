<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/loggedin_views.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gabarito&family=Lora:wght@500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="images.css" />
  <link rel="stylesheet" href="login_gui.css" />
</head>

<body>
  <header>
    <a href="index.php">
      <img class="logo" src="./assets/Drops logo.png" alt="logo" />
    </a>
    <nav class="nav-bar">
      <ul class="nav-links">
        <?php
        header_for_navbar();
        ?>
      </ul>
    </nav>
  </header>

  <?php
  output_username();
  ?>
  <h3 style="text-align: center" ;>login</h3>

  <div class="form-container">
    <form class="login-form" action="includes/login.inc.php" method="post">
      <input class="username-form" type="text" name="username" placeholder="Username"> <br>
      <input class="password-form" type="password" name="pwd" placeholder="Password"> <br> <br>
      <button class="login-button">Login</button>
      <h4 class="sign-up-no-acc">Dont have an account?</h4>
      <a class="sign-up-no-acc" href="sign-up.php">sign up here</a>

      <?php
      check_login_errors();
      ?>
    </form>
  </div>
</body>

</html>