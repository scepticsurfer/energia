<?php

session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] == 0) {
    // TODO: return 403 code
    die();
}

include("../forms/db_connection.php");   
header('Content-Type: application/json');


$title_id=$_GET['title_id'];
$query="SELECT id, `name` FROM users WHERE trainer='1' ";
$result = $connect->query($query);
$trainers = [];
$trainers_workout=[];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        //$obj = (object) array('id'=>$row['id'],'name' =>$row["trainer_full_name"]);
        $obj = new stdClass();
        $obj->id = $row['id'];
        $obj->name = $row["name"];

        $trainers[] = $obj;      
    }
}
//echo json_encode($trainers);
$query_trainers="SELECT trainer_id FROM trainer_workout_title WHERE title_id=$title_id";
$result = $connect->query($query_trainers);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

       foreach($trainers as $trainer){
           if($trainer->id==$row['trainer_id']){
              $full_name=$trainer->name;
           }
       }
       if($full_name){
        $obj = new stdClass();
        $obj->id = $row['trainer_id']; 
        $obj->full_name=$full_name;
        $trainers_workout[]=$obj;
       }
      
    }
   
}

echo json_encode($trainers_workout);
