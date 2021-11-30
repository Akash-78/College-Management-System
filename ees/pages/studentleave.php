<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
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
    <title>Student Leave</title>
    <?php
    include './config.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $uniRoll = $_POST['rollleave'];
        $dateTo = $_POST['dateTo'];
        $dateFrom = $_POST['dateFrom'];
        $purpose = $_POST['purpose'];
        $place = $_POST['place'];
        $sql = mysqli_query($conn, "SELECT * from  sentry where roll_no=$uniRoll");
        if (mysqli_num_rows($sql) > 0) {
            $sql = mysqli_query($conn, "SELECT * from  slv where uni_roll=$uniRoll");
            if (mysqli_num_rows($sql) > 0) {
                echo "<script>alert('Student Already on Leave')</script>";
            } else {
                $sql = "INSERT INTO `slv` (`sno`, `uni_roll`, `lv_from`, `lv_to`, `lv_pur`, `lv_pla`) VALUES (NULL, $uniRoll, '$dateFrom', '$dateTo', '$purpose', '$place')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo "<script>alert('Leave Added')</script>";
                } else {
                    echo "Student Not added due to this error ---->" . mysqli_error($conn);
                }
            }
        } else {
            echo "<script>alert('Student Not Exist')</script>";
        }
    }
    if (isset($_GET['stu-out-delete'])) {
        $sno = $_GET['stu-out-delete'];
        $sql = "DELETE FROM `slv` WHERE `sno` = $sno";
        $result = mysqli_query($conn, $sql);
    }
    ?>
</head>

<body class="w3-black">

    <div class="w3-display-container w3-content" style="max-width:1500px;">
        <div class="w3-padding w3-col l6 m8">
            <div class="w3-container w3-black">
                <h2>Student Leave</h2>
            </div>
            <div class="w3-container w3-white w3-padding-16">
                <form action="./studentleave.php" method="POST">
                    <div class="w3-row-padding" style="margin:0 -16px;">
                        <div class="wr-half w3-margin-bottom" style="margin:0 8px;">
                            <label>University Roll No</label>
                            <input class="w3-input w3-border" type="number" placeholder="Student University Roll No..." min="0" name="rollleave" id="rollleave" required>
                        </div>
                    </div>
                    <div class="w3-row-padding" style="margin:0 -16px;">
                        <div class="w3-half w3-margin-bottom">
                            <label><i class="fa fa-calendar-o"></i> From</label>
                            <input class="w3-input w3-border" type="text" id="dateFrom" name="dateFrom" placeholder="DD MM YYYY" required>
                        </div>
                        <div class="w3-half">
                            <label><i class="fa fa-calendar-o"></i> To</label>
                            <input class="w3-input w3-border" type="text" id="dateTo" name="dateTo" placeholder="DD MM YYYY" required>
                        </div>
                    </div>
                    <div class="w3-row-padding" style="margin:8px -16px;">
                        <div class="w3-half w3-margin-bottom">
                            <label><i class="fa fa-eye"></i> Purpose</label>
                            <input class="w3-input w3-border" type="text" placeholder="Purpose" id="purpose" name="purpose">
                        </div>
                        <div class="w3-half w3-margin-bottom">
                            <label><i class="fa fa-eye"></i> Place</label>
                            <input class="w3-input w3-border" type="text" placeholder="Purpose" id="place" name="place">
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
                <th>S.No.</th>
                <th>University Roll No</th>
                <th>From</th>
                <th>To</th>
                <th>Purpose</th>
                <th>Place</th>
                <th>Action</th>
            </tr>
            <?php
            $sql = "select * from slv";
            $result = mysqli_query($conn, $sql);
            $sno = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $sno = $sno + 1;
                echo "<tr>
                <td>" . $sno . "</td>
                <td>" . $row['uni_roll'] . "</td>
                <td>" . $row['lv_from'] . "</td>
                <td>" . $row['lv_to'] . "</td>
                <td>" . $row['lv_pur'] . "</td>
                <td>" . $row['lv_pla'] . "</td>
                <td><button class='stu-out-delete w3-button w3-red'  id=" . $row['sno'] . ">OUT</button></td>
            </tr>";
            }
            ?>
        </table>
    </div>
    <script>
        deletes = document.getElementsByClassName('stu-out-delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                sno = e.target.id;
                if (confirm("Are you sure you want to remove this Student!")) {
                    console.log("yes");
                    console.log(sno);
                    window.location = `./studentleave.php?stu-out-delete=${sno}`;
                } else {
                    console.log("no");
                }
            })
        })
    </script>
</body>

</html>