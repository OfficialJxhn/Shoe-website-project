<?php

declare(strict_types=1);
require_once 'config_session.inc.php';
require_once 'dbh.inc.php';


function retrieve_shoes_user(object $pdo)
{
    $query = "SELECT owned_shoes.id_of_shoe FROM owned_shoes INNER JOIN users ON :userID = users.id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("userID", $_SESSION["user_id"], PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchColumn();
    echo $result;
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $query = "SELECT shoeName, price, image_url, url_table FROM shoes WHERE :shoeID = shoeID;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam("shoeID", $row["shoeID"], PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt;
        print_shoes($data);
    }
}

function print_shoes($data)
{
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        echo $row;
    }
}
