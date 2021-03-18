<?php
include("../navigation.php");
include("feedback_handler.php");
?>

<div class="container-fluid">
<p></p>

    <!--Row starts-->
    <div class="row">
        <div class="col-lg-2">        
        </div>

        <div class="col-lg-8">
            <!--<div class="App">-->
            <!--<div class="vertical-center">-->
            <!--<div class="inner-block">-->
            <form class="custom-form" action="" method="post">
                <h4>OTA MEIHIN YHTEYTTÄ</h4>
                <?php echo $_emailErr; ?>
                <?php echo $_feefbackErr; ?>
                <?php echo $_feedbackSucsess; ?>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nimi</label>
                    <div class="col">
                        <input type="text" class="form-control" name="name" id="name" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Sähköposti</label>
                    <div class="col">
                        <input type="email" class="form-control" name="email" id="email" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Aihe</label>
                    <div class="col">
                        <input type="text" class="form-control" name="theme" id="theme" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Viesti</label>
                    <div class="col">
                        <textarea class="form-control" rows="5" name="feedback" id="feedback"></textarea>
                    </div>

                </div>

                <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">Ota yhteyttä
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
    <!--Row ends-->

    <p></p>

</div> 

<?php
include("../footer.php");
?>