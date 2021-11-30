<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel='stylesheet' href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/guestEntry.css">
    <title>Guest Entry</title>
    <?php
    include './config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $guestName = $_POST['guestName'];
        $guestPurpose = $_POST['guestPurpose'];
        $sql = "INSERT INTO `gentry` (`name`, `purpose`, `time`) VALUES ('$guestName', '$guestPurpose', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Guest Added";
        } else {
            echo "Guest Not added due to this error ---->" . mysqli_error($conn);
        }
    }
    if (isset($_GET['delete'])) {
        $sno = $_GET['delete'];
        $sql = "DELETE FROM `gentry` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
    }
    ?>
</head>

<body class="w3-black">
    <div class="w3-display-container w3-content" style="max-width:1500px;">
        <div class="w3-padding w3-col l6 m8">
            <div class="w3-container w3-black">
                <h2><i class="fa fa-bed w3-margin-right"></i>Guest Entry</h2>
            </div>
            <div class="w3-container w3-white w3-padding-16">
                <form action="./guestEntry.php" method="POST">
                    <div class="w3-row-padding" style="margin:0 -16px;">
                        <div class="w3-half w3-margin-bottom">
                            <label><i class="fa fa-male"></i> Name</label>
                            <input class="w3-input w3-border" type="text" placeholder="Name" id="guestName" name="guestName" required>
                        </div>
                        <div class="w3-half">
                            <label><i class="fa fa-child"></i> Purpose</label>
                            <input class="w3-input w3-border" type="text" placeholder="Purpose" id="guestPurpose" name="guestPurpose" required>
                        </div>
                    </div>
                    <button class="w3-button w3-dark-grey" type="submit">Submit </button>
                </form>
            </div>
        </div>
    </div>
    <div class="w3-container" style="margin-bottom: 40px;">
        <table>
            <tr>
                <th>S.NO.</th>
                <th>GUEST NAME</th>
                <th>PURPOSE</th>
                <th>ENTRY TIME</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "select * from gentry";
            $result = mysqli_query($conn, $sql);
            $sno = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sno = $sno + 1;
                echo "<tr>
                <td>" . $sno . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['purpose'] . "</td>
                <td>" . $row['time'] . "</td>
                <td><button class='delete w3-button  w3-red' id=" . $row['sno'] . ">OUT</button></td>
            </tr>";
            }
            ?>
        </table>
    </div>
    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                sno = e.target.id;
                if (confirm("Are you sure you want to remove this Guest!")) {
                    console.log("yes");
                    console.log(sno);
                    window.location = `./guestEntry.php?delete=${sno}`;
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>