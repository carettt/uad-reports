<!doctype html>

<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <title>Dundee Snails - Upcoming Events</title>
    <link rel="icon" type="image/x-icon" href="./images/snail_small.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/script.js"></script>
</head>

<body>
    <?php include_once "includes/nav.php" ?>

    <h1 class="text-center m-4">Upcoming Events</h1>
    <table class="m-auto w-75">
        <thead>
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once("includes/connectionString.php");

            $sql = "SELECT `eventName`, `eventCity`, `eventDate` FROM `events` WHERE eventDate > CURRENT_DATE";
            $events = $conn->query($sql);

            if (mysqli_num_rows($events)) {
                while ($row = mysqli_fetch_assoc($events)) {
                    echo "<tr>";
                    echo "\t<td>" . $row["eventName"] . "</td>";
                    echo "\t<td>" . $row["eventCity"] . "</td>";
                    echo "\t<td>" . $row["eventDate"] . "</td>";
                    echo "</tr>";
                }
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <?php include_once "includes/footer.php" ?>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Latest compiled Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>