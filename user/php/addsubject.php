<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available.Please Login');</script>";
    echo "<script> window.location.replace('login.php')</script>";
}
if (isset($_POST["submit"])) {
    include_once("dbconnect.php");
    $subname = addslashes($_POST["subname"]);
    $subdescription = addslashes($_POST["description"]);
    $subprice = $_POST["subprice"];
    $tutorid = $_POST["tutorid"];
    $subsessions = $_POST["subsession"];
    $subrating = $_POST["subratings"];
    $sqlSubregister = "INSERT INTO `tbl_subjects`(`subject_name`, `subject_description`, `subject_price`, `tutor_id`, `subject_sessions`, `subject_rating`) 
    VALUES ('$subname','$subdescription','$subprice','$tutorid','$subsessions','$subrating')";
    try {

        $conn->exec($sqlSubregister);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('successfully registered!')</script>";
            echo "<script>window.location.replace('index.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('registration failed!')</script>";
        echo "<script>window.location.replace('reguser.php')</script>";
    }
}





function uploadImage($filename)
{
    $target_dir = "../assets/courses/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
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


    <title>HOME</title>


</head>

<body>
    <!--desktop mode navigation-->
    <div class="w3-bar w3-teal w3-hover-light-green w3-hover-text-pink" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-left">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Courses</a>
        <a href="Ttutor.php" class="w3-bar-item w3-button w3-hide-small w3-left">Tutor</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-hide-small w3-left">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-hide-small w3-left">Subscription</a>
        <a href="addsubject.php" class="w3-bar-item w3-button w3-hide-small w3-left">Add Subject</a>
        <a href="login.php" class="w3-bar-item w3-button w3-hide-small w3-left">Log out</a>
        <a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-hide-large w3-hide-medium" onclick="myFunction()">&#9776;</a>
    </div>
    <!--phone mode navigation-->
    <div id="idnavbar" class="w3-bar-block w3-teal w3-hover-light-green w3-hover-text-pink w3-hide w3-hide-large w3-hide-medium" style="position: fixed">
        <a href="index.php" class="w3-bar-item w3-button w3-center">Home</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Courses</a>
        <a href="Ttutor.php" class="w3-bar-item w3-button w3-center">Tutor</a>
        <a href="reguser.php" class="w3-bar-item w3-button w3-center">Register</a>
        <a href="#" class="w3-bar-item w3-button w3-center">Subscription</a>
        <a href="addsubject.php" class="w3-bar-item w3-button w3-center">Add Subject</a>
        <a href="login.php" class="w3-bar-item w3-button w3-center">Log out</a>
    </div>
    <header class="w3-header w3-container w3-black w3-padding-32 w3-center">
        <h1 class="w3-xxxxxlarge font-effect-shadow-multiple">My Tutor</h1>
        <h2 class="w3-text-teal" style="text-shadow:1px 1px 0 rgb(136, 199, 215)">invest in knowledge</h2>
    </header>
    <!--addpage contents-->


    <div>
        <div class="w3-content w3-padding-32">
            <form class="w3-card w3-padding" action="addsubject.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
                <div class="w3-container w3-teal">
                    <h3>New Subjects</h3>
                </div>
                <div class="w3-container w3-center">
                    <img class="w3-image w3-margin" src="../assets/courses/subjectpreview.jpg" style="height:100%;width:400px"><br>
                    <input type="file" name="fileToUpload" onchange="previewFile()">

                </div>
                <hr>

                <div class="w3-row">
                    <div class="w3-half" style="padding-right:4px">
                        <p>
                            <!--/*INSERT INTO `tbl_subjects`(`subject_id`, `subject_name`, `subject_description`, `subject_price`, `tutor_id`, `subject_sessions`, `subject_rating`)*/-->
                            <label><b>Subject Name</b></label>
                            <input class="w3-input w3-border w3-round" name="subname" type="text" required>
                        </p>
                    </div>
                    <div class="w3-half" style="padding-right:4px">
                        <p>
                            <label><b>Tutor Id</b></label>
                            <select class="w3-select w3-border w3-round" name="tutorid">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>

                            </select>
                        </p>
                    </div>
                </div>
                <p>
                    <label><b>Description</b></label>
                    <textarea class="w3-input w3-border w3-round" rows="4" width="100%" name="description" required></textarea>
                </p>
                <div class="w3-row">
                    <div class="w3-third" style="padding-right:4px">
                        <p>
                            <label><b>Sucject session</b></label>
                            <input class="w3-input w3-border w3-round" name="subsession" type="number" required>
                        </p>
                    </div>
                    <div class="w3-third" style="padding-right:4px">
                        <p>
                            <label><b>Subject Price</b></label>
                            <input class="w3-input w3-border w3-round" name="subprice" type="number" step="any" required>
                        </p>
                    </div>
                    <div class="w3-third">
                        <p>
                            <label><b>Subject ratings</b></label>
                            <input class="w3-input w3-border w3-round" name="subratings" type="text" maxlength="12" required>
                        </p>
                    </div>
                    <p>
                        <input class="w3-button w3-teal w3-round w3-block w3-border" type="submit" name="submit" value="Insert">
                    </p>
                </div>
            </form>
        </div>


    </div>




    <!--add page contents-->


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