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
  <h3>
    <?php
    output_username();
    ?>
  </h3>
  <div class="brands">
    <h1>brands</h1>
    <div class="image-container">
      <div class="jordans">
        <a href="jordan.php?action=jordan-action">
          <img class="jordan-pic" src="https://www.nicekicks.com/files/2020/06/air-jordan-jumpman-logo.jpg" alt="picture of nike shoes">
        </a>
      </div>
      <div class="nike">
        <a href="nike.php?action=nike-action">
          <img class="nike-pic" src="https://substackcdn.com/image/fetch/f_auto,q_auto:good,fl_progressive:steep/https%3A%2F%2Fsubstack-post-media.s3.amazonaws.com%2Fpublic%2Fimages%2F5362a828-0f5b-4d17-a6c5-d0677dc89baa_1000x1000.jpeg">
        </a>
      </div>
      <div class="yeezy">
        <a href="yeezy.php?action=yeezy-action">
          <img class="yeezy-pic" src="https://i.pinimg.com/originals/8f/3c/a5/8f3ca5950ab24ecd136cb27cdebb21a1.png">
        </a>
      </div>
    </div>
  </div>

  </div>
</body>

</html>