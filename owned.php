<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'includes/loggedin_views.inc.php';
require_once 'includes/retrieve_shoe_of_user.inc.php';
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
  <?php
  retrieve_shoes_user($pdo);
  ?>
  <h1>hi</h1>
  <div class="grid-container">
    <div class="grid-item">1</div>
    <div class="grid-item">2</div>
    <div class="grid-item">3</div>
    <div class="grid-item">4</div>
    <div class="grid-item">5</div>
    <div class="grid-item">6</div>
    <div class="grid-item">7</div>
    <div class="grid-item">8</div>
    <div class="grid-item">9</div>
  </div>


  </div>

  </div>