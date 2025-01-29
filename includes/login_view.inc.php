<?php

declare(strict_types=1);
#this function is to output the username of the user that is currently logged in
function output_username()
{
    if (isset($_SESSION["user_id"])) {
        echo "You are logged in as " . $_SESSION["user_username"];
    } else {
        echo "You are not logged in";
    }
}
#this function is to check for any errors that occur while trying to log in
function check_login_errors()
{
    #if there is a login error present then it would output the error
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";
        #loops through the list to output all of the errors present while trying to log in
        foreach ($errors as $error) {
            echo "<p class='sign-up-no-acc'>" . $error . "</p>";
        }

        unset($_SESSION["errors_login"]);
        #if the login was successful 
    } else if (isset($_GET["login"]) && $_GET["login"] === "success") {
        echo "<br>";
        echo "<p class='sign-up-no-acc'>login success!</p>";
    }
}
