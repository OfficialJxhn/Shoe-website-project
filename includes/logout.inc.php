<?php
#this file will just create a new session replacing the current one, then destroy that session that was just created
session_start();

$_SESSION = array();

session_destroy();
#redirects them back to the login page 
header("Location: ../login.php");
exit();
