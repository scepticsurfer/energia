<?php

$error = [
      "passwordErr" => "", "passwords_notequal" => "", "password_changed" => "",
    "change_error" => "", "passwordEmptyErr" => "", "password_2_EmptyErr" => "", "wrong_token" => "", "empty_token" => ""
];

include("../navigation-sub.php");
//include('./tietokanta.php');
include("change_password_handler.php");

 if (isset($_GET['token_salasana']) && !empty($_GET['token_salasana'])){
    $token_salasana = $_GET['token_salasana'];
} elseif (isset($_POST['token_salasana'])&&!empty($_POST['token_salasana']) ){
    $token_salasana = $_POST['token_salasana'];
}else {
    $token_salasana = "";
}
?>

<div class="container-fluid">
    <p></p>

    <!--Row with three equal columns-->
    <div class="row">
        <div class="col-lg-2">        
        </div>

        <div class="col-lg-8">
            <!--<div class="page-header">-->
            <!--</div>-->
            <!--<div class="App">-->
            <!--<div class="vertical-center">-->
            <!--<div id="inner_login" class="inner-block">-->
                        <form class="custom-form" action="change_password_form.php" method="post">
                            <h2>UUSI SALASANA</h2>
                            <input type="hidden" name="token_salasana" value="<?php echo $token_salasana; ?>">
                            <?php echo isset($error['password_changed']) ? $error['password_changed'] : ''; ?>
                            <?php echo isset($error['change_error']) ? $error['change_error'] : ''; ?>
                            <?php echo isset($error['wrong_token']) ? $error['wrong_token'] : ''; ?>
                            <?php echo isset($error['empty_token']) ? $error['empty_token'] : ''; ?>
                            <div class="form-group">
                                <label>Salasana</label>
                                <input type="password" class="form-control" name="kay_salasana" id="kay_salasana"/>
                                <?php echo isset($error['passwordErr']) ? $error['passwordErr'] : ''; ?>
                                <?php echo isset($error['passwordEmptyErr']) ? $error['passwordEmptyErr'] : ''; ?>
                            </div>
                            <div class="form-group">
                                <label>Vahvista salasana</label>
                                <input type="password" class="form-control" name="kay_salasana_2" id="kay_salasana_2"/>
                                <?php echo isset($error['passwords_notequal']) ? $error['passwords_notequal'] : ''; ?>
                                <?php echo isset($error['password_2_EmptyErr']) ? $error['password_2_EmptyErr'] : ''; ?>
                            </div>

                            <button type="submit" name="submit" id="submit"
                                    class="btn btn-outline-primary btn-lg btn-block">Vaihda
                            </button>
                        </form>
            <!--</div>-->
            <!--</div>-->
            <!--</div>-->

        </div>

        <div class="col-lg-2">        
        </div>
    </div>
    <!--Row with three equal columns-->

    <p></p>

</div>

<?php
include("../footer.php");
?>
