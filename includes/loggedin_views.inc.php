<?php
#this file is necessary as i would need to see if the user is logged in or not
require_once "login_view.inc.php";

#this is a function to load the navigation bar onto each page of the website
#this reduces time spent creating the same navigation bar over again when i can just refer to this function
function header_for_navbar()
{
    #if statement to check if the user is logged in 
    if (isset($_SESSION["user_id"])) {
        echo '<li><a class = "owned-link" href="./owned.php">owned</a></li>';
        echo '<li><a class= "brands-link" href="./jordan.php?action=jordan-action">Jordan</a><li>';
        echo '<li><a class = "brands-link" href="./nike.php?action=nike-action">Nike</a><li>';
        echo '<li><a class = "brands-link" href="./yeezy.php?action=yeezy-action">Yeezy</a><li>';
        echo '</ul>';
        echo '</nav>';
        echo '<a class="cta" href="./logout.php"><button>logout</button></a>';
    } else {
        output_username();
        echo '<li><a class="sign-up-link" href="./sign-up.php">sign up</a></li>';
        echo '<li><a class="login-in-link" href="./login.php">login</a></li>';
        echo '</ul>';
        echo '</nav>';
        echo '<a class="cta" href="./login.php"><button>login</button></a>';
    }
}
