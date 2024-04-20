<!doctype html>

<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <title>Dundee Snail - Register</title>
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

    <h1 class="text-center m-4">Register</h1>

    <div class="border border-2 d-flex flex-column gap-1 w-50 my-4 mx-auto py-4 align-items-center">
        <h3>Dundee Snails Privacy Policy</h3>
        <p>When you register on this page, we will store your email address.</p>
        <p>Your email will be stored in order to provide a User Profile page for you.</p>
        <p>Your email will be linked to events you click 'Attend' to.</p>
        <p>Your data will be kept indefinitely, unless you contact us to erase it.</p>
        <p>You can contact us <a href="mailto:2200905@uad.ac.uk">here</a> if you want to see or erase your data.</p>
        <div>
            I have read and accept the privacy policy:
            <input id="gdpr" type="checkbox" />
            <p id="gdpr-error" style="display:none">Please accept the privacy policy to register.</p>
        </div>
    </div>

    <form onsubmit="return validatePassword()" action="processRegistration.php" method="post" class="border border-2 rounded w-25 m-auto py-4 px-2 d-flex flex-column gap-1 align-items-center">
        <div>
            Email:
            <input type="text" name="email" /> <br />
        </div>

        <div>
            Password:
            <input id="password" type="password" name="password" /> <br />
        </div>

        <div>
            Confirm Password:
            <input id="confirm" type="password" />
        </div>
        <div>
            <input type="checkbox" class='show-pass'> Show Passwords
        </div>
        <p id="confirm-error" style="display:none;">Passwords do NOT match.</p>
        <input type="submit" />
        <?php display_error("register") ?>
    </form>

    <?php include_once "includes/footer.php" ?>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Latest compiled Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>


</body>

</html>