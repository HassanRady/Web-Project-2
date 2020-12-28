<?php 
include "../includes/functions.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Registered Students</title>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <link rel="stylesheet" href="css/students_in_course.css">
    <?php include "../includes/bootstrap_styles_start.php"; ?>

</head>

<body>

<div class="wrapper">
    <!-- Sidebar  -->
    <?php
        include "../includes/prof_sidebar.php";
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
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="nav navbar-nav ml-auto secondary-navigation">
                          <li class="nav-item active">
                              <a class="nav-link" href="discussion.php?course_id=<?php echo $courseId ?>">Discusssion</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="assignment-hand-ins.php?course_id=<?php echo $courseId ?>">Assignments</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="material.php?course_id=<?php echo $courseId ?>">Material</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="students_in_course.php?course_id=<?php echo $courseId ?>">Students</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="std_grades.php?course_id=<?php echo $courseId ?>">Marks</a>
                          </li>
                      </ul>
                  </div>
            </div>
        </nav>
        <div class="page-body">
            <!-- START HERE -->
            <h3 class="font-weight-bold" style=" color:rgb(31,108,236);">
                Registered Students
            </h3>
            <hr class="mb-4">
            <div class="container-fluid">
                <div class="row table-container">
                    <table class="table">
                        <thead>
                            <tr style="color:rgb(31,108,236);">
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Level</th>
                                <th scope="col">Group</th>

                            </tr>
                        </thead>
                        <tbody style="color: rgb(0,0,0,0.5);">
                            <?php 
                                getRegisteredStudents($courseId);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- STOP HERE -->
        </div>
    </div>
</div>

<?php include "../includes/bootstrap_styles_end.php"; ?>
<!-- Navbar -->
<script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>