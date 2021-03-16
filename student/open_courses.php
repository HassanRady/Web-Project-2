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
          <a class="navbar-brand" id="page-title" href="#">All Courses</a>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto secondary-navigation">
              <li class="nav-item active">
                <a class="nav-link" href="#">All Courses</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" href="my_courses_std.php">My Courses</a>
              </li>

            </ul>
          </div>
      </nav>


            <div class="page-body">
                <!-- START HERE -->
                <?php $enrolledHours = getEnrolledHours($studentId);?>

                <label>Total Hours: <?php echo $enrolledHours?></label>
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