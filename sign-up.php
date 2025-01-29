<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/loggedin_views.inc.php'
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
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="images.css" />
  <link rel="stylesheet" href="sign up.css" />
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
  <br>

  <h3 style="text-align: center" ;>Sign up</h3>
  <div class="form-container-signup">
    <form class="signup-form" action="includes/signup.inc.php" method="post">
      <?php
      signup_inputs()
      ?>
      <button class="signup-button">Signup</button>
      <h4 class="log-in-have-acc">Have an account?</h4>
      <a class="log-in-have-acc" href="login.php">sign in here</a>
    </form>
  </div>

  <?php
  check_signup_errors();
  ?>
</body>

</html>