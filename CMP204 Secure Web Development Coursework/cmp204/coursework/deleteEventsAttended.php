<?php

//SQL query to delete event from database

//redirect user back to profile
//header("Location: http://www.example.com/");

include_once("includes/helper.php");
session_start();
unset($_SESSION["error"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("includes/connectionString.php");

    $stmt = $conn->prepare("DELETE FROM `eventsAttended` WHERE email=? AND eventID=?");
    $stmt->bind_param("si", $_SESSION["email"], $_POST["eventID"]);

    if ($stmt->execute()) {
        header("Location: userProfile.php");
        exit;
    } else {
        $_SESSION["error"] = "Error removing event attendance ! Please try again.";
        $_SESSION["query"] = "events";
        header("Location: userProfile.php");
        exit;
    }
}

$stmt->close();
$conn->close();
