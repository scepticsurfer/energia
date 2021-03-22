<?php
include("../navigation.php");

if (isset($_SESSION['loggedIn'])) {
} ?>

<div class="row">
    <div class="col-md-3">
        <a href="client_page.php">Minun harjoitelut</a><br>
        <a href="reservation.php">Varata aika</a><br>
        <a href="">Minun tietoa</a>
    </div>
    <div class="col-md-9">
        <div class="col-md-9">
            <form class="form-inline justify-content-center" action="" method="get">

                <div class="form-group row">
                    <div class="col">
                        <label>From</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="date_from" id="date_from" />
                    </div>
                    <div class="col">
                        <label>To</label>
                    </div>
                    <div class="col">
                        <input type="date" class="form-control" name="date_to" id="date_to" />
                    </div>
                    <div class="col">
                        <label>Title</label>
                    </div>

                    <?php
                    $titles = [];
                    $query = "SELECT title,id FROM workout_titles ORDER BY title";
                    $result = $connect->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $titles[$row['id']] = $row["title"];
                        }
                    }
                    ?>
                    <div class="col">

                        <select id="title" class=form-control name="title" value="<?php echo (isset($_GET['title'])) ? $_GET['title'] : "" ?>">
                            <option value="">all workouts</option>
                            <?php
                            foreach ($titles as $id => $title) {
                                echo "<option value=\"$id\">$title</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col">
                        <label>Trainer</label>
                    </div>
                    <?php
                    $titles = [];
                    $query = "SELECT `name`,id FROM users WHERE trainer='1' ORDER BY `name`";
                    $result = $connect->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $trainers[$row['id']] = $row["name"];
                        }
                    }
                    ?>
                    <div class="col">
                    <select id="trainer" class=form-control name="trainer" >
                            <option value="">all trainers</option>
                            <?php
                            foreach ($trainers as $id => $trainer) {
                                 echo "<option value=\"$id\">$trainer</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="col">
                        <button id="find_available" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>



            </form>
        </div>
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                            <th scope="col">Title</th>
                            <th scope="col">Trainer</th>
                            <th scope="col">Free slots</th>
                            <th scope="col">Reserv</th>
                        </tr>
                    </thead>
                    <tbody id="workouts_available">




                    <tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="workouts_available.js"></script>
<script type="text/javascript" src="make_reservation.js"></script>

<?php

include("../footer.php");
