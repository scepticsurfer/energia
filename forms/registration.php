<?php
include("../navigation.php");
include('./reg_handler.php');

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
          
                <h3>LUO TILI</h3>

                <?php echo $success_msg; ?>
                <?php echo $email_exist; ?>
                <?php echo $name_exist; ?>
                <?php echo $email_verify_err; ?>
                <?php echo $email_verify_success; ?>

                <div class="form-group">
                    <label>Nimi</label>
                    <input type="text"class="form-control" name="user_name" id="user_name" />
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                    <?php echo $fNameEmptyErr; ?>
                    <?php echo $f_NameErr; ?>
                </div>


                <div class="form-group">
                    <label>Sähköposti</label>
                    <input type="email" class="form-control" name="user_email" id="user_email" />

                    <?php echo $_emailErr; ?>
                    <?php echo $emailEmptyErr; ?>
                </div>

                <div class="form-group">
                    <label>Salasana</label>
                    <input type="password" class="form-control" name="user_password" id="user_password" />

                    <?php echo $_passwordErr; ?>
                    <?php echo $passwordEmptyErr; ?>
                </div>

                <div class="form-group">
                    <label>Vahvista salasana</label>
                    <input type="password" class="form-control" name="user_password_2" id="user_password_2" />

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