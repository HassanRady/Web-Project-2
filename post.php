<?php
ob_start();

include "includes/functions.php";
global $conn;
session_start();
$the_post_id = 0;
$the_user_id = 0;
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $the_user_id = $_SESSION['id'];
    $course_id = $_SESSION['course_id'];
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
    <?php
    include_once "includes/utils/variables.php";
    include_once dirname(__FILE__, 1) . DIRECTORY_SEPARATOR . "paths.php";

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

        <?php
        if ($type === $studentsType)
            include $student_navbar_path;
        else
            include $professor_navbar_path;
        ?>

        <div class="page-body">
            <!-- START HERE -->


            <?php

            //getting the post information
            // triggering updating votes functions
            if (isset($_POST['upvote'])) {

                $post_id = $_POST['post_id'];
                $votes = $_POST['votes'];
                upVote($post_id, $the_user_id, $votes);
                header('Location: post.php?p_id=' . $post_id);
            }
            if (isset($_POST['downvote'])) {

                $post_id = $_POST['post_id'];
                $votes = $_POST['votes'];
                downVote($post_id, $the_user_id, $votes);
                header('Location: post.php?p_id=' . $post_id);
            }
            if (isset($_POST['redo'])) {
                $post_id = $_POST['post_id'];
                redoVotePost($post_id, $the_user_id);
                header('Location: post.php?p_id=' . $post_id);
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
                            if (!checkIfVotedPost($the_post_id, $the_user_id)) {
                            ?>
                            <button type="submit" class="btn btn-outline-primary"
                                    style=" background-color: rgb(31,108,236, 0.01); color: #000; border-color:rgb(31,108,236, 0.03) ; border-style: none;"
                                    name="upvote">
                                <i class="fas fa-arrow-circle-up" style="color: rgb(31,108,236);"></i></button>
                            <span style=" margin-right: 15px; margin-left: 10px; padding-top: 6px;"><p>Votes: <?php echo $result_post_votes; ?> </p></span>
                            <button type="submit" class="btn btn-outline-primary"
                                    style="background-color: rgb(31,108,236, 0.01); color: #000; border-color:rgb(31,108,236, 0.03) ; border-style: none;"
                                    name="downvote">
                                <i class="fas fa-arrow-circle-down" style="color: rgb(31,108,236);"></i></button>
                            <?php }
                            else{
                                echo "<div class='col'><input type='submit' name='redo' value='redo' class='btn btn-primary'></div>";?>
                            <span style=" margin-right: 15px; margin-left: 10px; padding-top: 6px;"><p>Votes: <?php echo $result_post_votes; ?> </p></span>
                            <?php }?>

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
                        $page = "post.php";
                        addNewComment($id_post, $id_user, $comment_author, $comment_content, $comment_date, $course_id, $page);

                    } else {
                        echo "<script>alert('Comment cannot be empty')</script>";
                    }

                }

                if (isset($_POST['delete_comment'])) {
                    $comment_id = $_POST['delete_comment_id'];
                    deleteComment($comment_id);
                    header('Location: post.php?p_id=' .$the_post_id);
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
                        if ($id_user == $the_user_id) {
                            ?>
                            <form action="post.php?p_id=<?php echo $the_post_id; ?>"
                                  method="post" role="form">
                                <input type="submit" value="Delete Comment" name="delete_comment"
                                       class="btn btn-primary">
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
                    <form action="post.php?p_id=<?php echo $the_post_id; ?>"
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
<?php ob_end_flush(); ?>
