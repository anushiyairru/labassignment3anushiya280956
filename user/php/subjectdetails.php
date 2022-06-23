<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available.Please Login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
include_once("dbconnect.php");

if (isset($_GET['prid'])) {
    $prid = $_GET['prid'];
    $sqlcourses = "SELECT * FROM tbl_subjects WHERE subject_id = '$prid'";
    $stmt = $conn->prepare($sqlcourses);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Product not found.');</script>";
        echo "<script> window.location.replace('index.php')</script>";
    }
} else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('index.php')</script>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="../scripts/menu.js" defer></script>
    <script src="../scripts/img.js" defer></script>
    <script src="../scripts/reg.js" defer></script>
    <link rel="stylesheet" href="../css/subject.css">


    <title>Subject Details</title>


</head>

<body>
    <!--desktop mode navigation-->

    <!--phone mode navigation-->

    <header class="w3-header w3-container w3-black w3-padding-32 w3-center">
        <h1 class="w3-xxxxxlarge font-effect-shadow-multiple">My Tutor</h1>
        <h2 class="w3-text-teal" style="text-shadow:1px 1px 0 rgb(136, 199, 215)">invest in knowledge</h2>
    </header>
    <!--home page contents-->
    <div class="w3-container">
        <div class="w3-bar w3-teal">
            <a href="index.php" class="w3-bar-item w3-button w3-right">Back</a>
        </div>
        <h3>Subject Details</h3>
    </div>
    <div>
        <?php



        foreach ($rows as $courses) {
            $$prid = $courses['subject_id'];
            $subname = $courses['subject_name'];
            $subdescription = $courses['subject_description'];
            $subprice  = $courses['subject_price'];
            $tutorid = $courses['tutor_id'];
            $subsessions = $courses['subject_sessions'];
            $subrating = $courses['subject_rating'];
        }
        echo "<div class='w3-padding w3-center'><img class='w3-image resimg' src=../assets/courses/$prid.png" .
            " onerror=this.onerror=null;this.src='../../assets/courses/subjectpreview.jpg'"
            . " ></div><hr>";
        echo "<div class='w3-container w3-padding-large'><h4><b>$subname</b></h4>";
        echo " <div><p><b>Description</b><br>$subdescription</p><p><b>Session:</b> $subsessions</p><p><b>Price:</b>RM $subprice</p><p><b>Ratings:</b> $subrating</p>
        <form action='productdetails.php' method='post'> 
            <input type='hidden'  name='prid' value='$prid'>
            <input class='w3-button w3-teal w3-round' type='submit' name='submit' value='Join'>
        </form>
        </div></div>";


        ?>
    </div>








    <!--home page contents-->


    <footer class="w3-container w3-black w3-hover-teal w3-center w3-margin-top">
        <p>Stay conected with me!</p>
        <a href="https://www.facebook.com/anu.hikari" class="fa fa-facebook-official w3-hover-pink"></a>
        <a href="https://youtube.com/channel/UCXREH-_X8f_3lJ6yz4e2y6A" class="fa fa-youtube-play w3-hover-pink"></a>
        <a href="https://pin.it/3YY5aq0" class="fa fa-pinterest-p w3-hover-pink"></a>
        <p>

        </p>
    </footer>
</body>

</html>