<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Student Info</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/main.css">
</head>

<body class="w3-black">
    <div class="w3-padding-large" id="main">
        <div class="w3-container">
            <div class="w3-panel w3-padding-16 w3-black  w3-card">
                <h2>Student Info</h2>
                <form action="./main.php" method="POST">
                    <label>University Roll No.</label>
                    <input class="w3-input w3-border" type="number" placeholder="Student University Roll No..." min="0" id="uniRoll" name="uniRoll" required>
                    <button type="submit" class="w3-button w3-red w3-margin-top">Submit</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>