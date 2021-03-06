<?php

$error = [
    "passwordErr" => "", "passwords_notequal" => "", "password_changed" => "",
    "change_error" => "", "passwordEmptyErr" => "", "password_2_EmptyErr" => "", "wrong_token" => "", "empty_token" => ""
];

include("../navigation.php");
include("change_password_handler.php");

if (isset($_GET['token_password']) && !empty($_GET['token_password'])){
    $token_password = $_GET['token_password'];
} elseif (isset($_POST['token_password'])&&!empty($_POST['token_password']) ){
    $token_password = $_POST['token_password'];
}else {
    $token_salasana = "";
}
?>

<div class="container-fluid custom-margin-for-form"> 

    <!--Row starts-->
    <div class="row">
        <div class="col-lg-2">        
        </div>

        <div class="col-lg-8">
            <form class="custom-form" action="change_password_form.php" method="post">
                <h2>UUSI SALASANA</h2>
                <input type="hidden" name="token_password" value="<?php echo $token_password; ?>">
                <?php echo isset($error['password_changed']) ? $error['password_changed'] : ''; ?>
                <?php echo isset($error['change_error']) ? $error['change_error'] : ''; ?>
                <?php echo isset($error['wrong_token']) ? $error['wrong_token'] : ''; ?>
                <?php echo isset($error['empty_token']) ? $error['empty_token'] : ''; ?>
                <div class="form-group">
                    <label>Salasana</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                    <?php echo isset($error['passwordErr']) ? $error['passwordErr'] : ''; ?>
                    <?php echo isset($error['passwordEmptyErr']) ? $error['passwordEmptyErr'] : ''; ?>
                </div>
                <div class="form-group">
                    <label>Vahvista salasana</label>
                    <input type="password" class="form-control" name="password_2" id="password_2"/>
                    <?php echo isset($error['passwords_notequal']) ? $error['passwords_notequal'] : ''; ?>
                    <?php echo isset($error['password_2_EmptyErr']) ? $error['password_2_EmptyErr'] : ''; ?>
                </div>

                <button type="submit" name="submit" id="submit"
                        class="btn btn-outline-primary btn-lg btn-block">Vaihda
                </button>
            </form>            
        </div>

        <div class="col-lg-2">        
        </div>
    </div>
    <!--Row ends-->  

</div>

<?php
include("../footer.php");
?>
