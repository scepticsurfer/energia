<?php


$error = [
    "date_error" => "", "time_error" => "", "workout_exist" => "",
    "add_error" => "", "add_success" => "", "empty_error" => "", "change_error" => "", "change_success" => ""
];
include("../navigation.php");
include("new_workout_handler.php");

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
            <!--<div class="inner-block">-->
            <form class="custom-form" action="new_change_workout.php" method="post">

                <h2> <?php echo (isset($_GET['title'])) ? "Change workout" : "New workout" ?></h2>

                <?php echo isset($error['workout_exist']) ? $error['workout_exist'] : ''; ?>
                <?php echo isset($error['add_success']) ? $error['add_success'] : ''; ?>
                <?php echo isset($error['add_error']) ? $error['add_error'] : ''; ?>
                <?php echo isset($error['empty_error']) ? $error['empty_error'] : ''; ?>
                <?php echo isset($error['change_success']) ? $error['change_success'] : ''; ?>
                <?php echo isset($error['change_error']) ? $error['change_error'] : ''; ?>

                <?php if (isset($_GET['workout_id'])) { ?>

                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">id</label>
                        <div class="col">
                            <input type="number" class="form-control" name="workout_id" id="workout_id" value="<?php echo $_GET['workout_id'] ?>" readonly />
                        </div>
                    </div>
                <?php
                }
                ?>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col">
                        <input type="date" class="form-control" name="date" id="date" value="<?php echo (isset($_GET['date'])) ? $_GET['date'] : "" ?>" />
                        <?php echo isset($error['date_error']) ? $error['date_error'] : ''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Time</label>
                    <div class="col">
                        <input type="time" class="form-control" name="time" id="time" value="<?php echo (isset($_GET['time'])) ? $_GET['time'] : "" ?>" />
                        <?php echo isset($error['time_error']) ? $error['time_error'] : ''; ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Title</label>
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
                            <?php
                            foreach ($titles as $id => $title) {
                                $select = (isset($_GET['title']) && ($title == $_GET['title'])) ? "selected" : "";
                                echo "<option value=\"$id\" $select>$title</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Trainer</label>
                    
                    <div class="col">


                        <select id="trainer" class=form-control name="trainer" value="<?php echo (isset($_GET['trainer_name'])) ? $_GET['trainer_name'] : "" ?>">
                            
                           
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Free slots</label>
                    <div class="col">
                        <input type="text" class="form-control" name="free_slots" id="free_slots" value="<?php echo (isset($_GET['free_slots'])) ? $_GET['free_slots'] : "" ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col">
                        <?php $select = isset($_GET['status']) ? $_GET['status'] : "" ?>
                        <select id="status" class=form-control name="status" value="<?php echo (isset($_GET['status'])) ? $_GET['status'] : "" ?>">
                            <option value="Future" <?php echo (($select == "future") ? "selected" : "") ?>>Future</option>
                            <option value="Done" <?php echo (($select == "done") ? "selected" : "") ?>>Done</option>
                            <option value="Canceled" <?php echo (($select == "canceled") ? "selected" : "") ?>>Canceled</option>
                        </select>
                    </div>
                </div>


                <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lg btn-block">
                    <?php echo (isset($_GET['title'])) ? "Change" : "Add" ?>
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

<script type="text/javascript" src="trainer_select.js"></script>

<?php

$connect->close();
?>

<?php
include("../footer.php");
?>