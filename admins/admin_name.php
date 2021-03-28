<?php
$query = $connect->query("SELECT name FROM users");

        
while($row=$query->fetch_array())
{
   echo "$row[name]";        
}