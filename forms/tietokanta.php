<?php

function debuggeri($arvo) {
    if (!defined('DEBUG') || !DEBUG) {
        return;
    }

    if (is_array($arvo) || is_object($arvo)) {
        $msg = var_export($arvo,true);
    } else {
        $msg = $arvo;
    }

    $msg = '[' . date("Y-m-d H:i:s") . "] " . $msg;
    file_put_contents("debug_log.txt", $msg . "\n", FILE_APPEND);
}

$local = in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
define("DEBUG", $local);

$palvelin = "localhost";
$kayttaja = "root";
$salasana = "";
$tietokanta = "neilikka";

$yhteys = new mysqli($palvelin, $kayttaja, $salasana, $tietokanta);

if ($yhteys->connect_error) {
    debuggeri($yhteys->connect_error);
    echo "Tapahtui virhe";
    die();
}

$yhteys->set_charset("utf8");
