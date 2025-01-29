<?php
#this if statement is to check if the user tried to log into the website hence they would send a post request to the web server
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    #these are the username and password from the log in form
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    #try and catch statement used here incase there was an error with the database
    try {
        #all the necessary files for the program to work, dbh to connect to the database, model to send queries to the database
        #and contr used to store the functions needed in another file
        #i did this so it would simplifiy the code making it more manageable incase i nedd to expand on any aspect of the progrma 
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';
        #if any errors appear they will be stored in this array
        $errors = [];

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Fill in all fields!";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        #this is so i can access the session cookie of the user currently using the website, logged in or not
        require_once 'config_session.inc.php';
        #if statement which will send the user back to the login page again if they encounter an error
        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php");
            die();
        }
        #
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        /*the use of htmlspecialchars here is to a security measure just incase
        the user decides to creates account with a user of some javascript code
        instead of having the name <script>.....</script> for example instead the function
        would convert all of the specials characters in their name to their word equivalant instead*/
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);

        $_SESSION["last_regeneration"] = time();
        #this is to reload the login page once the user has successfully logged in 
        header("Location: ../login.php?login=success");
        $pdo = null;
        $stmt = null;

        die();
        #catch any errors from the database
    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    #if the user just entered the url 
    header("Location: ../login.php");
    die();
}
