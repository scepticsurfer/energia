<?php
include("../navigation.php");

if (!isset($_SESSION['loggedIn']) || $_SESSION['admin']==1 ||$_SESSION['trainer']==1  ) {
    die;
    } ?>

<div class="row">
    <div class="col-md-3">
        <a href="">Minun harjoitelut</a><br>
        <a href="">Varata aika</a><br>
        <a href="">Minun tietoa</a>
    </div>
    <div  class="col-md-9">
        <div class="col-md-9">
            <form class="form-inline justify-content-center" action="" method="get">

                <div class="form-group row">
                    <div class="col">
                        <label>From</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="date_from" id="date_from" />
                    </div>

                </div>

                <div class="form-group row">
                    <div class="col">
                        <label>To</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="date_to" id="date_to" />
                    </div>

                    <div class="col">
                        <button id="client_select" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div  class="col-md-9">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Title</th>
                        <th scope="col">Trainer</th>
                    </tr>
                </thead>
                <tbody id="reserv_row">
                       

                       

                    <tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="client_reserv_select.js"></script>
<?php

include("../footer.php");
