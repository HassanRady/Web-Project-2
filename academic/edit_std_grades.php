<?php include "../includes/functions.php"; ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit Student Marks</title>

    <link rel="stylesheet" href="css/table.css">

    <?php include "../includes/bootstrap_styles_start.php"; ?>


</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php
            include "../includes/prof_sidebar.php";
            $courseId = $_GET['course_id'];
            $semester = $_GET['sem_id'];
        ?>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">TITLE</a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto secondary-navigation">
                            <li class="nav-item active">
                                <a class="nav-link" href="discussion.php?<?php echo "course_id=" . $courseId . "&sem_id=" . $semester ?>">Discusssion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="assignment-hand-ins.php?<?php echo "course_id=" . $courseId . "&sem_id=" . $semester ?>">Assignments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Material.php?<?php echo "course_id=" . $courseId . "&sem_id=" . $semester ?>">Material</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="students_in_course.php?<?php echo "course_id=" . $courseId . "&sem_id=" . $semester ?>">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="std_grades.php?<?php echo "course_id=" . $courseId . "&sem_id=" . $semester ?>">Marks</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                <h3 class="font-weight-bold" style=" color:rgb(31,108,236);">
                    Course Grades
                </h3>
                <hr class="mb-4">
                <div class="container-fluid">
                    <div class="row table-container table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="color:rgb(31,108,236);">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Midterm</th>
                                    <th scope="col">Oral</th>
                                    <th scope="col">Practical</th>
                                    <th scope="col">Coursework</th>
                                    <th scope="col">Final</th>
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0,0.5);">
                                <?php 
                                    getRegisteredStudentsMarksForEdit($courseId, $semester);
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button class="btn btn-block btn-primary">Upload</button>
                </div>









                <!-- STOP HERE -->



            </div>
        </div>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
            integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
            crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
            integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
            crossorigin="anonymous"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
        <!-- Navbar -->
        <script type="text/javascript" src="rootJS.js"></script>

</body>

</html>