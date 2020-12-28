<!DOCTYPE html>
<html>
<?php
include "../includes/functions.php";
$id=$_GET['id'];
$id_course=$_GET['courseid'];
$semester=$_GET['semester'];
if(isset($_POST['update'])){

    edit_prof_assignment($id);
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>DOCTOR ASSIGNMENT 1</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <link rel="stylesheet" href="prof-assmt.css">
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
    <nav id="sidebar">
        <div class="sidebar-header">
            <img src="../media/logo.jpeg" alt="SIM-LOGO">
        </div>
        <p>Navigation</p>
        <ul class="list-unstyled components">
            <li>
                <a href="announcements.html">Home</a>
            </li>
            <li>
                <a href="my_courses_prof_ta.html">My Courses</a>
            </li>
            <li>
                <a href="../my_profile.html">My Profile</a>
            </li>
            <li>
                <a href="timetable.html">Timetable</a>
            </li>
        </ul>

        <ul class="list-unstyled CTAs">
            <li>
                <a href="#" class="cta-logout" id="logout-btn">Logout</a>
            </li>
        </ul>
    </nav>
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
                            <a class="nav-link" href="discussion.html">Discusssion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="assignment-hand-ins.php">Assignments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Material.html">Material</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="students_in_course.html">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="std_grades.html">Marks</a>
                        </li>
                    </ul>
                </div>
        </nav>




        <div class="page-body">
            <!-- START HERE -->
<?php
edit_prof_assignment_show($id,$id_course,$semester);

?>
            <!-- STOP HERE -->

        </div>


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
<script type="text/javascript" src="../js/rootJS.js"></script>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
</body>

</html>