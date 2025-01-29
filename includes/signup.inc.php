<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $confirm_pwd = $_POST["confirm-pwd"];
    $email = $_POST["email"];


    try {
        require_once './prototype - Copy/website/includes/dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "invalid email used!";
        }

        if (do_passwords_not_match($pwd, $confirm_pwd)) {
            $errors["passwords_wrong"] = "passwords don't match up!";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already taken!";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "email already registered!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupdata = [
                "username" => $username,
                "email" => $email,
            ];
            $_SESSION["signup_data"] = $signupdata;

            header("Location: ../sign-up.php");
            die();
        }

        create_user($pdo,  $pwd, $username, $email);

        header("Location: ../sign-up.php?signup=success");

        $pdo = null;
        $stmt = null;

        die();
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
