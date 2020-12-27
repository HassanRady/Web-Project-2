<?php

include "../includes/SQLfunctions.php";
//stimulating a cookie session where course_id = 1 is level 1 general announcement and user_id is 1
$course_id = 1;
$user_id = 2;

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Announcements </title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
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
                <a href="announcements.html">Home</a>
            </li>
            <li>
                <a href="discussion.php">My Courses</a>
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
                            <a class="nav-link" href="add_announcements.php">Discussion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="assignment-hand-ins.html">Assignments</a>
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
            <h3 style="color: #206cef;">
                Announcements
            </h3>
            <hr class="mb-4">


            <div class="container discussion-form">
                <h5 class="">Start a new discussion:</h5>
                <form class="row" action="add_announcements.php" method="post">
                    <div class="col-lg-12">
                            <textarea class="w-100 p-3" id="exampleFormControlTextarea1"
                                      name="post_text"
                                      style="resize: none; height: 125px; border-radius: 8px;"
                                      placeholder="What are you thinking about?"></textarea>
                    </div>
                    <div class="btn-grp w-100">
                        <button type="submit" name="post_btn" class="btn btn-primary  btn-lg btn-block">Post</button>
                        <div class="col-lg-4">OR</div>
                        <a type="button" class="col-lg-4 btn btn-primary" data-toggle="modal"
                           data-target="#myModal" name="make_poll">Make Poll</a>
                    </div>
                </form>

                <?php
                if (isset($_POST['post_btn'])) {

                    if (!empty($_POST['post_text'])) {
                        // retrieving data from the form and adding customized data for professor
                        $id_user = $user_id;
                        $id_course = $course_id;
                        $post_title = "title";
                        $post_author = getUserName($id_user);
                        $post_user = "SA";
                        $post_date = date("Y-m-d");
                        $post_content = $_POST['post_text'];
                        $post_tags = $post_author;
                        addNewPost($id_user, $id_course, $post_title, $post_author, $post_user, $post_date, $post_content, $post_tags);

                    } else {
                        echo "<script>alert('Post cannot be empty')</script>";
                    }
                }


                ?>
            </div>

            <!-- MODAL -->

            <div class="modal" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title">

                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                              style=" height: 60px; position:relative;left:120px;"
                                              placeholder="Enter Topic here..."></textarea>

                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                                <textarea class="w-50 p-3" id="exampleFormControlTextarea1" rows="3"
                                          style=" height: 30px;"></textarea>

                            <textarea class="w-50 p-3" id="exampleFormControlTextarea1" rows="3"
                                      style=" height: 30px;position:relative;left:14px; "></textarea>

                            <a href="#"
                               style="text-decoration: none; color:blue; font-weight: bold; font-size: 40px; position:relative;left:20px;">+</a>

                        </div>
                        <div class="modal-footer">
                            <div class="container">
                                <div class="text-left">
                                    <div class="row ">
                                        <div class="form-group col-xs-3 ">
                                            <select class="form-control form-control-lg "
                                                    style="background-color: #206cef; color: white; cursor: pointer;">
                                                <option value="" disabled selected>Poll Length</option>
                                                <option>1 Day</option>
                                                <option>2 Days</option>
                                                <option>3 Days</option>
                                                <option>4 Days</option>
                                                <option>5 Days</option>
                                                <option>6 Days</option>
                                                <option>7 Days</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Post Poll</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- POSTS -->


            <?php
            //checking for delete button if clicked and delete the post
            if (isset($_POST['delete_post'])) {
                $post_id = $_POST['delete_post_id'];
                deletePost($post_id);
            }
            // retrieving post information
            $posts_result = getAllPosts($course_id);
            while ($row = mysqli_fetch_assoc($posts_result)) {
                $result_id_user = $row['id_user'];
                $result_post_id = $row['post_id'];
                $result_post_date = $row['post_date'];
                $result_post_author = $row['post_author'];
                $result_post_content = $row['post_content'];

                ?>
                <div class="container post">
                    <form action="add_announcements.php" method="post">
                        <?php echo " <h6><a href=''>$result_post_author</a></h6>" ?>

                        <?php
                        echo "<p> $result_post_content </p>";
                        //                    ?>
                        <?php
                        if ($result_id_user == $user_id) {
                            ?>
                            <input type="submit" name="delete_post" value="Delete post" class="btn btn-primary">
                            <input type="hidden" name="delete_post_id" value="<?php print $result_post_id; ?>"/>
                        <?php } ?>
                        <p class="text-center"><a
                                    href="../post.php?p_id=<?php echo $result_post_id; ?>&u_id=<?php echo $user_id; ?>">show
                                comments </a></p>
                        <?php
                        echo "<p class='date'>$result_post_date </p>";

                        ?>

                    </form>

                </div>
            <?php } ?>



            <!-- Radio -->


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

</body>

</html>