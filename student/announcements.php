<?php
session_start();
global $conn;
//stimulating a cookie session where course_id = 1 is level 1 general announcement and user_id is 1
//general announcements
$semester_id = $_SESSION['semester_id'];
$course_id = 0;
$user_id = $_SESSION['id'];
$user_name = $_SESSION['first_name']." ".$_SESSION['middle_name'];
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>General Announcements </title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <link rel="stylesheet" href="css/dispost.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">


    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


</head>

<body>


    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include "../includes/utils/variables.php";
        include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "paths.php";

        session_start();
        $type = $_SESSION['type'];

        if ($type === $studentsType)
            include $student_sidebar_path;
        elseif ($type === $adminsType || $type == $sasType)
            include $admin_sidebar_path;
        else
            include $professor_sidebar_path; ?>


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

                    <div class="collapse navbar-collapse" style="display:important;">
                    </div>
                </div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->

                <?php
                $polls = getPolls($course_id, $semester_id);
                while ($row = mysqli_fetch_assoc($polls)) {
                    $res_poll_id = $row['poll_id'];
                    $poll_id_user = $row['id_user'];
                    $res_poll_content = $row['poll_content'];
                    $res_poll_date = $row['poll_date'];
                    $poll_author = getUserName($poll_id_user);
                ?>

                    <!-- POLLS -->
                    <form action="" method="post">
                        <div class="container post">
                            <h6>
                                <?php echo $poll_author; ?>
                            </h6>
                            <p>
                                <?php echo $res_poll_content; ?>
                            </p>
                            <hr>
                            <!-- Radio -->
                            <p class="text-center">
                                <strong>Your Vote</strong>
                            </p>
                            <?php
                            $poll_options = getPollOptions($res_poll_id);
                            while ($row = mysqli_fetch_assoc($poll_options)) {
                                $option_id = $row['option_id'];
                                $option_content = $row['option_content'];
                                $option_votes = $row['votes'];
                            ?>
                                <div class="form-check mb-4">
                                    <input class="form-check-input" name="option_id" type="radio" id="<?php echo $res_poll_id ?>" value="<?php echo $option_id ?>">
                                    <label class="form-check-label" for="<?php echo $res_poll_id ?>"><?php echo $option_content ?></label>
                                </div>
                                <p>Votes: <?php echo $option_votes; ?></p>

                            <?php }


                            if (!checkIfVotedPoll($res_poll_id, $user_id)) {
                            ?>
                                <div class=" container">
                                    <input type="submit" name="poll_vote" value="Vote" class="btn btn-primary ">
                                </div>
                            <?php } else {
                            ?>
                                <div class=" container">
                                    <input type="submit" name="redo_vote" value="Redo" class="btn btn-primary ">
                                </div>
                            <?php } ?>
                            <div class="poll-data">
                                <input type="text" hidden name="poll_id" value="<?php echo $res_poll_id ?>">

                            </div>
                            <p class="date"> <?php echo $res_poll_date ?> </p>
                        </div>
                    </form>
                <?php }

                /// when user votes in polls
                if (isset($_POST['poll_vote'])) {
                    if (isset($_POST['option_id'])) {
                        $option_id = $_POST['option_id'];
                        $poll_id = $_POST['poll_id'];
                        votePoll($user_id, $poll_id, $option_id);
                    } else {
                        echo "<script>alert('Please select an option to vote')</script>";
                    }
                }
                //redo vote
                if (isset($_POST['redo_vote'])) {

                    $poll_id = $_POST['poll_id'];
                    redoVotePoll($user_id, $poll_id);
                }

                ?>


                <?php


                // triggering updating votes functions
                if (isset($_POST['upvote'])) {

                    $post_id = $_POST['post_id'];
                    $votes = $_POST['votes'];
                    upVote($post_id, $user_id, $votes);
                }
                if (isset($_POST['downvote'])) {

                    $post_id = $_POST['post_id'];
                    $votes = $_POST['votes'];
                    downVote($post_id, $user_id, $votes);
                }
                if (isset($_POST['redo'])) {
                    $post_id = $_POST['post_id'];
                    redoVotePost($post_id, $user_id);
                }

                // retrieving post information
                $posts_result = getAllPosts($course_id, $semester_id);
                while ($row = mysqli_fetch_assoc($posts_result)) {
                    $result_post_id = $row['post_id'];
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
                                if (!checkIfVotedPost($result_post_id, $user_id)) {
                                ?>
                                    <div class="col"><input type="submit" name="upvote" value="upvote" class="btn btn-primary"></div>
                                    <div class="col"><input type="submit" name="downvote" value="downvote" class="btn btn-danger"></div>
                                <?php } else {
                                    echo "<div class='col'><input type='submit' name='redo' value='redo' class='btn btn-primary'></div>";
                                }
                                ?>
                                <div class="col">
                                    <p>Votes: <?php echo $result_post_votes; ?> </p>
                                </div>
                                <input type="hidden" name="post_id" value="<?php print $result_post_id; ?>" />
                                <input type="hidden" name="votes" value="<?php print $result_post_votes; ?>" />
                            </div>
                            <p class="text-center"><a href="../post.php?p_id=<?php echo $result_post_id; ?>&u_id=<?php echo $user_id; ?>">show
                                    comments </a></p>
                            <p class="date"> <?php echo $result_post_date; ?> </p>
                        </form>
                    </div>
                <?php } ?>
                <div class="line"></div>
            </div>


        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Navbar -->
    <script type="text/javascript" src="../js/rootJS.js"></script>
</body>

</html>