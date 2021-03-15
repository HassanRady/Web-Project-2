<?php
ob_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>My Marks</title>

    <?php include "../includes/bootstrap_styles_start.php"; ?>
    <link rel="stylesheet" href="css/transcript.css">

    

</head>

<body>




    <div class="wrapper">
        <!-- Sidebar  -->
        <?php 
            include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "paths.php";
            include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "includes\\Student\\functions.php";


            include_once $student_sidebar_path;
            session_start();
            $std_id = $_SESSION['student_id'];
            $courseId = $_GET['course_id'];
        $semester = $_GET['sem_id'];

        ?>


        <!-- Page Content  -->
        <div id="content">

        <?php
        include_once $student_navbar_path;
        ?>

            <div class="page-body">
                <!-- START HERE -->

                <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">
                    Course Marks
                </h4>
                <hr class="mb-4">
                <div class="container-fluid">
                    <div class="row table-container">
                        <table class="table">
                            <thead>
                                <tr style="color:rgb(31,108,236);">
                                    <th scope="col">Midterm</th>
                                    <th scope="col">Oral</th>
                                    <th scope="col">Coursework</th>
                                    <th scope="col">Practical</th>
                                    <th scope="col">Final</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0,0.5);">
                            <?php
                                getStudentMarksForCourse($courseId, $std_id);
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br class="mb-4">


                <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">
                    Assignments
                </h4>
                <hr class="mb-4">
                <div class="container-fluid">
                    <div class="row table-container">
                        <table class="table">
                            <thead>
                                <tr style="color:rgb(31,108,236);">
                                    <th scope="col">Name</th>
                                    <th scope="col">Upload Date</th>
                                    <th scope="col">Mark</th>
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0,0.5);">


                                <?php
                                
                                getAssignments($std_id, $courseId);

                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
                <br class="mb-4">



                <!-- STOP HERE -->
            </div>


        </div>
    </div>

    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>