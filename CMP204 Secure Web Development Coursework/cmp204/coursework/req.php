<!doctype html>

<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <title>Dundee Snails - Requirements</title>
    <link rel="icon" type="image/x-icon" href="./images/snail_small.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/script.js"></script>
</head>

<body>
    <?php include_once "includes/nav.php" ?>

    <h1 class="text-center m-4">CMP204 Requirements Page - Unit 2 Assessment</h1>

    <table id="reqTable" class="m-4">
        <thead>
            <tr>
                <th class="reqCol">Requirement</th>
                <th class="metCol">How did you meet this requirement?</th>
                <th class="fileCol">File name(s), line no.</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>HTML5, CSS, JavaScript has been contained within separate files.</td>
                <td>All HTML, CSS, and JavaScript are in their respective files. HTML is in the *.php files (except the processing pages), CSS is in style.css, and JavaScript is in script.js</td>
                <td>*.php, script.js, style.css</td>
            </tr>

            <tr>
                <td>Use of the Bootstrap framework providing a responsive layout.</td>
                <td>Responsive Bootstrap is used in almost all HTML styling, except some accessibility and miscellaneous rules.</td>
                <td>*.php: class=*</td>
            </tr>

            <tr>
                <td>Use of JavaScript to manipulate the DOM based on an event.</td>
                <td>JavaScript is used to manipulate the DOM in the <code>validatePassword()</code> function to display errors if the privacy policy has not been accepted or the password and confirm password do not match.</td>
                <td>register.php, script.js: 1-17</td>
            </tr>

            <tr>
                <td>Use of jQuery in conjunction with the DOM.</td>
                <td>jQuery is used to toggle the visibility of team member's descriptions in the teamMembers.php file when their respective rows are clicked.</td>
                <td>teamMembers.php, script.js: 90-96</td>
            </tr>

            <tr>
                <td>Use of AJAX (pure JavaScript i.e. without the use of a library).</td>
                <td>Pure JavaScript AJAX is used to send a POST request to the checkLoginStatus.php file and toggle the visibility of the 'Register', 'Login', and 'User Profile', 'Logout' <code>nav-link</code>s.</td>
                <td>script.js: 19-49</td>
            </tr>

            <tr>
                <td>Use of the jQuery AJAX function.</td>
                <td>The jQuery AJAX function is used in the <code>attendance()</code> function to send a POST request to either the addEventsAttended.php or deleteEventsAttended.php file and standard jQuery functions are used to toggle the buttons from 'Attend' to 'Unattend' along with their styling.</td>
                <td>userProfile.php, script.js: 51-88</td>
            </tr>

            <tr>
                <td>User login functionality (PHP/MySQL).</td>
                <td>User login functionality is implemented across many PHP files in conjuction with visual functions in JavaScript and the <code>users</code> MariaDB table.</td>
                <td>
                    login.php, checkLoginStatus.php, processLogin.php, register.php, processRegistration.php<br />
                    script.js: 1-49
                </td>
            </tr>

            <tr>
                <td>Ability to select (SELECT), add (INSERT), edit (UPDATE) and delete (DELETE) information from a database (PHP/MySQL).</td>
                <td>The SELECT operation is implemented in the checkEventsAttended.php processing file and the upcomingEvents.php file to display all events in the <code>events</code> MariaDB table that occur <b>after</b> the current date. The INSERT operation is implemented in the addEventsAttended.php processing file and in the userProfile.php file to add a record to the <code>eventsAttended</code> MariaDB table with the logged in user's email and the eventID stored in the 'Attend' button. The UPDATE operation is implemented in the editEventsAttended.php file. The DELETE operation is implemented in the deleteEventsAttended.php processing file and in the userProfile.php file to delete the record in the <code>eventsAttended</code> MariaDB table WHERE the current logged in user's email and the eventID stored in the 'Unattend' button.</td>
                <td>
                    checkEventsAttended.php, addEventsAttended.php, editEventsAttended.php, deleteEventsAttended.php<br />
                    script.js: 51-88
                </td>
            </tr>

            <tr>
                <td>Inclusion of GDPR.</td>
                <td>The GDPR privacy policy is implemented in the register.php page above the registration details.</td>
                <td>register.php: 21-33</td>
            </tr>

            <tr>
                <td>SQL queries written as prepared statements.</td>
                <td>All SQL queries using user input use prepared statements.</td>
                <td>addEventsAttended.php: 13-18, deleteEventsAttended.php: 13-18, editEventsAttended.php: 13-18</td>
            </tr>

            <tr>
                <td>Passwords should be salted and hashed.</td>
                <td>Passwords are salted and hashed in the processRegistration.php file using the built-in <code>password_hash($password, $alg)</code> function, and in the processLogin.php file using the built-in <code>password_verify($password, $hash)</code> function.</td>
                <td>processLogin.php: 18, processRegistration.php: 20</td>
            </tr>

            <tr>
                <td>User input should be sanitised.</td>
                <td>User inputted emails are sanitised and validated using the built-in <code>filter_var($var, $filter)</code> function with the built-in <code>FILTER_SANITIZE_EMAIL</code> and <code>FILTER_VALIDATE_EMAIL</code> filters.</td>
                <td>processLogin.php: 12-16, processRegistration.php: 12-16</td>
            </tr>
        </tbody>
    </table>

    <?php include_once "includes/footer.php" ?>

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Latest compiled Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>