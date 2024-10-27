<?php
$server="localhost";
$user="root";
$pw="";
$db="db_miniproject";
$con=mysqli_connect($server,$user,$pw,$db);
if(!$con)
{
	echo"connection error";
}
?>