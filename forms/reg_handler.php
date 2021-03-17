<?php
$env = parse_ini_file('../.env');
// Swiftmailer lib
require_once '../vendor/autoload.php';
global $success_msg, $email_exist, $name_exist, $f_NameErr, $passwords_notequal, $_emailErr, $_passwordErr;
global $fNameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $password_2_EmptyErr, $email_verify_err, $email_verify_success;


?>

    <?php
    if (isset($_POST["submit"])) {
        $user_name = $connect->real_escape_string(strip_tags($_POST["user_name"]));
        $user_name = filter_var($user_name, FILTER_SANITIZE_STRING);

        $user_email = $connect->real_escape_string(strip_tags($_POST["user_email"]));
        $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);

        $user_password = $connect->real_escape_string(strip_tags($_POST["user_password"]));
        $user_password = filter_var($user_password, FILTER_SANITIZE_STRING);

        $user_password_2 = $connect->real_escape_string(strip_tags($_POST["user_password_2"]));
        $user_password_2 = filter_var($user_password_2, FILTER_SANITIZE_STRING);

        $user_check_query = "SELECT * FROM users WHERE name='$user_name' OR email='$user_email' LIMIT 1";
        $result = $connect->query($user_check_query);

        if (!empty($user_name) && !empty($user_email) && !empty($user_password) && !empty($user_password_2)) {

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["name"] === $user_name) {
                    $name_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with name already exist!
                    </div>
                ';
                }
                if ($row['email'] === $user_email) {
                    $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
                }
            } else {

                // perform validation
                if (!preg_match("/^[a-zA-Z ]*$/", $user_name)) {
                    $f_NameErr = '<div class="alert alert-danger">
                        Only letters and white space allowed.
                    </div>';
                } elseif (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                        Email format is invalid.
                    </div>';
                } elseif (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $user_password)) {
                    $_passwordErr = '<div class="alert alert-danger">
                         Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                    </div>';
                } elseif ($user_password != $user_password_2) {
                    $passwords_notequal = '<div class="alert alert-danger">
                Passwords are not equal.
           </div>';
                } else {
                    // Generate random activation token
                    $token = md5(rand() . time());
                    //Hash password
                    $password_hash = password_hash($user_password, PASSWORD_BCRYPT);
                    // Query
                    $reg_user = "INSERT INTO users(name, password, email, is_active) 
                                 VALUE ('$user_name','$password_hash','$user_email', '0')";
                    $result = $connect->query($reg_user);
                    // Send verification email
                    if ($result) {
                        // insert in users open
                        $last_insert_id = $connect->insert_id;
                        $reg_token = "INSERT INTO users_tokens(user_id,token_activation) VALUE ('$last_insert_id','$token')";
                        $result = $connect->query($reg_token);
                        if ($result) {
                            //insert in tokens open 
                            $msg = 'Click on the activation link to verify your email. <br><br>
                  <a href="http://'.$env['domain'].'/' . $env['app_dir'] . '/forms/user_verification.php?token=' . $token . '"> Click here to verify email</a>
                ';

                            // Create the Transport
                            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                                ->setUsername('lyubov.ivkina@gmail.com')
                                ->setPassword('Ivki.bov2910');

                            // Create the Mailer using your created Transport
                            $mailer = new Swift_Mailer($transport);

                            // Create a message
                            $message = (new Swift_Message('Please Verify Email Address!'))
                                ->setFrom([$user_email =>  'Energia '])
                                ->setTo($user_email)
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
                        //insert in tokens close
                    }
                    //insert in users close
                }
            }
        } else {
            if (empty($user_name)) {
                $fNameEmptyErr = '<div class="alert alert-danger">
                    First name can not be blank.
                </div>';
            }

            if (empty($user_email)) {
                $emailEmptyErr = '<div class="alert alert-danger">
                    Email can not be blank.
                </div>';
            }

            if (empty($user_password)) {
                $passwordEmptyErr = '<div class="alert alert-danger">
                    Password can not be blank.
                </div>';
            }
            if (empty($user_password_2)) {
                $password_2_EmptyErr = '<div class="alert alert-danger">
                    Password_2 can not be blank.
                </div>';
            }
        }
    }

    $connect->close();
