<?php
// Database connection
include('./tietokanta.php');

global $email_verified, $email_already_verified, $activation_error;

// GET the token = ?token
if (!empty($_GET['token'])) {
    $token = $_GET['token'];
} else {
    $token = "";
}

if ($token != "") {
    $sqlQuery = "SELECT * FROM kayttajat WHERE token = '$token'";
    $result = $yhteys->query($sqlQuery);

    if ($result->num_rows > 0) {
        $rowData = $result->fetch_assoc();
        $is_active = $rowData['is_active'];
        if ($is_active == 0) {
            $update = "UPDATE kayttajat SET is_active = '1' WHERE token = '$token'";
            $result = $yhteys->query($update);
            if ($result) {
                $email_verified = '<div class="alert alert-success">
                                  User email successfully verified!
                                </div>';
                $tok_del = "UPDATE kayttajat SET token=NULL WHERE token='$token'";
                $tulokset = $yhteys->query($tok_del);
            }
        } else {
            $email_already_verified = '<div class="alert alert-danger">
                               User email already verified!
                            </div>';
        }
    } else {
        $activation_error = '<div class="alert alert-danger">
                    Activation error!
                </div>
            ';
    }
}
