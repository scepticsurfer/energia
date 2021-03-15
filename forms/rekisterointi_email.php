<?php
include("../navigation-sub.php");
include('./rek_pros_email.php');

//if (isset($_SESSION['error'])) {
//  echo "<div class='error'>Error: " . $_SESSION['error']. "</div>";
//  unset($_SESSION['error']);
//}
?>

<div class="container-fluid">
    <p></p>

    <!--Row with three equal columns-->
    <div class="row">
        <div class="col-lg-2">        
        </div>

        <div class="col-lg-8">

            <!--<div class="App">-->
            <!--<div class="vertical-center">-->
            <!--<div id="inner_reg" class="inner-block">-->
            <form class="custom-form" action="" method="post">
                <h2>LUO TILI</h2>

                <?php echo $success_msg; ?>
                <?php echo $email_exist; ?>
                <?php echo $name_exist; ?>
                <?php echo $email_verify_err; ?>
                <?php echo $email_verify_success; ?>

                <div class="form-group">
                    <label>Nimi</label>
                    <input type="text" class="form-control" name="kay_nimi" id="kay_nimi" />

                    <?php echo $fNameEmptyErr; ?>
                    <?php echo $f_NameErr; ?>
                </div>


                <div class="form-group">
                    <label>Sähköposti</label>
                    <input type="email" class="form-control" name="kay_posti" id="kay_posti" />

                    <?php echo $_emailErr; ?>
                    <?php echo $emailEmptyErr; ?>
                </div>

                <div class="form-group">
                    <label>Salasana</label>
                    <input type="password" class="form-control" name="kay_salasana" id="kay_salasana" />

                    <?php echo $_passwordErr; ?>
                    <?php echo $passwordEmptyErr; ?>
                </div>

                <div class="form-group">
                    <label>Vahvista salasana</label>
                    <input type="password" class="form-control" name="kay_salasana_2" id="kay_salasana_2" />

                    <?php echo $password_2_EmptyErr; ?>
                    <?php echo $passwords_notequal; ?>                    
                </div>

                <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">Sign up
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