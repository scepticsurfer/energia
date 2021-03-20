<?php

include("../navigation.php");
$env = parse_ini_file('../.env');
/*if (isset($_SESSION['trainer']) && $_SESSION['trainer'] == 1) {
    $user_id = $_SESSION['user_id'];
} else {
    header('Location:../forms/login.php');
}
*/
?>
<form class="form-inline justify-content-center" action="" method="get" >

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
            <button id="show" class="btn btn-primary mb-2">Submit</button>
        </div>
    </div>
</form>


<div id="timetable" class="container">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Title</th>
                        <th scope="col">Free slots</th>
                        <th scope="col">Participants</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                       <tr id=timetable_row>

                       </tr>

                    <tbody>
            </table>
        </div>
  
</div>

<script type="text/javascript" src="workouts_select.js"></script>

<?php





include("../footer.php");
