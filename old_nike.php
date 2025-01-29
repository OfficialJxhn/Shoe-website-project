<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lora:wght@500&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href = "images.css"/>
  </head>
  <body>
    <header>
      <a href="index.php">
      <img class="logo" src="./assets/Drops logo.png" alt="logo" />
    </a>
      <nav class="nav-bar">
        <ul class="nav-links">
          <li><a class="sign-up-link" href="./sign-up.php">sign up</a></li>
          <li><a class = "login-in-link" href="./login.php">login</a></li>
          <?php
          if (isset($_SESSION["user_id"])) {
            echo '<li><a class = "brands-link" href="./logout.php">logout</a></li>';
            echo '<li><a class = "owned-link" href="./owned.php">owned</a></li>';
          } else{
            output_username();
          }
          ?>
        </ul>
      </nav>
      <a class="cta" href="./login.php"><button>login</button></a>
      <br>
    </header>
    <?php
    output_username();
    echo "<br>";
    ?>
    <?php
      $python = '"C:\xampp\htdocs\prototype - Copy\1. prototype\retrieve_data_nike.py"';
      $output = shell_exec("python $python");
      $output_lines = explode("\n", trim($output));
      $check_image = "https";
      foreach ($output_lines as $line) {
        if (strpos($line,$check_image) !== false) {
          echo "<br>";
          echo "<img class ='product-image' src='$line' alt = 'picture of shoes' />";
        } else {
          echo "<br>";
          echo "<a class='shoe-links' href='./mail.php'>$line</a><br>";  
          echo "<br>";
          echo "<form  method='post'action='send.php'>";
          echo "<input type='submit' name='submit' value='Be notified'>";
        }
      }
    ?>
    <br>
  </body>
  <script src="notifications.js" defer></script>
</html>