<?php
include_once("includes/helper.php");
session_start();
unset($_SESSION["error"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("includes/connectionString.php");

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Error creating account ! Invalid email ! Please try again.";
        $_SESSION["query"] = "register";
        header("Location: register.php");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users(email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, password_hash($password, PASSWORD_DEFAULT));

    if ($stmt->execute()) {
        $_SESSION["email"] = $email;
        header("Location: userProfile.php");
        exit;
    } else {
        $_SESSION["error"] = "Error creating account ! Account with that email already exists ! Please try again.";
        $_SESSION["query"] = "register";
        header("Location: register.php");
        exit;
    }
}

$stmt->close();
$conn->close();
