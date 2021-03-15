<?php
$resetErr = [
    "emailErr" => "", "emailSent" => "", "emailSentErr" => "",
    "error" => ""
];
include("../navigation-sub.php");
include("reset_password_handler.php"); 

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
                    <form class="custom-form" action="" method="post">
                        <h2>VAIHDA SALASANA</h2>
                        <?php echo $resetErr['emailSent']; ?>
                        <?php echo $resetErr['emailErr']; ?>
                        <?php echo $resetErr['emailSentErr']; ?>
                        <?php echo $resetErr['error']; ?>
                        <div class="form-group">
                        <label>Sähköposti</label>
                            <input type="email" class="form-control" name="kay_posti" id="kay_posti" />

                        </div>
                    
                        <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">Vaihda
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