<?php
require(__DIR__ . '/forms/db_connection.php');
$env = parse_ini_file('.env');

$page = $_SERVER['PHP_SELF'];
$end = substr($page, strrpos($page, "/") + 1);
$address = substr($end, 0, strpos($end, "."));

$active = "class=\"nav-link active\" ";

session_start();

if (isset($_COOKIE['user_id'])) {
  $user_id = $_COOKIE['user_id'];
  $query = " SELECT * FROM users LEFT JOIN users_tokens ON users.id=users_tokens.user_id  WHERE users.id='$user_id'";
  $result = $connect->query($query);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $token_cookie = $row['token_cookie'];
    $author = password_verify($_COOKIE['token_cookie'], $token_cookie);
    if ($author) {
      $_SESSION['loggedIn'] = TRUE;
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['admin'] = $row['admin'];
      $_SESSION['last_activity'] = time();
    }
  }
} elseif (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1200)) {
  session_unset();
  session_destroy();
} else {
  $_SESSION['last_activity'] = time();
}
?>

<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ENERGIA kuntoklubi</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/<?= $env['app_dir'] ?>/style/custom.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  <style>
    .bs-example {
      margin: 20px;
    }
  </style>

</head>

<body class="custom-body">
  <div class="bs-example-fluid">
    <nav class="navbar navbar-expand-md navbar-dark bg-secondary">
      <a href="/<?= $env['app_dir'] ?>/index.php" class="navbar-brand"><span class="logo">ENERGIA</span></a>
      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
        <div class="navbar-nav">
          <a <?php if ($address == "company") echo $active; ?> 
              href="/<?= $env['app_dir'] ?>/company/company.php" 
              class="nav-item nav-link">MEISTÄ
          </a>
          <a <?php if ($address == "trainers") echo $active; ?>
              href="/<?= $env['app_dir'] ?>/trainers/trainers.php"
              class="nav-item nav-link">OHJAAJAT
          </a>
          <a <?php if ($address == "contacts") echo $active; ?>
              href="/<?= $env['app_dir'] ?>/contacts/feedback.php" 
              class="nav-item nav-link">OTA YHTEYTTÄ
          </a>
          <a <?php if ($address == "timetable") echo $active; ?> 
               href="/<?= $env['app_dir'] ?>/customers/timetable.php" 
               class="nav-item custom-link">VARAA AIKA
          </a>
          <?php
          if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
          ?>
              <a <?php if ($address == "new_workout") echo $active; ?>
               href="/<?= $env['app_dir'] ?>/admin/new_workout.php">Uusi harjoitelu
               </a>
          <?php
          } ?>

        </div>

        <div class="navbar-nav">
          <a <?php if ($address == "cart") echo $active; ?> 
              href="/<?= $env['app_dir'] ?>/cart/cart.php" 
              class="nav-item nav-link"><i class="bi bi-cart"></i>
          </a>

          <?php if (isset($_SESSION['admin'])) { 
            ?>
            <a <?php if ($address == "logout") echo $active; ?> 
                href="/<?= $env['app_dir'] ?>/forms/logout.php"
                class="nav-item nav-link">Kirjaudu ulos
            </a>
          <?php
          } else { 
            ?>
            <a <?php if ($address == "registration") echo $active; ?>
                href="/<?= $env['app_dir'] ?>/forms/registration.php"
                class="nav-item nav-link">Luo tili
            </a>
            <a <?php if ($address == "login") echo $active; ?> 
                href="/<?= $env['app_dir'] ?>/forms/login.php" 
                class="nav-item nav-link"><i class="bi bi-person-circle" style="font-size:18px;"></i>
            </a>
          <?php
          } ?>
        </div>
      </div>
    </nav>
  </div>