<?php
include ("../navigation.php");

if (isset($_SESSION['loggedIn'])) {
    echo 'This is trainer page';
} 

include ("../footer.php");
?>