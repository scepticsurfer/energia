<?php

session_start();

//if (!isset($_SESSION['user_id']) || $_SESSION['trainer'] == 1 ||$_SESSION['admin'] == 1 ) {
    // TODO: return 403 code
 //   die();
//}

include("../forms/db_connection.php");   
header('Content-Type: application/json');

$query_results=[];
$participant_id=$_SESSION['user_id'];
$date=$_GET['date'];
$time=$_GET['time'];
$title_id=$_GET['title_id'];
$trainer_id=$_GET['trainer_id'];
$free_slots=$_GET['free_slots'];
$workout_id=$_GET['workout_id'];

$query_insert="INSERT INTO workouts_registration(`date`,`time`,title_id,participant_id,trainer_id) 
                      VALUES ('$date','$time','$title_id','$participant_id','$trainer_id')";

$result_insert = $connect->query($query_insert);  
if (!$result_insert) {
    var_dump($query_insert);
    var_dump($connect->error);
    die;
}

$query_update="UPDATE workouts_timetable SET free_slots=free_slots-1 WHERE workout_id='$workout_id'";
$result_update = $connect->query($query_udate);
if (!$result_update) {
    var_dump($query_update);
    var_dump($connect->error);
    die;
}




echo json_encode($workouts);