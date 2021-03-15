<?php
include("../navigation-sub.php");
include("kirjaudu_pros.php");
//session_start();
//if (isset($_SESSION['loggedIn'])) {
//    header('Location: y_tili.php');
//  die();
//}

?>

<div class="container-fluid">
<p></p>

<!--Row with three equal columns-->
<div class="row">
    <div class="col-lg-2">        
    </div>

    <div class="col-lg-8">
        <!--<div class="page-header">
        </div>-->
        <!--<div class="App">-->
        <!--<div class="vertical-center">-->
        <!--<div id="inner_login" class="inner-block">-->
                <form class="custom-form" action="" method="post">
                    <h2>KIRJAUDU</h2>

                    <?php echo $accountNotExistErr; ?>
                    <?php echo $namePwdErr; ?>
                    <?php echo $verificationRequiredErr; ?>
                    <?php echo $name_empty_err; ?>
                    <?php echo $pass_empty_err; ?>

                    <div class="form-group">
                        <label>Nimi</label>
                        <input type="text" class="form-control" name="kay_nimi" id="kay_nimi" />


                    </div>

                    <div class="form-group">
                        <label>Salasana</label>
                        <input type="password" class="form-control" name="kay_salasana" id="kay_salasana" />
                        <a href="reset_password.php"> Unohditko salasana?</a>


                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" name="rememberme" id="rememberme" />
                        <label class="form-check-label" for="rememberme">Muista minut</label>
                    </div>

                    <button type="submit" name="login" id="submit" class="btn btn-outline-primary btn-lg btn-block">Kirjaudu
                    </button>
                    <p></p>
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