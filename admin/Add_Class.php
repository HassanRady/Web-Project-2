<?php

include "../includes/functions.php";
global $conn;

?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Add Class</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../css/rootStyles.css">
        <!-- Scrollbar Custom CSS -->
        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
                integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
                crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
                integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
                crossorigin="anonymous"></script>

    </head>

<body>

<div class="wrapper">
    <!-- Sidebar  -->
    <?php
            include dirname(__FILE__, 2) . "\\includes\\admin_sidebar.php";
        ?>
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
            <form action="Add_Class.php" method="post">
                <div class="Container">
                    <?php
                    $courses = showAllCourses();
                    $venues = showALlVenues();
                     ?>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="courseName">Course Name</label>
                            <select class="form-control" name="courseName" >
                                <?php while($row = mysqli_fetch_assoc($courses)){
                                $courseName = $row['name'];


                                  echo "<option value='$courseName'>$courseName</option>";
                                }

                                ?>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="profName">Professor Name</label>
                            <input type="text" class="form-control" id="profName" name="prof_name">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="sTime">Start Time</label>
                            <input type="time" class="form-control" id="sTime" name="lec_sTime">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endtime">End Time</label>
                            <input type="time" class="form-control" id="endime" name="lec_eTime">
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="freq">Frequency</label>
                            <select class="form-control" name="freq">
                                <option value="even">Even</option>
                                <option value="odd">Odd</option>
                                <option value="all">All</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lecplace">Lecture Place</label>
                            <select class="form-control" name="lec_venue">
                                <?php while($row = mysqli_fetch_assoc($venues)){
                                    $venue_name= $row['name'];


                                    echo "<option value='$venue_name'>$venue_name</option>";}
                                    $venues->close();


                                ?>

                            </select>
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="TAName">TA Name</label>
                            <input type="text" class="form-control" id="TAName" name="ta_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="secplace">Section Place</label>
                            <select class="form-control" name="sec_place">

                                 <?php
                                 $venues = showALlVenues();
                                 while($row = mysqli_fetch_assoc($venues)){
                                    $venue_name= $row['name'];


                                    echo "<option value='$venue_name'>$venue_name</option>";}
                                    ?>


                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endtime">StartTime</label>
                            <input type="time" class="form-control" id="sectime" name="sec_sTime">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="endtime">End Time</label>
                            <input type="time" class="form-control" id="endime" name="sec_eTime">
                        </div>


                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">

                            <label for="lecDay">Lecture Day</label>
                            <input type="text" class="form-control" id="lecDay" name="lecture_day">
                        </div>
                        <div class="form-group col-md-6">

                            <label for="secDay">Section Day</label>
                            <input type="text" class="form-control" id="secDay" name="section_day">
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary  btn-lg btn-block">Submit</button>

                </div>
                <?php

                if(isset($_POST['submit'])){
                    $course_name = $_POST['courseName'];
                    $prof_name = $_POST['prof_name'];
                    $lec_sTime = $_POST['lec_sTime'];
                    $lec_eTime = $_POST['lec_eTime'];
                    $frequency = $_POST['freq'];
                    $lec_day = $_POST['lecture_day'];
                    $lec_place = $_POST['lec_venue'];
                    $ta_name = $_POST['ta_name'];
                    $sec_place = $_POST['sec_place'];
                    $sec_sTime = $_POST['sec_sTime'];
                    $sec_eTime = $_POST['sec_eTime'];
                    $sec_day = $_POST['section_day'];
                    $course_idQ = getCourseID($course_name);
                    $lecVen_idQ = getVenueID($lec_place);
                    $secVen_idQ = getVenueID($sec_place);
                    while ($row = mysqli_fetch_assoc($course_idQ)){
                        $course_id = $row['course_id'];
                    }
                    while ($row = mysqli_fetch_assoc($lecVen_idQ)){
                        $lec_ven = $row['venue_id'];
                    }
                    while ($row = mysqli_fetch_assoc($secVen_idQ)){
                        $sec_ven = $row['venue_id'];
                    }
$type = gettype($lec_sTime);
//
                    echo "<h1>$type</h1>";
                    echo "<h1>$lec_eTime</h1>";
                    addToClassTable($course_id,$lec_ven,$lec_sTime,$lec_eTime,$lec_day,"lecture",$frequency);
                    addToClassTable($course_id,$sec_ven,$sec_sTime,$sec_eTime,$sec_day,"section",$frequency);
                }

                ?>

            </form>



            <!---->


        </div>
    </div>
</div>

<?php


include "../includes/footer.php" ;


?>