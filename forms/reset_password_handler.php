<?php
//include('tietokanta.php');
require_once '../vendor/autoload.php';
global $emailErr;
if (isset($_POST["submit"])) {

    $kay_posti = $yhteys->real_escape_string(strip_tags($_POST["kay_posti"]));
    $kay_posti = filter_var($kay_posti, FILTER_SANITIZE_EMAIL);
    $query = "SELECT kayttaja_sposti FROM kayttajat WHERE kayttaja_sposti='$kay_posti'";
    $tulokset = $yhteys->query($query);
    if ($tulokset->num_rows == 0) {

        $resetErr['emailErr'] = ' <div class="alert alert-danger" role="alert">
                       User with email is not exist!
                    </div>';
    } else {
        // Generate random activation token
        $token_salasana = md5(rand() . time());
        $rek_Query = "UPDATE kayttajat SET token_salasana='$token_salasana' WHERE kayttaja_sposti='$kay_posti'";
        $tulokset = $yhteys->query($rek_Query);
        if ($tulokset) {
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername('paras.testaaja@gmail.com')
                ->setPassword('FIukr531SIM');

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $msg = 'Click on the link to reset your password. <br><br>
                  <a href="http://localhost/moodle/puutarhakauppa_neilikka/change_password_form.php?token_salasana=' . $token_salasana . '"> Click here to verify email</a>
                ';
            $message = (new Swift_Message('Salasanan resetointi'))
                ->setFrom([$kay_posti =>  'Neilikka '])
                ->setTo($kay_posti)
                ->addPart($msg, "text/html")
                ->setBody('Hello! User');

            // Send the message
            $result = $mailer->send($message);
            if($result){
                $resetErr['emailSent'] = ' <div class="alert alert-success" role="alert">
                       Message was sent. Check your emai.
                    </div>';
            }else {
                $resetErr['emailSentErr'] = ' <div class="alert alert-success" role="alert">
                       Message was not sent. Try again.
                    </div>'; 
            }

        } else{ 
            $resetErr['error'] = ' <div class="alert alert-success" role="alert">
                       Error!.
                    </div>'; }
    }
}
