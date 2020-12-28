<?php
// getting connection
include_once "db_conn.php";
function showAllCourses(){
    global $conn;
    $query = "SELECT * FROM courses ";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("QUERY OF SHOW ALL COURSES FAILED". mysqli_error($conn));
    }
    return $result;
}
function getCourseID($courseName){
    global $conn;
    $courseID_query = "SELECT course_id FROM courses WHERE `name` = '$courseName'";
    $result = mysqli_query($conn,$courseID_query);
    if(!$result){
        die("CANT GET THE COURSE ID". mysqli_error($conn));
    }
    return $result;
}
function getVenueID($venueName){
    global $conn;
    $courseID_query = "SELECT venue_id FROM venues WHERE `name` = '$venueName'";
    $result = mysqli_query($conn,$courseID_query);
    if(!$result){
        die("CANT GET THE Venue ID". mysqli_error($conn));
    }
    return $result;
}


function showALlVenues(){
    global $conn;
    $query = "SELECT `name` FROM venues ";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("QUERY OF SHOW ALL COURSES FAILED". mysqli_error($conn));
    }
    return $result;
}

function addToClassTable($course_id,$venue_id,$startTime,$endTime,$day,$type,$freq){
global $conn;
$query = "INSERT INTO `classes` (`class_id`, `id_course`, `id_venue`, `start`, `end`, `day`, `type`, `freq`) VALUES(NULL,'$course_id','$venue_id','$startTime','$endTime','$day','$type','$freq' );";
$result = mysqli_query($conn,$query);
if($result){
    echo "DATA ARE INSERTED";
}
else{
 die("cannot insert data". mysqli_error($conn));
}

}
function getUserName($user_id){
    global  $conn ;
    $query = "SELECT first_name, middle_name FROM users  WHERE id = '$user_id' ";
    $result = mysqli_query($conn, $query);
    $user_name = "";
    if(!$result){
        die("Cannot get user name ". mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($result)){
        $first = $row['first_name'];
        $middle = $row['middle_name'];
        $user_name .= $first;
        $user_name .=" ";
        $user_name .= $middle;
    }
    return $user_name;

}


function addNewPost($id_user, $id_course,$post_title, $post_author, $post_user, $post_date, $post_content, $post_tags ){
    global $conn ;
    $query = "INSERT INTO `posts`(id_user, id_course, post_title, post_author, post_user, post_date, post_content, post_tags) ";
    $query.= "VALUES('$id_user', '$id_course', '$post_title', '$post_author', '$post_user', '$post_date', '$post_content','$post_tags')";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot add post to database  ". mysqli_error($conn));
    }
    return $result;
}



function getAllPosts($course_id){
    global  $conn ;
    $query = "SELECT post_id, id_user,post_author, post_date, post_content, votes FROM posts WHERE id_course ='$course_id' ORDER BY post_id  DESC ";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot retrieve posts from database  ". mysqli_error($conn));
    }
    return $result;
}
function getPost($post_id){
     global  $conn ;
    $query = "SELECT post_author, post_date, post_content, votes FROM posts WHERE post_id = '$post_id' ";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot retrieve posts from database  ". mysqli_error($conn));
    }
    return $result;
}
function deletePost($post_id){
    global  $conn;
    $query= "DELETE FROM posts WHERE post_id = '$post_id'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot delete post". mysqli_error($conn));
    }
    else{

        deletePostComments($post_id);
    }
}
function deletePostComments($id_post){
    global $conn;
    $query = "DELETE FROM comments WHERE id_post = '$id_post'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot delete comments". mysqli_error($conn));
    }
}
function addNewComment($id_post, $id_user, $comment_author, $comment_content, $comment_date){
    global $conn ;
    $query = "INSERT INTO `comments`(id_post, id_user, comment_author, comment_content, comment_date) ";
    $query.= "VALUES('$id_post', '$id_user', '$comment_author', '$comment_content', '$comment_date')";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot add post to database  ". mysqli_error($conn));
    }
    return $result;
}
function getAllComments($id_post){
    global  $conn ;
    $query = "SELECT id_user, comment_id, comment_author, comment_content, comment_date FROM comments WHERE id_post ='$id_post' ORDER BY comment_id  ASC ";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot retrieve comments from database  ". mysqli_error($conn));
    }
    return $result;
}
function deleteComment($comment_id){
    global  $conn;
    $query= "DELETE FROM comments WHERE comment_id = '$comment_id'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot delete post". mysqli_error($conn));
    }
}
function upVote($post_id, $user_id){
    global $conn;
    $query1 = "INSERT INTO `votes`(id_post, id_user, vote_value) VALUES('$post_id', '$user_id', 1)";
    $query2 = "UPDATE posts SET votes = votes + 1 WHERE post_id = '$post_id' ";
    $result1 = mysqli_query($conn, $query1);
    if($result1){
        $result2 = mysqli_query($conn, $query2);
        if (!$result2){
            die("cannot update the votes value in posts " .mysqli_error($conn));
        }
    }
    else{
        die('cannot add vote record to votes database ' .mysqli_error($conn));
    }

}
function downVote($post_id, $user_id){
    global $conn;
    $query1 = "INSERT INTO `votes`(id_post, id_user, vote_value) VALUES('$post_id', '$user_id', -1)";
    $query2 = "UPDATE posts SET votes = votes - 1 WHERE post_id = '$post_id'";
    $result1 = mysqli_query($conn, $query1);
    if(!$result1){
        die("query 1 error ".mysqli_error($conn));
    }
    $result2 = mysqli_query($conn, $query2);
    if (!$result2){
        die("query 2 error ".mysqli_error($conn));
    }

}
function redoVote($post_id, $user_id){
    global $conn;
    $query1 = "SELECT vote_value FROM votes WHERE id_post = '$post_id' AND id_user = '$user_id'";
    $query2 = "DELETE FROM votes WHERE id_post = '$post_id' AND id_user = '$user_id' ";
    $result1 = mysqli_query($conn, $query1) ;
    if(!$result1){
        die("Query1 error redoVote".mysqli_error($conn));
    }
    while($row = mysqli_fetch_assoc($result1)){
        $valueOfVote = $row['vote_value'];
    }
    $query3 = "UPDATE posts SET votes = votes - '$valueOfVote' WHERE post_id = '$post_id'";
    $result2 = mysqli_query($conn, $query2) ;
    if(!$result2){
        die("Query2 error redoVote ".mysqli_error($conn));
    }
    $result3= mysqli_query($conn, $query3) ;
    if(!$result3){
        die("Query3 error redoVote ".mysqli_error($conn));
    }

}
// to check if user has already vote in a post or not
function checkIfVoted($post_id, $user_id){
    global $conn;
    $query = "SELECT * FROM votes WHERE id_post = '$post_id' AND id_user = '$user_id'";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die('there is an error while accessing votes db ' .mysqli_error($conn));
    }

    return mysqli_num_rows($result) != 0;

}