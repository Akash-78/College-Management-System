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
    <?php
    include './config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uniRoll = $_POST['uniRoll'];
        $sql = "select * from sentry where roll_no=$uniRoll";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "Student Not Found ---->" . mysqli_error($conn);
        }
    }
    ?>
</head>

<body class="w3-black">
    <nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
        <img src="https://glauniversity.in:8103/<?php echo $row['roll_no']; ?>.jpg" style="width:100%">
        <a href="#" class="w3-bar-item w3-button w3-padding-large w3-black">
            <i class="fa fa-home w3-xxlarge"></i>
            <p>HOME</p>
        </a>
        <a href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-user w3-xxlarge"></i>
            <p>ABOUT</p>
        </a>
        <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-envelope w3-xxlarge"></i>
            <p>CONTACT</p>
        </a>
    </nav>

    <div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
        <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
            <a href="#" class="w3-bar-item w3-button" style="width:33% !important">HOME</a>
            <a href="#about" class="w3-bar-item w3-button" style="width:33% !important">ABOUT</a>
            <a href="#contact" class="w3-bar-item w3-button" style="width:33% !important">CONTACT</a>
        </div>
    </div>

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

        <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
            <img src="https://glauniversity.in:8103/<?php echo $row['roll_no']; ?>.jpg" alt="image" class="w3-image" width="402" height="450">
            <h1 class="w3-jumbo"><?php echo $row['name']; ?></h1>
            <h1 class="w3-hide-small"><?php echo $row['roll_no'];
                                        ?></h1>
            <p><?php echo $row['course'];
                ?></p>
        </header>
        <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
            <h3 class="w3-padding-24 w3-text-light-grey">About</h3>
            <p><span class="w3-large w3-text-white w3-margin-right">Name:</span><?php echo $row['name'];
                                                                                ?></p>
            <p><span class="w3-large w3-text-white w3-margin-right">University Roll No:</span><?php echo $row['roll_no'];
                                                                                                ?></p>
            <p><span class="w3-large w3-text-white w3-margin-right">Course:</span><?php echo $row['course'];
                                                                                    ?></p>
            <p><span class="w3-large w3-text-white w3-margin-right">Year:</span><?php echo $row['year'];
                                                                                ?></p>
            </p>
        </div>

        <div class="w3-padding-64 w3-content w3-text-grey" id="contact">
            <h2 class="w3-text-light-grey">Contacts</h2>
            <hr style="width:200px" class="w3-opacity">

            <div class="w3-section">
                <p><i class="fa fa-map-marker fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> <?php echo $row['addr'];
                                                                                                    ?>
                </p>
                <p><i class="fa fa-phone fa-fw w3-text-white w3-xxlarge w3-margin-right"></i> Phone: +91 <?php echo $row['mobile'];
                                                                                                            ?></p>
                <p><i class="fa fa-envelope fa-fw w3-text-white w3-xxlarge w3-margin-right"> </i> Email: <?php echo $row['email'];
                                                                                                            ?>
                </p>
            </div><br>
        </div>
        <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
            <p class="w3-medium">Powered by <a href="#" target="_blank" class="w3-hover-text-green">KayaD</a></p>
        </footer>
    </div>

</body>

</html>