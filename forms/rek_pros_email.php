<?php
//include('tietokanta.php');

// Swiftmailer lib
require_once '../vendor/autoload.php';
global $success_msg, $email_exist, $name_exist, $f_NameErr, $passwords_notequal, $_emailErr, $_passwordErr;
global $fNameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $password_2_EmptyErr, $email_verify_err, $email_verify_success;


?>

    <?php
    if (isset($_POST["submit"])) {
        $kay_nimi = $yhteys->real_escape_string(strip_tags($_POST["kay_nimi"]));
        $kay_nimi = filter_var($kay_nimi, FILTER_SANITIZE_STRING);

        $kay_posti = $yhteys->real_escape_string(strip_tags($_POST["kay_posti"]));
        $kay_posti = filter_var($kay_posti, FILTER_SANITIZE_EMAIL);

        $kay_salasana = $yhteys->real_escape_string(strip_tags($_POST["kay_salasana"]));
        $kay_salasana = filter_var($kay_salasana, FILTER_SANITIZE_STRING);

        $kay_salasana_2 = $yhteys->real_escape_string(strip_tags($_POST["kay_salasana_2"]));
        $kay_salasana_2 = filter_var($kay_salasana_2, FILTER_SANITIZE_STRING);

        $kayttaja_tarkis_query = "SELECT * FROM kayttajat WHERE kayttaja_nimi='$kay_nimi' OR kayttaja_sposti='$kay_posti' LIMIT 1";
        $tulokset = $yhteys->query($kayttaja_tarkis_query);

        if (!empty($kay_nimi) && !empty($kay_posti) && !empty($kay_salasana) && !empty($kay_salasana_2)) {

            if ($tulokset->num_rows > 0) {
                $rivi = $tulokset->fetch_assoc();
                if ($rivi["kayttaja_nimi"] === $kay_nimi) {
                    $name_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with name already exist!
                    </div>
                ';
                }
                if ($rivi['kayttaja_sposti'] === $kay_posti) {
                    $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
                }
            } else {

                // perform validation
                if (!preg_match("/^[a-zA-Z ]*$/", $kay_nimi)) {
                    $f_NameErr = '<div class="alert alert-danger">
                        Only letters and white space allowed.
                    </div>';
                } elseif (!filter_var($kay_posti, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                        Email format is invalid.
                    </div>';
                } elseif (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $kay_salasana)) {
                    $_passwordErr = '<div class="alert alert-danger">
                         Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                    </div>';
                } elseif ($kay_salasana != $kay_salasana_2) {
                    $passwords_notequal = '<div class="alert alert-danger">
                Passwords are not equal.
           </div>';
                } else {
                    // Generate random activation token
                    $token = md5(rand() . time());
                    //Hash password
                    $salasana_hash = password_hash($kay_salasana, PASSWORD_BCRYPT);
                    // Query
                    $rek_Query = "INSERT INTO kayttajat(kayttaja_nimi, kayttaja_salasana, kayttaja_sposti, token, is_active) VALUE ('$kay_nimi','$salasana_hash','$kay_posti','$token', '0')";
                    $tulokset = $yhteys->query($rek_Query);
                    // Send verification email
                    if ($tulokset) {
                        $msg = 'Click on the activation link to reset your password. <br><br>
                  <a href="http://localhost/moodle/energia/forms//user_verification.php?token=' . $token . '"> Click here to verify email</a>
                ';

                        // Create the Transport
                        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                            ->setUsername('paras.testaaja@gmail.com')
                            ->setPassword('FIukr531SIM');

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);

                        // Create a message
                        $message = (new Swift_Message('Please Verify Email Address!'))
                            ->setFrom([$kay_posti =>  'Neilikka '])
                            ->setTo($kay_posti)
                            ->addPart($msg, "text/html")
                            ->setBody('Hello! User');

                        // Send the message
                        $result = $mailer->send($message);

                        if (!$result) {
                            $email_verify_err = '<div class="alert alert-danger">
                            Verification email coud not be sent!
                    </div>';
                        } else {
                            $email_verify_success = '<div class="alert alert-success">
                        Verification email has been sent!
                    </div>';
                        }
                    }
                }
            }
        } else {
            if (empty($kay_nimi)) {
                $fNameEmptyErr = '<div class="alert alert-danger">
                    First name can not be blank.
                </div>';
            }

            if (empty($kay_posti)) {
                $emailEmptyErr = '<div class="alert alert-danger">
                    Email can not be blank.
                </div>';
            }

            if (empty($kay_salasana)) {
                $passwordEmptyErr = '<div class="alert alert-danger">
                    Password can not be blank.
                </div>';
            }
            if (empty($kay_salasana)) {
                $password_2_EmptyErr = '<div class="alert alert-danger">
                    Password_2 can not be blank.
                </div>';
            }
        }
    }

    $yhteys->close();

    
   

