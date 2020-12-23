<?php include "../includes/functions.php"; ?>

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
            include "../includes/std_sidebar.php";
            $std_id = $_GET['std_id'];
            $semester = $_GET['sem_id'];
            $courseId = $_GET['course_id'];
        ?>


        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">Web Programming</a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto secondary-navigation">
                            <li class="nav-item active">
                                <a class="nav-link" href="discussion.html">Discussion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="student_assignments.html">Assignments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Material.html">Material</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="my_marks_std.html">Marks</a>
                            </li>
                        </ul>
                    </div>
            </nav>

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
                                getStudentMarksForCourse($courseId, $std_id, $semester);
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
                                <tr>
                                    <td>Web Assmt 1</td>
                                    <td>1/1/2021</td>
                                    <td>10</td>
                                </tr>
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