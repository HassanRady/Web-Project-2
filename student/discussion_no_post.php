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

        <title>Course Discussion</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../css/rootStyles.css">
        <link rel="stylesheet" href="css/dispost.css">
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
                <a href="discussion_no_post.php">Home</a>
            </li>
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Users</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Students</a>
                    </li>
                    <li>
                        <a href="#">Professors</a>
                    </li>
                    <li>
                        <a href="#">Teaching Assistants</a>
                    </li>
                    <li>
                        <a href="#">Student Affairs</a>
                    </li>
                    <li>
                        <a href="#">Admins</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Courses</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">All Courses</a>
                    </li>
                    <li>
                        <a href="#">Open Courses</a>
                    </li>
                    <li>
                        <a href="#">My Courses</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">My Profile</a>
            </li>
            <li>
                <a href="#">Timetable</a>
            </li>
            <li>
                <a href="#">Venues</a>
            </li>
            <li>
                <a href="#">Other</a>
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
                <a class="navbar-brand" id="page-title" href="#">Dicussion</a>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto secondary-navigation">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">ITEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">ITEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">ITEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">ITEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">ITEM</a>
                        </li>
                    </ul>
                </div>
        </nav>


        <div class="page-body">
            <!-- START HERE -->


            <div class="line"></div>
            <?php
            $posts_result = getAllPosts();
            while ($row = mysqli_fetch_assoc($posts_result)) {
                $result_post_id = $row['post_id'];
                $result_post_date = $row['post_date'];
                $result_post_author = $row['post_author'];
                $result_post_content = $row['post_content'];
                ?>


                <div class="container post">
                    <h6><?php echo $result_post_author?></h6>
                    <p>
                        <?php echo $result_post_content; ?>
                    </p>
                    <p class="text-center"><a href="../post.php?p_id=<?php echo $result_post_id;?>">show comments </a></p>
                    <p class="date"> <?php echo $result_post_date;  ?> </p>
                </div>
            <?php }?>

            <hr>

                        <!-- a modal for comment section for each post         -->

            <div class="modal fade " tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="comment_section">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <p>text</p>
                    </div>
                </div>
            </div>






            <!-- Radio -->
            <p class="text-center">
                <strong>Your Vote</strong>
            </p>
            <div class="form-check mb-4">
                <input class="form-check-input" name="group1" type="radio" id="radio-179" value="option1" checked>
                <label class="form-check-label" for="radio-179">Very good</label>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100">25%
                    </div>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" name="group1" type="radio" id="radio-279" value="option2">
                <label class="form-check-label" for="radio-279">Good</label>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100">25%
                    </div>
                </div>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" name="group1" type="radio" id="radio-379" value="option3">
                <label class="form-check-label" for="radio-379">Mediocre</label>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100">25%
                    </div>
                </div>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" name="group1" type="radio" id="radio-479" value="option4">
                <label class="form-check-label" for="radio-479">Bad</label>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100">25%
                    </div>
                </div>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" name="group1" type="radio" id="radio-579" value="option5">
                <label class="form-check-label" for="radio-579">Very bad</label>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100">25%
                    </div>
                </div>
            </div>
            <!-- Radio -->

            <div class="modal-footer justify-content-center">
                <a type="button" class="btn btn-primary waves-effect waves-light">Send
                    <i class="fa fa-paper-plane ml-1"></i>
                </a>
                <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
            </div>
            <p class="date"> 11/11/2020 </p>
        </div>

        <!-- STOP HERE -->
    </div>


</div>
<?php


include "../includes/footer.php";


?>