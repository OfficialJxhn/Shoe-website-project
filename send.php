<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

require_once 'includes/send_email.inc.php';
require_once 'includes/dbh.inc.php';
require_once 'includes/config_session.inc.php';
require_once 'includes/shoes_view.inc.php';

function send_email($pdo, $shoeID, $userID, $stockID)
{
    $query_insert_data_to_fav_table = "INSERT INTO favourited_shoes (id_of_users, id_of_shoes, stock_check) VALUES (:id_of_users, :id_of_shoes, :stock_check);";
    $stmt = $pdo->prepare($query_insert_data_to_fav_table);
    $stmt->bindParam(":id_of_users", $userID);
    $stmt->bindParam(":id_of_shoes", $shoeID);
    $stmt->bindParam(":stock_check", $stockID);
    $stmt->execute();

    $query = "SELECT shoes.shoeName FROM shoes INNER JOIN favourited_shoes ON :id_for_shoe_in_favourited_shoes = shoes.shoeID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_for_shoe_in_favourited_shoes", $shoeID);
    $stmt->execute();

    $result = $stmt->fetchColumn();

    try {
        $users_email = get_email($pdo); #this is used to get the email of the user that is currently logged in
        $mail = new PHPMailer(true); #this will create a new phpmailer instance 

        $mail->isSMTP(); # this is so that the email that is sent will use the SMTP protocol (security)
        $mail->Host = "smtp.gmail.com";  #this is to set the name of the mail server that will be used
        $mail->SMTPAuth = true; #this is to enable SMTP authentication (security)
        $mail->Username = "j6136238@gmail.com"; #this is to set the email that will be used to send emails to users
        $mail->Password = "gawonlfgdscxceae"; # this
        $mail->SMTPSecure = "ssl"; #this is to make the emails use encryption (security)
        $mail->Port = 465; #another secuirty measure setting the port to 465 is so smtp will have TLS (transport Layer Security) 

        $mail->setFrom("j6136238@gmail.com"); #same as the before set the email used to be set

        $mail->addAddress($users_email); #this is to decide where the email will be sent to

        $mail->isHTML(true); #this is to allow HTML to be used inside of the email

        $mail->Subject = "You will be Notified on the shoes $result"; #this will set the subject of the email
        $mail->Body = "Thank you for your intrest in the shoes $result you will be notified when they're back in stock"; #this is the text of the body of the email

        $mail->send(); #this sends the email

        echo #notify the user that they will be notified
        "
        
            <script>
            alert('you will be notified when shoe comes out');
            document.location.href = 'index.php';
            </script>
        
            ";
    } catch (Exception $e) { #if there is an error (e.g. if the user isnt logged in) they will bne redirected to the login page
        header("Location: login.php");
        die();
    }
}
