<?php
//1.create a database connection
//2.select db

require("constants.php");

$conn= mysqli_connect("localhost","root","","widget_corp");
if(!$conn){
	die("Database connection failed:".mysql_error()); // die means exit from connection
}	
?> 