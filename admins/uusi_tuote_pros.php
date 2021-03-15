<?php

global  $fileTooLarge, $formatErr, $fileNotUpload, $uploadErr, $productUploaded, $productUplErr;

//if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
//die('only post');
//}
if (isset($_POST["submit"])) {
  $nimi = $yhteys->real_escape_string(strip_tags($_POST["nimi"]));
  $nimi = filter_var($nimi, FILTER_SANITIZE_STRING);

  $tuotekuvaus = $yhteys->real_escape_string(strip_tags($_POST["tuotekuvaus"]));
  $tuotekuvaus = filter_var($tuotekuvaus, FILTER_SANITIZE_EMAIL);

  $tuotehinta = $yhteys->real_escape_string(strip_tags($_POST["tuotehinta"]));
  $tuotehinta = floatval(filter_var($tuotehinta, FILTER_SANITIZE_NUMBER_FLOAT));

  $kategoria = $yhteys->real_escape_string(strip_tags($_POST["kategoria"]));
  $kategoria = filter_var($kategoria, FILTER_SANITIZE_STRING);

  $uusi_kategoria = $yhteys->real_escape_string(strip_tags($_POST["uusi_kategoria"]));
  $uusi_kategoria = filter_var($uusi_kategoria, FILTER_SANITIZE_STRING);


  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  // $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
    $fileTooLarge = '
    <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Sorry, your file is too large.!
    </div>';
  } elseif ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    $formatErr = '<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Sorry, only JPG, JPEG, PNG & GIF files are allowed.
    </div>';
  } elseif (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $uploadErr = '
      <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Sorry, there was an error uploading your file.
      </div>';
  } else { //______________________Kategoria
    $query = "SELECT id FROM tuotekategoriat WHERE UPPER(kategoria) = UPPER('$kategoria')";
    $tulokset = $yhteys->query($query);
    if ($tulokset->num_rows > 0) {
      $rivi = $tulokset->fetch_assoc();
      $kategoria_id = $rivi['id'];
    } else {
      $kategoria_id = 0;
    }
    //______________________Uusi kategoria
    if ($uusi_kategoria) {
      $query = "SELECT kategoria FROM tuotekategoriat WHERE UPPER(kategoria) = UPPER('$uusi_kategoria')";
      $tulokset = $yhteys->query($query);
      if ($tulokset->num_rows == 0) {
        $query_uusi_kat = "INSERT INTO tuotekategoriat(kategoria) VALUES('$uusi_kategoria')";
        $tulokset_kat = $yhteys->query($query_uusi_kat);
      }
      $query = "SELECT id FROM tuotekategoriat WHERE UPPER(kategoria) = UPPER('$uusi_kategoria')";
      $tulokset = $yhteys->query($query);
      $rivi = $tulokset->fetch_assoc();
      $kategoria_id = $rivi['id'];
    }
    if ($kategoria_id === 0) {
      die('no category');
    }
    $query_uusi_tuote = "INSERT INTO tuotteet(tuote_nimi, tuote_kuvaus, tuote_kuva, hinta, kategoria_id) 
    VALUES('$nimi', '$tuotekuvaus', '$target_file', $tuotehinta, $kategoria_id)";
    $tulokset_uusi = $yhteys->query($query_uusi_tuote);

    if (!$tulokset_uusi) {
      $productUplErr = '
    <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    Sorry, there was an error uploading your product.
    </div>';
    } else {
      $productUploaded = '
  <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  The product successfuly uploaded.
  </div>';
    }
  }
}





