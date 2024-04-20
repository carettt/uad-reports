<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo isset($_SESSION["email"]);
}
