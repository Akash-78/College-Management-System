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
    <link rel="stylesheet" href="../css/studentEntry.css">
    <title>Student</title>
    <?php
    include './config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uniRoll = $_POST['uniRoll'];
        $sql = mysqli_query($conn, "SELECT * from  sentry where roll_no=$uniRoll");
        if (mysqli_num_rows($sql) > 0) {
            $sql = mysqli_query($conn, "SELECT * from  leaved where uni_roll=$uniRoll");
            if (mysqli_num_rows($sql) > 0) {
                echo "<script>alert('Student Already Out')</script>";
            } else {
                $sql = "INSERT INTO `leaved` (`sno`, `uni_roll`, `out_time`) VALUES (NULL, $uniRoll,  current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Student Out')</script>";
                } else {
                    echo "Student Not added due to this error ---->" . mysqli_error($conn);
                }
            }
        } else {
            echo "<script>alert('Student not exist')</script>";
        }
    }
    if (isset($_GET['stu-delete'])) {
        $sno = $_GET['stu-delete'];
        $sql = "DELETE FROM `leaved` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
    }
    ?>
</head>

<body class="w3-black">
    <div class="w3-container">
        <div class="w3-panel w3-padding-16 w3-black  w3-card">
            <h2>Student In/Out</h2>
            <form action="./studentEntry.php" method="POST">
                <label>University Roll No.</label>
                <input class="w3-input w3-border" type="number" placeholder="Student University Roll No..." min="0" id="uniRoll" name="uniRoll" required>
                <button type="submit" class="w3-button w3-red w3-margin-top">Submit</button>
            </form>
        </div>
    </div>

    <div class="w3-container" style="margin-bottom: 40px;">
        <table>
            <tr>
                <th>S.No.</th>
                <th>University Roll No</th>
                <th>Out Time</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "select * from leaved";
            $result = mysqli_query($conn, $sql);
            $sno = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sno = $sno + 1;
                echo "<tr>
                <td>" . $sno . "</td>
                <td>" . $row['uni_roll'] . "</td>
                <td>" . $row['out_time'] . "</td>
                <td><button class='stu-delete w3-button w3-red '  id=" . $row['sno'] . ">IN</button></td>
            </tr>";
            }
            ?>
        </table>
    </div>
    <script>
        deletes = document.getElementsByClassName('stu-delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                sno = e.target.id;
                if (confirm("Are you sure you want to In this Student!")) {
                    console.log("yes");
                    console.log(sno);
                    window.location = `./studentEntry.php?stu-delete=${sno}`;
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>