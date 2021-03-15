<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add Announcements </title>

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
        <?php
        include "../includes/utils/variables.php";
        include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "paths.php";
        include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "includes\\Admin\\all_types\\functions.php";


        session_start();
        $type = $_SESSION['type'];
        $semester_id = $_SESSION['semester_id'];

        if ($type === $studentsType)
            include $student_sidebar_path;
        elseif ($type === $adminsType || $type == $sasType)
            include $admin_sidebar_path;
        else
            include $professor_sidebar_path;
        //stimulating a cookie session where course_id = 1 is level 1 general announcement and user_id is 1
        $course_id = $_GET['course_id'];
        $user_id = $_SESSION['id'];
        $user_name = getUserName($user_id);
        ?>
        <!-- Page Content  -->
        <div id="content">

            <?php
            if ($type === $studentsType)
                include $student_navbar_path;
            elseif ($type == $adminsType || $type == $sasType) {
                if (isHeProfessorAndAdmin($user_id)){ 
                    include $professor_navbar_path;}
                else{
                    echo "<hr>";
                }
            } else
                include $professor_navbar_path;
            ?>


            <div class="page-body">
                <!-- START HERE -->
                <h3 style="color: #206cef;">
                    Announcements
                </h3>
                <hr class="mb-4">


                <div class="container discussion-form">
                    <h5 class="">Start a new discussion:</h5>
                    <form class="row" action="" method="post">
                        <div class="col-lg-12">
                            <textarea class="w-100 p-3" id="exampleFormControlTextarea1" name="post_text" style="resize: none; height: 125px; border-radius: 8px;" placeholder="What are you thinking about?"></textarea>
                        </div>
                        <div class="btn-grp w-100">
                            <button type="submit" name="post_btn" class="btn btn-primary  btn-lg btn-block">Post</button>
                            <div class="col-lg-4">OR</div>
                            <a type="button" class="col-lg-4 btn btn-primary" data-toggle="modal" data-target="#modalPoll" name="modalPoll">Make Poll</a>
                        </div>
                    </form>
                </div>


                <?php

                if (isset($_POST['post_btn'])) {

                    if (!empty($_POST['post_text'])) {
                        // retrieving data from the form and adding customized data for professor
                        $id_user = $user_id;
                        $id_course = $course_id;
                        $post_title = "title";
                        $post_author = $user_name;
                        $post_user = "SA";
                        $post_date = date("Y-m-d");
                        $post_content = $_POST['post_text'];
                        $post_tags = $post_author;
                        addNewPost($id_user, $semester_id, $id_course, $post_title, $post_author, $post_user, $post_date, $post_content, $post_tags);
                    } else {
                        echo "<script>alert('Post cannot be empty')</script>";
                    }
                }


                ?>
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
                            <?php if ($poll_id_user == $user_id) {
                            ?>
                                <input type="submit" name="delete_poll" value="Delete poll" class="btn btn-primary">
                            <?php } ?>
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
                            <?php }
                            ?>


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
                if (isset($_POST['delete_poll'])) {
                    $poll_id = $_POST['poll_id'];
                    deletePoll($poll_id);
                }

                ?>


                <!-- POSTS -->
                <?php
                //checking for delete button if clicked and delete the post
                if (isset($_POST['delete_post'])) {
                    $post_id = $_POST['delete_post_id'];
                    deletePost($post_id);
                }
                // retrieving post information
                $posts_result = getAllPosts($course_id, $semester_id);
                while ($row = mysqli_fetch_assoc($posts_result)) {
                    $result_id_user = $row['id_user'];
                    $result_post_id = $row['post_id'];
                    $result_post_date = $row['post_date'];
                    $result_post_author = $row['post_author'];
                    $result_post_content = $row['post_content'];

                ?>
                    <div class="container post">
                        <form action="" method="post">
                            <?php echo " <h6><a href=''>$result_post_author</a></h6>" ?>

                            <?php
                            echo "<p> $result_post_content </p>";
                            //                    
                            ?>
                            <?php
                            if ($result_id_user == $user_id) {
                            ?>
                                <input type="submit" name="delete_post" value="Delete post" class="btn btn-primary">
                                <input type="hidden" name="delete_post_id" value="<?php print $result_post_id; ?>" />
                            <?php } ?>
                            <p class="text-center"><a href="../post.php?course_id=<?php echo $course_id ?>&p_id=<?php echo $result_post_id; ?>&u_id=<?php echo $user_id; ?>">show
                                    comments </a></p>
                            <?php
                            echo "<p class='date'>$result_post_date </p>";

                            ?>

                        </form>

                    </div>
                <?php } ?>


                <!-- MODAL -->

                <!--Notes:
            - Ajax technology is needed in order to:
                          - adding more options without refreshing the whole page
                          - making the add poll button disabled untill all options input and poll content have data
              until using ajax the default option inputs are 3


            -->
                <!-- Modal: modalPoll -->
                <div class="modal fade right" id="modalPoll" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
                        <div class="modal-content">
                            <!--Header-->
                            <div class="modal-header">
                                <p class="heading lead">Poll Making
                                </p>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="white-text">×</span>
                                </button>
                            </div>

                            <!--Body-->
                            <form action="" method="post">
                                <div class="modal-body">
                                    <div class="text-center">
                                        <i class="fa fa-file-text-o fa-4x mb-3 animated rotateIn"></i>
                                        <p>
                                            <strong>Your students opinions matters !</strong>
                                        </p>
                                        <p>
                                            <strong>Tell the audience the news.</strong>
                                        </p>
                                    </div>
                                    <hr>
                                    <!-- Radio -->
                                    <p class="text-center">
                                        <strong>Your Suggestions</strong>
                                    </p>
                                    <div id="options-div">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">1</span>
                                            <input type="text" class="form-control" name="option-1">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">2</span>
                                            <input type="text" class="form-control" name="option-2">
                                        </div>
                                    </div>
                                    <div>
                                        <input type="text" hidden id="options-num" name="options-num" value="2">
                                    </div>
                                    <!-- PLUS BUTTON -->
                                    <button type="button" class="btn btn-outline-primary" id="plus-btn">+</button>
                                    <!-- Radio -->
                                    <p class="text-center">
                                        <strong>Poll Content</strong>
                                    </p>
                                    <!--Basic textarea-->
                                    <div class="md-form">
                                        <textarea type="text" name="poll-content" class="md-textarea form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <!--Footer-->
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" name="add-poll" class="btn btn-primary waves-effect waves-light">Add
                                        new poll
                                    </button>
                                    <button class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Modal: modalPoll -->
                <!-- Handling the poll form in the modal            -->
                <?php
                if (isset($_POST['add-poll'])) {
                    if (!empty($_POST['poll-content'])) {
                        $poll_content = $_POST['poll-content'];
                        $poll_date = date("Y-m-d");
                        $poll_id = addNewPoll($user_id, $semester_id, $course_id, $poll_content, $poll_date);


                        //poll_op_no will be changed in next sprint and will be flexible
                        $poll_options_no = 2;
                        if (isset($_POST['options-num'])) {
                            $poll_options_no = $_POST['options-num'];
                            echo "accessed";
                        } else {
                            echo "not acc";
                        }

                        for ($i = 1; $i <= $poll_options_no; $i++) {
                            $option_no = 'option-' . $i;
                            $option_content = $_POST[$option_no];
                            addPollOption($poll_id, $option_content);
                        }
                    } else {
                        echo "<script>alert('poll content cannot be empty')</script>";
                    }
                }
                ?>


                <!-- STOP HERE -->
            </div>


        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Navbar -->
    <script type="text/javascript" src="../js/rootJS.js"></script>
    <script>
        $(document).ready(function() {
            let optionsNum = 2;
            $("#plus-btn").click(function() {
                optionsNum++;
                $.ajax({
                    url: '',
                    type: 'post',
                    success: function() {
                        $("#options-div").append(`<div class="input-group mb-3">
                                        <span class="input-group-text">${optionsNum}</span>
                                        <input type="text" class="form-control" name="option-${optionsNum}">
                                    </div>`);
                        $("#options-num").val(optionsNum);

                    },
                    error: function(request, status, error) {
                        alert(status + " " + error);
                    }

                });
            })

        });
    </script>


</body>

</html>