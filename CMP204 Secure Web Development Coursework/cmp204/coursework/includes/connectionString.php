<?php

/*
	Desc: Example connection string
	
	Author: Lynsay A. Shepherd
	
	Date: October 2023
	
*/

//connection details
$servername = "lochnagar.abertay.ac.uk";
$dbusername = "sql2200905";
$dbpassword = "nest brands void packs";
$dbname = "sql2200905";


$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
