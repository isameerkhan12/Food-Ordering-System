<?php
if(!isset($_SESSION)) //IF SESSION IS NOT STARTED THEN START IT ELSE MOVEON I USED THIS TO AVOID RESTARTING OF DUPLICATE SESSION ERROR//
{ 
    session_start(); 
}
//TRUNCATE `food_ordering`.`order_details`
$db_connec=require 'C:/xampp/htdocs/food_ordering/other_files/_db_connect.php';//CONNECTING TO DB/
if($db_connec)
{
    $sql="TRUNCATE `food_ordering`.`order_details`";
    $empty=mysqli_query($conn,$sql);
}
session_unset();//UNSET SESSION VARIABLES//
session_destroy();//DESTROY SESSION//
header("location:/food_ordering/other_files/_login.php");
exit();
?>