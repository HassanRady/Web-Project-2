<?php
ob_start();
include_once "../includes/functions.php";
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Open Courses</title>

    
    <?php include "../includes/bootstrap_styles_start.php"; ?>
    <link rel="stylesheet" href="css/available_courses.css">
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include_once "../includes/admin_sidebar.php"; ?>
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
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                
                <div class="card text-center">
                    <!-- <div class="card-header">
                        Featured
                    </div> -->
                    <div class="card-body">
                        <h5 class="card-title">Are you sure you want to delete "course name"</h5>
                        <p class="card-text">Proceeding with this action means that all of the course's data including students' grades and assignments will be permanently deleted. Are you sure you want to continue?</p>
                        <a href="#" class="btn btn-outline-secondary">Cancel</a>
                        <a href="#" class="btn btn-danger">Close Course</a>
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