<?php

//end session

//redirect user to index.php
//header("Location: http://www.example.com/");
include_once "includes/helper.php";

session_start();
unset($_SESSION["email"]);
unset($_SESSION["error"]);
unset($_SESSION["query"]);
header("Location: index.php");
exit;
