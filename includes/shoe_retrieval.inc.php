<?php
declare(strict_types=1);
require_once 'dbh.inc.php';

function retrieve_shoes(object $pdo) {
    $query = "SELECT shoeName, price, image_url FROM shoes;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Shoe Name: " . $row['shoeName'] . "<br>";
        echo "Price: " . $row['price'] . "<br>";
        echo "Image URL: " . $row['image_url'] . "<br>";
        echo "<br>";
    }
}

retrieve_shoes($pdo);