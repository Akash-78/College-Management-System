<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/mycss.css">
</head>

<body>
    <nav class="w3-sidebar w3-bar-block w3-hide-small w3-small w3-center">
        <a href="./pages/studentEntry.php" target="main-content" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <p>STUDENT IN/OUT</p>
        </a>
        <a href="./pages/studentleave.php" target="main-content" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <p>STUDENT LEAVE</p>
        </a>
        <a href="./pages/maintest.php" target="main-content" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <p>STUDENT INFO</p>
        </a>
        <a href="pages/guestEntry.php" target="main-content" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <p>GUEST</p>
        </a>
        <a href="./logout.php" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <p>Log Out <?php echo "<p>" . $_SESSION['username'] . "<p>" ?></p>
        </a>
        <?php if ($_SESSION['username'] == "admin") {
            echo '<a href="./register.php" target="main-content" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <p>Add User</p>
        </a>';
        } ?>


    </nav>
    <div class="w3-bottom w3-hide-large w3-hide-medium" id="myNavbar">
        <div class="w3-bar w3-white w3-opacity w3-hover-opacity-off w3-center w3-small">
            <a href="./pages/studentEntry.php" target="main-content" class="w3-bar-item w3-button" style="width:25% !important">Student In/Out</a>
            <a href="./pages/studentleave.php" target="main-content" class="w3-bar-item w3-button" style="width:25% !important">Student LEAVE</a>
            <a href="./pages/maintest.php" class="w3-bar-item w3-button" style="width:25% !important">STUDENT
                INFO</a>
            <a href="./pages/guestEntry.php" class="w3-bar-item w3-button" style="width:25% !important">GUEST</a>
        </div>
    </div>
    <main>
        <iframe src="./welcome.html" frameborder="0" name="main-content"></iframe>
    </main>
</body>

</html>