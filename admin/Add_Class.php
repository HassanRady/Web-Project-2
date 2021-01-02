<?php

include "../includes/functions.php";
global $conn;

$courseId='';
if(isset($_GET['course_id'])){
    $courseId = $_GET['course_id'];
}else {
    header("Location: open_courses.php");
}


if(isset($_POST['submit'])){
    $type = $_POST['type'];
    $location = $_POST['location'];
    $instructorId = $_POST['instructor'];
    $start_time = $_POST['startTime'];
    $end_time = $_POST['endTime'];
    $frequency = $_POST['frequency'];
    $day = $_POST['day'];
    $group = $_POST['group'];
    
    addToClassTable($courseId, $instructorId, $location, $start_time, $end_time, $day, $type, $group, $frequency);
    header("Location: open_courses.php");
    
}


?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Add Class</title>

        <?php include "../includes/bootstrap_styles_start.php"; ?>
        <link rel="stylesheet" href="../css/rootStyles.css">
        
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
                <a class="navbar-brand" id="page-title" href="#">Add New Course</a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto secondary-navigation">


                    </ul>
                </div>
        </nav>


        <div class="page-body">
            <!--page body-->
                <?php
                $courses = showAllCourses();
                $venues = showAllVenues();
                ?>

<div class="row">
                    <div class="col-md-12 order-md-1 col-lg-12">
                        <h4 class="mb-3">Add New Class</h4>
                        <hr class="mb-4">
                        <form class="needs-validation" action='#' method='post' novalidate>
                            <div class="row">
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="type">Class Type</label>
                                    <select class="custom-select d-block w-100" name="type" id="type">
                                        <option value="lecture">Lecture</option>
                                        <option value="section">Section</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="instructor">Instructor</label>
                                    <select class="custom-select d-block w-100" name="instructor" id="instructor">
                                        <option value="">Choose...</option>
                                        <?php getInstructorList() ?>
                                    </select>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="location">Location</label>
                                    <select class="custom-select d-block w-100" name="location" id="location">
                                        <option value="">Choose...</option>
                                        <?php
                                            while($row = mysqli_fetch_assoc($venues)){
                                                $venue_name = $row['name'];
                                                $venue_id = $row['venue_id'];
                                                echo "<option value='$venue_id'>$venue_name</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="row">
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="startTime">Start Time</label>
                                    <input class="form-control" type="time" name="startTime" id="startTime">
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                <label for="endTime">End Time</label>
                                    <input class="form-control" type="time" name="endTime" id="endTime">
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="frequency">Frequency</label>
                                    <select class="custom-select d-block w-100" name="frequency" id="frequency">
                                        <option value="odd">Odd</option>
                                        <option value="even">Even</option>
                                        <option value="all">All</option>
                                    </select>
                                </div>                             
                            </div>
                            <hr class="mb-4">
                            <div class="row">
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="day">Day</label>
                                    <select class="custom-select d-block w-100" name="day" id="day">
                                        <option value="saturday">Saturday</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                    </select>
                                </div>
                                <div class="col-md-6 col-sm-12 mb-3">
                                    <label for="group">Group</label>
                                    <select class="custom-select d-block w-100" name="group" id="group">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="0">All</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="mb-4">
                            
                            

                            <button class="btn btn-primary btn-lg btn-block" type="submit" name='submit'>Add Class</button>
                        </form>
                        <br>
                    </div>
                </div>

            



            <!---->


        </div>
    </div>
</div>

<?php


include "../includes/footer.php" ;


?>