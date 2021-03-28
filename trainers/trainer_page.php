<?php

include("../navigation.php");
$env = parse_ini_file('../.env');
if (!isset($_SESSION['trainer']) || $_SESSION['trainer'] == 0) {
    die();
}
?>

<div class="container-fluid custom-margin-container">    
    <h2 class="custom-txt-center custom-margin-bottom-2">TERVETULOA OHJAAJAN SIVULLE</h2> 
    <p class="custom-txt-center custom-txt-strong custom-txt-big"><script>showToday();</script> <span class="custom-lightgray custom-radius">viikko <?php echo date("W");?></span></p> 

    <!--Row starts-->
    <div class="row mt-4">
        <div class="col-sm-3">   
        </div>

        <div class="col-sm-6">   
            <!--NEW FORM STARTS-->
            <form class="form-inline justify-content-center mt-4"  method="get">
                <div class="form-group justify-content-center col-md-6 mb-4">
                    <label class="mr-4">Alkaen</label>
                    <input type="date" class="form-control mr-5" name="date_from" id="date_from">
                </div>
                <div class="form-group justify-content-center col-md-6 mb-4">
                    <label class="mr-4">Saakka</label>
                    <input type="date" class="form-control mr-5" name="date_to" id="date_to">
                </div>            
                <button type="submit" class="btn btn-danger mb-4 pr-5 pl-5" id="show">Etsi</button>            
            </form> 
            <!--NEW FORM ENDS--> 
        </div>

        <div class="col-sm-3">        
        </div>
    </div>
    <!--Row ends-->

    <div class="container" id="timetable" >       
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Päivämäärä</th>
                        <th scope="col">Ajankohta</th>
                        <th scope="col">Liikuntalaji</th>
                        <th scope="col">Vapaat paikat</th>
                        <th scope="col">Osallistujat</th>
                        <th scope="col">Tila</th>
                    </tr>
                </thead>

                <tbody>
                    <tr id=timetable_row>
                    </tr>
                <tbody>
            </table>
        </div>
    </div>

    <div class="custom-space">
        <p></p>
    </div> 

</div>

<script type="text/javascript" src="workouts_select.js"></script>

<?php
include("../footer.php");
?>
