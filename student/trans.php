<!DOCTYPE html>
<html>
<?php  include"../includes/functions.php";
include "../includes/Admin/callable_functions.php";
include "../includes/utils/variables.php";
include_once "../paths.php";
session_start();
$id=$_SESSION['id'];
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- Secondary stylesheet -->
    <link rel="stylesheet" href="css/transcript.css">
    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
            integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
            crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
            integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
            crossorigin="anonymous"></script>

</head>

<body>





    <!-- Sidebar  -->
<?php include $student_sidebar_path;?>

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
                            <a class="nav-link" href="student_transcript.html">Transcript</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../my_profile.php">My Profile</a>
                        </li>
                    </ul>
                </div>

        </nav>

        <div class="page-body">
            <!-- START HERE -->

            <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">
                Student Information
            </h4>
            <hr class="mb-4">
            <div class="container-fluid">
                <div class="row table-container">
                    <table class="table">
                        <thead>
                        <tr style="color:rgb(31,108,236);">
                            <th scope="col">Name</th>
                            <th scope="col">ID</th>
                            <th scope="col">Level</th>
                            <th scope="col">Group</th>
                            <th scope="col">CGPA</th>

                        </tr>
                        </thead>
                        <tbody style="color: rgb(0,0,0,0.5);">
                        <tr>
                            <?php grade_courses();
                            insert_cgpa($id);
                            ?>
                            <?php
                            $array=transcript_student_information($id);
echo"                            <td scope='row'>$array[0]</td>
                            <td scope='row'>1952445639</td>
                            <td>$array[1]</td>
                            <td>$array[2]</td>
                            <td>$array[3]</td> " ?>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br class="mb-4">


            <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">
                Transcript
            </h4>
            <hr class="mb-4">
            <div class="container-fluid">
          <?php transcript($id); ?>
            </div>
            <br class="mb-4">







            <!-- STOP HERE -->
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