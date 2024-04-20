<!doctype html>

<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <title>Dundee Snails - Login</title>
    <link rel="icon" type="image/x-icon" href="./images/snail_small.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/script.js"></script>
</head>

<body>
    <?php
    include_once "includes/nav.php";
    include_once "includes/helper.php";
    ?>

    <h1 class="text-center m-4">Login</h1>

    <form action="processLogin.php" method="post" class="border border-2 rounded w-25 m-auto py-4 px-2 d-flex flex-column gap-1 align-items-center">
        <div>
            Email:
            <input type="text" name="email" /> <br />
        </div>

        <div>
            Password:
            <input type="password" name="password" />
            <input type="checkbox" class='show-pass'> Show Password
        </div>
        <div>
            <input type="submit" /> <?php display_error("login") ?>
        </div>
    </form>

    <?php include_once "includes/footer.php" ?>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Latest compiled Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>