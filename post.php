<?php
include "includes/functions.php";
global $conn;

if (isset($_GET['p_id']) && isset($_GET['u_id'])) {
    $the_post_id = $_GET['p_id'];
    $the_user_id = $_GET['u_id'];
}


?>


    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>General Announcements</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
              integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4"
              crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="css/rootStyles.css">
        <link rel="stylesheet" href="student/css/dispost.css">
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
            <img src="media/logo.jpeg" alt="SIM-LOGO">
        </div>
        <p>Navigation</p>
        <ul class="list-unstyled components">
            <li>
                <a href="student/announcements.php">Home</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">Courses</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="student/my_courses_std.html">My Courses</a>
                    </li>
                    <li>
                        <a href="student/course_registration.html">All Courses</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="student/student_transcript.html">My Profile</a>
            </li>
            <li>
                <a href="student/timetable.html">Timetable</a>
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
                <a class="navbar-brand" id="page-title" href="#">Announcements</a>
                <div class="ml-auto"></div>

                <div class="collapse navbar-collapse" style="display:  !important;">
                </div>
            </div>
        </nav>


        <div class="page-body">
            <!-- START HERE -->


            <?php

            //getting the post information
            // triggering updating votes functions
            if (isset($_POST['upvote'])) {

                $post_id = $_POST['post_id'];
                $votes = $_POST['votes'];
                upVote($post_id, $the_user_id, $votes);
            }
            if (isset($_POST['downvote'])) {

                $post_id = $_POST['post_id'];
                $votes = $_POST['votes'];
                downVote($post_id, $the_user_id, $votes);
            }
            if (isset($_POST['redo'])) {
                $post_id = $_POST['post_id'];
                redoVote($post_id, $the_user_id);
            }
            $posts_result = getPost($the_post_id);
            while ($row = mysqli_fetch_assoc($posts_result)) {

                $result_post_date = $row['post_date'];
                $result_post_author = $row['post_author'];
                $result_post_content = $row['post_content'];
                $result_post_votes = $row['votes'];
                ?>
                <!--posts-->
                <div class="container post">
                    <form action="" method="post">
                        <h6><?php echo $result_post_author ?></h6>
                        <p>
                            <?php echo $result_post_content; ?>
                        </p>

                        <div class="row">
                            <?php
                            // if user hadn't voted on the post yet, show him/her the upvote, downvote buttons
                            if (!checkIfVoted($the_post_id, $the_user_id)) {
                                ?>
                                <div class="col">
                                    <button type="submit" name="upvote" value="upvote" class="btn btn-outline-primary"
                                            style=" background-color: rgba(31,108,236, 0.01); color: #000; border-color:rgba(31,108,236, 0.03) ; border-style: none;">
                                        <i class="fas fa-arrow-circle-up" style="color: rgb(31,108,236);"></i></button>
                                </div>
                                <div class="col">
                                    <div class="col"><p>Votes: <?php echo $result_post_votes; ?> </p></div>
                                </div>
                                <div class="col">
                                    <button type="submit" name="downvote" value="downvote"
                                            class="btn btn-outline-primary"
                                            style=" background-color: rgba(31,108,236, 0.01); color: #000; border-color:rgba(31,108,236, 0.03) ; border-style: none;">
                                        <i class="fas fa-arrow-circle-down" style="color: rgb(31,108,236);"></i>
                                    </button>
                                </div>
                            <?php }

                            else {
                                echo "<div class='col'><input type='submit' name='redo' value='redo' class='btn btn-primary'></div>";
                                echo "<div class='col'><p>Votes: $result_post_votes</p></div>";
                            }
                            ?>
                            
                            <input type="hidden" name="post_id" value="<?php print $the_post_id; ?>"/>
                            <input type="hidden" name="votes" value="<?php print $result_post_votes; ?>"/>
                        </div>

                        <p class="date"> <?php echo $result_post_date; ?> </p>
                    </form>
                </div>
            <?php } ?>

            <div class="line"></div>
            <hr>

            <div class=" container comment-section">

                <?php

                if (isset($_POST['create_comment'])) {

                    if (!empty($_POST['comment_content'])) {
                        // retrieving data from the form and adding customized data for professor
                        $id_post = $the_post_id;
                        $id_user = $the_user_id;
                        $comment_author = getUserName($the_user_id);
                        $comment_date = date("Y-m-d");
                        $comment_content = $_POST['comment_content'];
                        addNewComment($id_post, $id_user, $comment_author, $comment_content, $comment_date);
                    } else {
                        echo "<script>alert('Comment cannot be empty')</script>";
                    }
                }

                if (isset($_POST['delete_comment'])) {
                    $comment_id = $_POST['delete_comment_id'];
                    deleteComment($comment_id);
                }
                //getting all the comments
                $comments_results = getAllComments($the_post_id);
                while ($row = mysqli_fetch_assoc($comments_results)) {
                    $id_user = $row['id_user'];
                    $comment_id = $row['comment_id'];
                    $author = $row['comment_author'];
                    $content = $row['comment_content'];
                    $date = $row['comment_date'];
                    ?>
                    <!--  comments -->
                    <div class="comment">
                        <h6><?php echo $author; ?></h6>
                        <p><?php echo $content; ?></p>
                        <?php
                        //checking if the current user has posted a comment so if he did he can delete it
                        if ($id_user == $the_user_id ) {
                            ?>
                            <form action="post.php?p_id=<?php echo $the_post_id; ?>&&u_id=<?php echo $the_user_id; ?> "
                                  method="post" role="form">
                                <input type="submit"  value="Delete Comment" name="delete_comment" class="btn btn-primary">
                                <input type="hidden" name="delete_comment_id" value="<?php print $comment_id; ?>"/>
                            </form>
                            <?php
                        }
                        ?>

                        <p class="date"><?php echo $date; ?></p>
                    </div>
                    <div class="line"></div>
                    <hr>
                <?php } ?>


                <div class="add-comment">
                    <h4>Leave a Comment:</h4>
                                                    <!--  redirecting to the current page                   -->
                    <form action="post.php?p_id=<?php echo $the_post_id; ?>&&u_id=<?php echo $the_user_id; ?> "
                          method="post"
                          role="form">
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="2"></textarea>
                        </div>
                        <button type="submit" name="create_comment" class="btn btn-primary">Add Comment</button>
                    </form>
                </div>


            </div>


            <!-- STOP HERE -->
        </div>


    </div>
</div>

<?php
include "includes/footer.php";
?>