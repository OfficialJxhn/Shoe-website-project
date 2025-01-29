<?php

declare(strict_types=1);

function signup_inputs()
{
    if (isset($_SESSION["signup_data"]["username"]) && !isset($_SESSION["errors_signup"]["username_taken"])) {
        echo '<input class ="username-form-signup" type="text" name="username" placeholder="Username" value="' . $_SESSION["signup_data"]["username"] . '">';
    } else {
        echo '<input class ="username-form-signup" type="text" name="username" placeholder="Username">';
    }

    echo '<input class ="password-form-signup" type="password" name="pwd" placeholder="Password">';
    echo '<input class ="password-form-signup" type="password" name="confirm-pwd" placeholder="Confirm password">';

    if (isset($_SESSION["signup_data"]["email"]) && !isset($_SESSION["errors_signup"]["email_used"]) && !isset($_SESSION["errors_signup"]["invalied_email"])) {
        echo '<input class ="email-form-signup" type="text" name="email" placeholder="E-Mail" value="' . $_SESSION["signup_data"]["email"] .  '">';
    } else {
        echo '<input class ="email-form-signup" type="text" name="email" placeholder="E-Mail">';
    }
}

function check_signup_errors()
{
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];

        echo "<br>";

        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }

        unset($_SESSION['errors_signup']);
    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "<br>";
        echo "<P>Signup success!</p>";
    }
}
