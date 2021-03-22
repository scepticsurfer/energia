<?php
include("../navigation.php");
$env = parse_ini_file('../.env');
//if (isset($_SESSION['loggedIn'])) {
//echo 'This is administrator page';
//}
?>

<?php

$query = "SELECT workout_id, `date`, `time`,title,`name`,free_slots, `status` FROM workouts_timetable LEFT JOIN workout_titles
         ON workouts_timetable.title_id=workout_titles.id 
         LEFT JOIN users ON workouts_timetable.trainer_id=users.id";
$result = $connect->query($query);
if ($result->num_rows > 0) { ?>
    <div class="container">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="d-none">id
                        <td>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Title</th>
                        <th scope="col">Trainer</th>
                        <th scope="col">Free slots</th>
                        <th scope="col">Status</th>
                        <th scope="col">Button</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="d-none"><?= $row['workout_id'] ?>
                            <td>
                            <td><?= $row['date'] ?></td>
                            <td><?= $row['time'] ?></td>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['free_slots'] ?></td>
                            <td><?= $row['status'] ?></td>
                            <td>
                                <a href="http://<?= $env['domain'] ?>/<?= $env['app_dir'] ?>/admins/new_change_workout.php?
                                     workout_id=<?= $row['workout_id'] ?>&date=<?= $row['date'] ?>&time=<?= $row['time'] ?>&
                                     title=<?= $row['title'] ?>&trainer_name=<?= $row['name'] ?>&
                                     free_slots=<?= $row['free_slots'] ?>&status=<?= $row['status'] ?>" class="btn btn-warning">Change
                                </a>
                            </td>
                        </tr>

                    <?php
                    }

                    ?>
                <tbody>
            </table>
        </div>
    </div>
<?php
}




include("../footer.php");
?>