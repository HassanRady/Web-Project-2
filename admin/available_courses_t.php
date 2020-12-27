<?php
ob_start();
include "../includes/functions.php";
session_start();
// $courseId = $_GET['course_id'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Available Courses</title>

    
    <?php include "../includes/bootstrap_styles_start.php"; ?>
    <link rel="stylesheet" href="css/available_courses.css">
    <link rel="stylesheet" href="css/table.css">

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include "../includes/admin_sidebar.php"; ?>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">Available Courses</a>
                    <div class="ml-auto"></div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                <div class="container-fluid">
                    <div class="row justify-content-end">
                        <a href="add_new_course.php" class=" btn btn-primary btn-block w-25">Add New</a>
                    </div>
                </div>
                <hr class="mb-4">
                <br>
                <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">University Courses</h4>
                <hr class="mb-4">
                <div class="table-container table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Type</th>
                        <th scope="col">Prerequisites</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        getAvailableUniCourses();
                      ?> 
                    </tbody>
                  </table>
                </div>


                <br>
                <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">Faculty Courses</h4>
                <hr class="mb-4">
                <div class="table-container table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Type</th>
                        <th scope="col">Prerequisites</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        getAvailableFacultyCourses();
                      ?> 
                    </tbody>
                  </table>
                </div>

                <br>
                <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">SIM Courses</h4>
                <hr class="mb-4">
                <div class="table-container table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Type</th>
                        <th scope="col">Prerequisites</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        getAvailableSIMCourses();
                      ?> 
                    </tbody>
                  </table>
                </div>

                <br>
                <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">Free Courses</h4>
                <hr class="mb-4">
                <div class="table-container table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Course Name</th>
                        <th scope="col">Credits</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        getAvailableFreeCourses();
                      ?> 
                    </tbody>
                  </table>
                </div>
                <br>
                
                


                

            </div>

        </div>


        <!-- </div> -->
    </div>


    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>
<?php ob_end_flush(); ?>