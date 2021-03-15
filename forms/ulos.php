<?php
include('tietokanta.php');
session_start();
session_unset();
session_destroy();
if ($_COOKIE['member_login']){
$nimi=$_COOKIE['member_login'];
$query="UPDATE kayttajat SET token_cookie=NULL, cookie_expiry=NULL WHERE kayttaja_nimi='$nimi' ";
$tulokset=$yhteys->query($query);
setcookie("member_login","", time() - 3600, "/");
setcookie("token_cookie","", time() - 3600, "/");
setcookie("expiry_date", "", time() - 3600, "/");
}

header("location:kirjaudu.php");

exit();
?>