<?php
include "../includes/functions.php";
global $conn;
//stimulating a cookie session where course_id = 1 is level 1 general announcement and user_id is 1
$course_id = 1;
$user_id = 1;
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
                <a href="announcements.php">Home</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                   class="dropdown-toggle">Courses</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="my_courses_std.html">My Courses</a>
                    </li>
                    <li>
                        <a href="course_registration.html">All Courses</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="student_transcript.html">My Profile</a>
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
                <a class="navbar-brand" id="page-title" href="#">Announcements</a>
                <div class="ml-auto"></div>

                <div class="collapse navbar-collapse" style="display:  !important;">
                </div>
            </div>
        </nav>


        <div class="page-body">
            <!-- START HERE -->


            <!--
                  -->

            <?php
            $polls = getPolls();
            while($row = mysqli_fetch_assoc($polls)) {
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
                        while ($row = mysqli_fetch_assoc($poll_options)){
                            $option_id = $row['option_id'];
                            $option_content = $row['option_content'];
                            $option_votes = $row['votes'];
                            ?>
                            <div class="form-check mb-4">
                                <input class="form-check-input" name="option_id" type="radio" id="<?php echo $res_poll_id?>" value="<?php echo $option_id?>">
                                <label class="form-check-label" for="<?php echo $res_poll_id?>"><?php echo $option_content?></label>
                            </div>
                            <p>Votes: <?php echo $option_votes;?></p>

                        <?php   }


                        if(!checkIfVotedPoll($res_poll_id,$user_id)){
                            ?>
                            <div class=" container">
                                <input type="submit" name="poll_vote" value="Vote" class="btn btn-primary ">
                            </div>
                        <?php }
                        else{
                            ?>
                            <div class=" container">
                                <input type="submit" name="redo_vote" value="Redo" class="btn btn-primary ">
                            </div>
                        <?php } ?>
                        <div class="poll-data">
                            <input type="text" hidden name="poll_id" value="<?php echo $res_poll_id?>">

                        </div>
                        <p class="date"> <?php echo $res_poll_date ?> </p>
                    </div>
                </form>
            <?php }

            /// when user votes in polls
            if(isset($_POST['poll_vote'])){
                if(isset($_POST['option_id'])){
                    $option_id = $_POST['option_id'];
                    $poll_id = $_POST['poll_id'];
                    votePoll($user_id, $poll_id, $option_id );
                }
                else{
                    echo "<script>alert('Please select an option to vote')</script>";
                }
            }
            //redo vote
            if(isset($_POST['redo_vote'])){

                $poll_id = $_POST['poll_id'];
                redoVotePoll($user_id,$poll_id);
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
            $posts_result = getAllPosts($course_id);
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
                                <div class="col"><input type="submit" name="upvote" value="upvote"
                                                        class="btn btn-primary"></div>
                                <div class="col"><input type="submit" name="downvote" value="downvote"
                                                        class="btn btn-danger"></div>
                            <?php } else {
                                echo "<div class='col'><input type='submit' name='redo' value='redo' class='btn btn-primary'></div>";
                            }
                            ?>
                            <div class="col"><p>Votes: <?php echo $result_post_votes; ?> </p></div>
                            <input type="hidden" name="post_id" value="<?php print $result_post_id; ?>"/>
                            <input type="hidden" name="votes" value="<?php print $result_post_votes; ?>"/>
                        </div>
                        <p class="text-center"><a
                                    href="../post.php?p_id=<?php echo $result_post_id; ?>&u_id=<?php echo $user_id; ?>">show
                                comments </a></p>
                        <p class="date"> <?php echo $result_post_date; ?> </p>
                    </form>
                </div>
            <?php } ?>
            <div class="line"></div>


            <!--    <div class="container post">-->
            <!--        <h6>Prof.Abdallah Yassser Gaber</h6>-->
            <!--        <p>-->
            <!--            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut-->
            <!--            labore et dolore magna aliqua.-->
            <!--            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo-->
            <!--            consequat.-->
            <!--            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla-->
            <!--            pariatur.-->
            <!--            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim-->
            <!--            id est laborum.-->
            <!--        </p>-->
            <!--        <p class="date"> 11/11/2020 </p>-->
            <!--    </div>-->
            <!---->
            <!--    <div class="container post">-->
            <!--        <h6>Prof.Abdallah Yassser Gaber</h6>-->
            <!--        <p>-->
            <!--            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut-->
            <!--            labore et dolore magna aliqua.-->
            <!--        </p>-->
            <!---->
            <!--        <hr>-->

            <!-- Radio -->
            <!--        <p class="text-center"-->
            <!--           style="color: rgba(0,0,0,0.5) ; font-size: 18px ; margin-top: 5px ; margin-bottom: 10px">-->
            <!--            <strong>Your Vote</strong>-->
            <!--        </p>-->
            <!--        <div class="form-check mb-4">-->
            <!--            <input class="form-check-input" name="group1" type="radio" id="radio-179" value="option1"-->
            <!--                   checked>-->
            <!--            <label class="form-check-label" for="radio-179">Very good</label>-->
            <!--            <div class="progress" style="height: 20px;">-->
            <!--                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"-->
            <!--                     aria-valuemin="0" aria-valuemax="100">25%-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!---->
            <!--        <div class="form-check mb-4">-->
            <!--            <input class="form-check-input" name="group1" type="radio" id="radio-279" value="option2">-->
            <!--            <label class="form-check-label" for="radio-279">Good</label>-->
            <!--            <div class="progress" style="height: 20px;">-->
            <!--                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"-->
            <!--                     aria-valuemin="0" aria-valuemax="100">25%-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!---->
            <!--        <div class="form-check mb-4">-->
            <!--            <input class="form-check-input" name="group1" type="radio" id="radio-379" value="option3">-->
            <!--            <label class="form-check-label" for="radio-379">Mediocre</label>-->
            <!--            <div class="progress" style="height: 20px;">-->
            <!--                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"-->
            <!--                     aria-valuemin="0" aria-valuemax="100">25%-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="form-check mb-4">-->
            <!--            <input class="form-check-input" name="group1" type="radio" id="radio-479" value="option4">-->
            <!--            <label class="form-check-label" for="radio-479">Bad</label>-->
            <!--            <div class="progress" style="height: 20px;">-->
            <!--                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"-->
            <!--                     aria-valuemin="0" aria-valuemax="100">25%-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="form-check mb-4">-->
            <!--            <input class="form-check-input" name="group1" type="radio" id="radio-579" value="option5">-->
            <!--            <label class="form-check-label" for="radio-579">Very bad</label>-->
            <!--            <div class="progress" style="height: 20px;">-->
            <!--                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"-->
            <!--                     aria-valuemin="0" aria-valuemax="100">25%-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--         Radio -->
            <!---->
            <!--        <div class="modal-footer justify-content-center">-->
            <!--            <a type="button" class="btn btn-primary waves-effect waves-light">Send-->
            <!--                <i class="fa fa-paper-plane ml-1"></i>-->
            <!--            </a>-->
            <!--            <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>-->
            <!--        </div>-->
            <!--        <p class="date"> 11/11/2020 </p>-->
            <!--    </div>-->

            <!-- STOP HERE -->
        </div>


    </div>
</div>

<?php
include "../includes/footer.php";
?>