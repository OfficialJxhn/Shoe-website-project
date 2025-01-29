<?php

declare(strict_types=1);
#files necessary for the function to work, one to connect to the databse the other to gain the user session
require_once 'dbh.inc.php';
require_once 'config_session.inc.php';

#this function will retrieve the email of the user that is currently logged in
function get_email(object $pdo)
{
    #SQL query to obtain the email
    $query = "SELECT email FROM users WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    #this will bind the :id in the query to the current session id of the user
    $stmt->bindParam(":id", $_SESSION["user_id"], PDO::PARAM_INT);
    $stmt->execute();

    #this will return to contents of the column that was fetch, that being the email
    $result = $stmt->fetchColumn();
    return $result;
}
