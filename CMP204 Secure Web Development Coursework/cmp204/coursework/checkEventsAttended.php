<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("includes/connectionString.php");

    $sql = "SELECT `eventID` FROM `eventsAttended` WHERE email='" . $_SESSION["email"] . "'";
    $eventsAttended = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

    echo json_encode($eventsAttended);
}
