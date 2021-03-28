<?php
if( isset($_SESSION['user_id']) && $_SESSION['trainer']!=1) {

$clientname = $_POST['user_id'];

   SELECT name INTO @name FROM users WHERE customerNumber > 103 LIMIT 1; 

   SELECT name FROM users WHERE name = name && user_id = $clientname LIMIT 1;


$query = $connect->query("SELECT name FROM users");

        
while($row=$query->fetch_array())
{
   echo "$row[name]";          
} 
}      
?> 


insert into html:
<h2 class="custom-txt-center custom-margin-bottom-2">ASIAKAS <span><?php include("./client_name.php");?></span></h2>  
?>
