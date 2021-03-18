<?php
$env = parse_ini_file('../.env');
require_once '../vendor/autoload.php';
global $emailErr;
if (isset($_POST["submit"])) {

    $email = $connect->real_escape_string(strip_tags($_POST["email"]));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $query = "SELECT email, id FROM users WHERE email='$email'";
    $result = $connect->query($query);
    if ($result->num_rows == 0) {
        
        $resetErr['emailErr'] = ' <div class="alert alert-danger" role="alert">
                       User with email is not exist!
                    </div>';
    } else {
        // Generate random activation token
        $row = $result->fetch_assoc();
        $user_id=$row['id'];
        $token_password = md5(rand() . time());
        $token_Query = "UPDATE users_tokens SET token_password='$token_password' WHERE user_id='$user_id'";
        $result = $connect->query($token_Query);
        if ($result) {
            // Create the Transport
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                ->setUsername($env['swift_username'])
                ->setPassword($env['swift_password']);

            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);

            // Create a message
            $msg = 'Click on the link to reset your password. <br><br>
            <a href="http://'.$env['domain'].'/' . $env['app_dir'] . '/forms/change_password_form.php?token_password=' . $token_password . '"> Click here to reset your password</a>
                ';
            $message = (new Swift_Message('Salasanan resetointi'))
                ->setFrom([$email =>  'Energia '])
                ->setTo($email)
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
