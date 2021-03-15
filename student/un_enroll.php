<?php
ob_start();
include_once "..\\paths.php";
include_once "..\\includes\\Student\\functions.php";

session_start();
$studentId = $_SESSION['student_id'];

if (isset($_POST['submit'])) {
$courseId = $_POST['course_id'];
    unEnrollFromCourse($studentId, $courseId);
}

$courseName = $_POST['course_name'];
$courseId = $_POST['course_id'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>My Courses</title>


    <?php include "../includes/bootstrap_styles_start.php"; ?>
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
                </div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->

                <div class="card text-center">
                    <!-- <div class="card-header">
                        Featured
                    </div> -->
                    <div class="card-body">
                        <h5 class="card-title">Are you sure you want to un-enroll from "<?php echo $courseName ?>"?</h5>
                        <form action="" method="post">
                            <a href="my_courses_std.php" class="btn btn-outline-secondary">Go Back</a>
                            <button type="submit" name="submit" class="btn btn-danger">Un-Enroll</button>
                            <input type="hidden" name="course_id" value="<?php echo $courseId?>"/>
                        </form>

                    </div>
                    <!-- <div class="card-footer text-muted">
                        2 days ago
                    </div> -->
                </div>

                <!-- END HERE -->
            </div>

        </div>


        <!-- </div> -->
    </div>


    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>