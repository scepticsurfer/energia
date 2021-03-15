<?php

if (isset($_POST["submit"])) {
    $kay_salasana = $yhteys->real_escape_string(strip_tags($_POST["kay_salasana"]));
    $kay_salasana = filter_var($kay_salasana, FILTER_SANITIZE_STRING);

    $kay_salasana_2 = $yhteys->real_escape_string(strip_tags($_POST["kay_salasana_2"]));
    $kay_salasana_2 = filter_var($kay_salasana_2, FILTER_SANITIZE_STRING);

    $token_salasana = $_POST["token_salasana"];
    
    if ($token_salasana != "") {
        $sqlQuery = "SELECT * FROM kayttajat WHERE token_salasana = '$token_salasana' ";
        $tulokset = $yhteys->query($sqlQuery);
        $rivi = $tulokset->fetch_assoc();
        $rivi_num = $tulokset->num_rows;
        if ($rivi_num == 0) {
            

            $error['wrong_token'] = '<div class="alert alert-danger">
            Token is wrong!
         </div>';

        } else {
            $is_active = $rivi['is_active'];
            if ($is_active == 0) {
                $update = "UPDATE kayttajat SET is_active = '1' WHERE token_salasana = '$token_salasana'";
                $tulokset = $yhteys->query($update);
            }
            if (!empty($kay_salasana) && !empty($kay_salasana_2)) {
                if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $kay_salasana)) {
                    $error['passwordErr'] = '<div class="alert alert-danger">
                                               Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                                             </div>';

                } elseif ($kay_salasana != $kay_salasana_2) {
                    $error['passwords_notequal'] = '<div class="alert alert-danger">
                                               Passwords are not equal.
                                            </div>';
                } else {
                    $salasana_hash = password_hash($kay_salasana, PASSWORD_BCRYPT);
                    $pas_Query = "UPDATE kayttajat SET kayttaja_salasana='$salasana_hash' WHERE token_salasana='$token_salasana'";
                    $tulokset = $yhteys->query($pas_Query);
                    if ($tulokset) {
                        $tok_del = "UPDATE kayttajat SET token_salasana=NULL WHERE token_salasana='$token_salasana'";
                        $tulokset = $yhteys->query($tok_del);
                        $error['password_changed'] = '<div class="alert alert-success">
                                                                          Password successfully changed!
                                                                       </div>';
                    } else {
                        $error['change_error'] = '<div class="alert alert-danger">
                                                                       Error!
                                                                   </div> ';
                    }
                }
            } else {

                if (empty($kay_salasana)) {
                    $error['passwordEmptyErr'] = '<div class="alert alert-danger">
                                            Password can not be blank.
                                         </div>';
                }
                if (empty($kay_salasana)) {
                    $error['password_2_EmptyErr'] = '<div class="alert alert-danger">
                                              Password_2 can not be blank.
                                            </div>';
                }
            }
        }
      
    } else{ $error['empty_token'] = '<div class="alert alert-danger">
                                       Token is empty!
                                    </div>';}
}   