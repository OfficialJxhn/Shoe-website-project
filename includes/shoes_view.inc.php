<?php
require_once 'send.php';
function retrieve_shoes(object $pdo)
{
    $shoes_array = ["jordan", "nike", "yeezy"];
    $query = "SELECT shoeID, shoeName, price, image_url, url_table FROM shoes WHERE brand = :shoe;";
    $stmt = $pdo->prepare($query);
    if ($_GET["action"] === "jordan-action") {
        $shoe = $shoes_array[0];
        $stmt->bindParam(":shoe", $shoe);
    } elseif ($_GET["action"] === "nike-action") {
        $shoe = $shoes_array[1];
        $stmt->bindParam(":shoe", $shoe);
    } elseif ($_GET["action"] === "yeezy-action") {
        $shoe = $shoes_array[2];
        $stmt->bindParam(":shoe", $shoe);
    }
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<br>";
        echo "<img class='product-image' src='" . $row['image_url'] . "' alt='picture of shoes' />";
        echo "<br>";
        echo "Shoe Name: " . $row['shoeName'] . "<br>";
        echo "Price: $" . $row['price'] . "<br>";
        echo "<br>";
        echo "<br>";
        stock_of_shoes($pdo, $row["shoeID"], $row["url_table"], $shoe);
        echo "<br>";
    }
}

function stock_of_shoes($pdo, $shoeID, $url, $shoe)
{
    $query = "SELECT instock, stockID FROM stock_table WHERE id_for_shoes = :shoeID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":shoeID", $shoeID);
    $stmt->execute();

    // Initialize the list of shoeIDs for which emails have been sent
    if (!isset($_SESSION['sent_emails'])) {
        $_SESSION['sent_emails'] = [];
    } elseif (!isset($_SESSION['owned_shoes'])) {
        $_SESSION['owned_shoes'] = [];
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row["instock"] === 0) {
            echo "currently out of stock";
            echo "<form method='post'>";
            echo "<input class='notified-button' type='submit' name='$shoe-submit-$shoeID' value='Be notified'>";
            echo "</form>";

            if (isset($_SESSION["user_id"]) && isset($_POST["$shoe-submit-$shoeID"])) {
                // Check if an email has already been sent for this shoe
                if (!in_array($shoeID, $_SESSION['sent_emails'])) {
                    send_email($pdo, $shoeID, $_SESSION["user_id"], $row["stockID"]);
                    // Add the shoeID to the list of sent emails
                    array_push($_SESSION["sent_emails"], $shoeID);
                }
            }
        } elseif ($row["instock"] === 1) {
            if (str_contains($url, "https")) {
                echo "<a href='$url'><button class='login-button'>Buy now!</button></a>";
            } else {
                echo "<a href='https://$url'><button class='login-button'>Buy now!</button></a>";
            }
        }
        echo "<form method='post'>";
        echo "<br>";
        echo "<h4>Already own these shoes?</h4>";
        echo "<h4>Add them to your collection</h4>";
        echo "<input class='owned-already-button' type='submit' name='$shoe-owned-$shoeID' value='Add to collection'>";
        echo "</form>";

        if (isset($_SESSION["user_id"]) && isset($_POST["$shoe-owned-$shoeID"])) {
            if (!in_array($shoeID, $_SESSION["owned_shoes"])) {
                insert_into_own_table($pdo, $_SESSION["user_id"], $shoeID);
                array_push($_SESSION["owned_shoes"], $shoeID);
            }
        }
    }
}

function insert_into_own_table($pdo, $userID, $shoeID)
{
    $query = "INSERT INTO owned_shoes (users_id,id_of_shoe) VALUES (:users_id,:id_for_shoe);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("users_id", $userID);
    $stmt->bindParam("id_for_shoe", $shoeID);
    $stmt->execute();

    echo
    "
        <script>
        alert('added to your collection');
        </script>
    
        ";
}
