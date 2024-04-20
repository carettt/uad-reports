<?php

//SQL query to update event in database

//redirect user back to profile
//header("Location: http://www.example.com/");

include_once("includes/helper.php");
session_start();
unset($_SESSION["error"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("includes/connectionString.php");

    $stmt = $conn->prepare("UPDATE `eventsAttended` SET WHERE email=? AND eventID=?");
    $stmt->bind_param("si", $_SESSION["email"], $_POST["eventID"]);

    if ($stmt->execute()) {
        header("Location: userProfile.php");
        exit;
    } else {
        $_SESSION["error"] = "Error updating event attendance ! Please try again.";
        header("Location: userProfile.php");
        $_SESSION["query"] = "events";
        exit;
    }
}

$stmt->close();
$conn->close();
