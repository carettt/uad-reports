<?php
function debug_log($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug: " . $output . "');</script>";
}

function display_error($type)
{
    session_start();
    if (isset($_SESSION["error"])) {
        $err = $_SESSION["error"];
        if ($_SESSION["query"] == $type) {
            echo "<p id='error'>$err</p>";
        }
    }
}
