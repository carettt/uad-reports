<?php
include_once("includes/helper.php");
session_start();
unset($_SESSION["error"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once("includes/connectionString.php");

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (!filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "Invalid email !";
        $_SESSION["query"] = "login";
        header("Location: login.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT email, password FROM `users` WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) > 0) {
        if (password_verify($password, mysqli_fetch_assoc($result)["password"])) {
            $_SESSION["email"] = $email;
            header("Location: userProfile.php");
            exit;
        } else {
            $_SESSION["error"] = "Incorrect username or password !";
            $_SESSION["query"] = "login";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION["error"] = "Incorrect username or password !";
        $_SESSION["query"] = "login";
        header("Location: login.php");
        exit;
    }
}

$stmt->close();
$conn->close();
