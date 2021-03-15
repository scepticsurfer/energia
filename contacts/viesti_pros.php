<?php

//include "tietokanta.php";
    global $_emailErr,$_feefbackErr, $_feedbackSucsess;

    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nimi = $yhteys->real_escape_string(strip_tags($_POST["nimi"]));
        $nimi = filter_var($nimi, FILTER_SANITIZE_STRING);

        $sahkoposti = $yhteys->real_escape_string(strip_tags($_POST["posti"]));
        $ahkoposti = filter_var($sahkoposti, FILTER_SANITIZE_EMAIL);

        $aihe = $yhteys->real_escape_string(strip_tags($_POST["aihe"]));
        $nimi = filter_var($aihe, FILTER_SANITIZE_STRING);
        
        $k_viesti = $yhteys->real_escape_string(strip_tags($_POST["k_viesti"]));
        $k_viesti = filter_var($k_viesti, FILTER_SANITIZE_STRING);

        
        if (!filter_var($sahkoposti, FILTER_VALIDATE_EMAIL)) {
            $_emailErr = '<div class="alert alert-danger">
                        Email format is invalid.
                    </div>';
          } else{
              $feedbackQuery = "INSERT INTO palautteet(pvm,nimi,sahkoposti,aihe,viesti) VALUE (NOW(),'$nimi',' $sahkoposti','$aihe','$k_viesti')";
              $tulokset = $yhteys->query($feedbackQuery);
              if ($tulokset) {
                $_feedbackSucsess = '<div class="alert alert-success" role="alert">
                <p>Kiitos yhteudenotosta!Palaamme sinulle mahdollisimman pian.</p>
                </div>';

                } else {
                    debuggeri("Virhe: " . $feedbackQuery . " " . $yhteys->error);
                    $_feefbackErr = '<div class="alert alert-danger">
                        Tapahtui virhe!
                    </div>';
                }
        }
    }
 
