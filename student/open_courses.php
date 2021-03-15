<?php
ob_start();
include_once dirname(__FILE__, 2) . "\\paths.php";
include_once dirname(__FILE__, 2) . "\\includes\\Student\\functions.php";
session_start();
$studentId = $_SESSION['student_id'];
if (isset($_POST['submit'])) {
    $course_id = $_POST['course_id'];
    enrollToCourse($studentId, $course_id);
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Open Courses</title>


    <?php include_once "../includes/bootstrap_styles_start.php"; ?>
    <link rel="stylesheet" href="css/available_courses.css">
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include_once $student_sidebar_path; ?>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">Open Courses</a>
                    <div class="ml-auto"></div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                <?php $enrolledHours = getEnrolledHours($studentId);?>

                <div class="container"> <label class="float-right">Total Hours: <?php echo $enrolledHours?></label> </div>
                <br>
                <hr>

                <?php

                getOpenCoursesForStudents($studentId);
                ?>

            </div>

        </div>


        <!-- </div> -->
    </div>


    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>