<?php
include('../forms/tietokanta.php');
$sivu = $_SERVER['PHP_SELF'];
$loppuosa = substr($sivu, strrpos($sivu, "/") + 1);
$osoite = substr($loppuosa, 0, strpos($loppuosa, "."));

$active = "class=\"nav-link active\" ";


session_start();

if (isset($_COOKIE['expiry_date'])) {
  $member_login = $_COOKIE['member_login'];
  $query = " SELECT * FROM kayttajat WHERE kayttaja_nimi='$member_login'";
  $tulokset = $yhteys->query($query);
  if ($tulokset->num_rows > 0) {
    $rivi = $tulokset->fetch_assoc();
    $token_cookie = $rivi['token_cookie'];
    $author = password_verify($_COOKIE['token_cookie'], $token_cookie);
    if ($author) {
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['kayttaja_nimi'] = $_COOKIE['member_login'];
      $_SESSION['admin'] = $rivi['admin'];
      $_SESSION['last_activity']=time();
    }
  }
}elseif(isset($_SESSION['last_activity'])&& (time()-$_SESSION['last_activity']>1200)){
  session_unset();
  session_destroy();
} else {$_SESSION['last_activity']=time();}
?>

<!DOCTYPE html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>ENERGIA kuntoklubi</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../style/custom.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>
    .bs-example{
        margin: 20px;
    }
</style>

</head>
<body class="custom-body">
<div class="bs-example-fluid">    
    <nav class="navbar navbar-expand-md navbar-dark bg-secondary" >         
        <a href="../index.php" class="navbar-brand"><span class="logo">ENERGIA</span></a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav">
                <a <?php if ($osoite == "company") echo $active;?> href="../company/company.php" class="nav-item nav-link">MEISTÄ</a>
                <a <?php if ($osoite == "trainers") echo $active;?> href="../trainers/trainers.php" class="nav-item nav-link">OHJAAJAT</a>
                <a <?php if ($osoite == "contacts") echo $active;?> href="../contacts/contacts.php" class="nav-item nav-link">OTA YHTEYTTÄ</a>
                <a <?php if ($osoite == "timetable") echo $active;?> href="../customers/timetable.php" class="nav-item custom-link">VARAA AIKA</a>
            
                <?php
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
                ?>
                <a <?php if ($osoite == "uusi_tuote") echo $active; ?> href="../admin/uusi_tuote.php">Uusi tuote</a>
                <?php
                } ?>

            </div>
            
            <div class="navbar-nav">
                <a <?php if ($osoite == "cart") echo $active;?> href="../cart/cart.php" class="nav-item nav-link"><i class="bi bi-cart"></i></a>       
                
                <?php if (isset($_SESSION['admin'])) { ?>
                <a <?php if ($osoite == "ulos") echo $active;?> href="../forms/ulos.php" class="nav-item nav-link">ULOS</a>
                <?php
                } else { ?>          
                
                <a <?php if ($osoite == "rekisterointi_email") echo $active; ?> href="../forms/rekisterointi_email.php" class="nav-item nav-link">Luo tili</a>
                <a <?php if ($osoite == "kirjaudu") echo $active; ?> href="../forms/kirjaudu.php" class="nav-item nav-link"><i class="bi bi-person-circle" style="font-size:18px;"></i></a>
                <?php
                } ?>
            </div>
        </div>        
    </nav>
</div>