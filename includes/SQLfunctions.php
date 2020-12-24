<?php
// getting connection
include_once "db_conn.php";


function showData()
{
    global $conn, $students_data;

    // query for showing students
    $sql = "SELECT s.name, s.student_id, u.email, s.level, s.std_group, s.finished_hours, s.st_status, s.cgpa 
        FROM students s 
        join users u 
            on s.id = u.id
        ORDER BY s.level DESC;";
    $result = mysqli_query($conn, $sql);
    $students_data = array();
    if ($result) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            // saving data
            $students_data[] = $row;

            echo "<tr><td>" . $row["name"] . "</td><td>" . $row["student_id"] . "</td><td>"
                . $row["email"] . "</td><td>" . $row["level"] . "</td><td>" . $row["std_group"] . "</td><td>"
                . $row["finished_hours"] . "</td><td>" . $row["st_status"] . "</td><td>" . $row['cgpa'] . "</td></tr>";
        }
        echo "</table>";
        $conn->close();
    } else {
        die("RESULT FAILED" . mysqli_error($conn) . " " . mysqli_errno($conn));
    }
}


function add()
{
    global $conn;
    if (isset($_POST['submit'])) {

        // retrieving values from the user input form
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['first_name'];
        $last_name = $_POST['first_name'];
// -----------------------------------------------------------

        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['type'];
        $user_id = (int)$_POST['user_id'];

        // handling realescape
        $full_name = mysqli_real_escape_string($conn, $full_name);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);

        // hashing password
        $options = ['cost' => 10,
                    ];
        $password = password_hash($password, PASSWORD_BCRYPT, $options);


        // query for adding the user
        $sql1 = "INSERT INTO users (name, type, email, password, user_id)
                        VALUES ('$full_name', '$type', '$email', '$password', $user_id);";
        // execute the query
        $result =  mysqli_query($conn, $sql1);
        // check the first query
        if ($result) {
            $last_id = mysqli_insert_id($conn);

            // adding the student user in students table with deafult values
            if ($type == "Student") {
                $sql2 = "INSERT INTO students (student_id, cgpa, finished_hours, level, std_group, st_status, id, name)
                                    VALUES ($user_id, DEFAULT, DEFAULT, DEFAULT, DEFAULT, DEFAULT, $last_id , '$full_name');";
            }
            // adding the professor user in professors table with deafult values
            elseif ($type == "Professor") {
                // TODO
            }
            // adding the TA user in TAs table with deafult values
            else {
                // TODO
            }

            $result2 =  mysqli_query($conn, $sql2);

            // check the second query
            if ($result2) {
                header("Location:./add_user.php?add=success");
            } else {
                // error message
                die ("Could not insert data from sql2: " . mysqli_error($conn) . " " . mysqli_errno($conn));
            }
            $conn->close();
        } else {
            // error message
            die("Could not insert data from sql1 : " . mysqli_error($conn) . " " . mysqli_errno($conn));
        }
    }
}
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



function getAllPosts(){
    global  $conn ;
    $query = "SELECT post_author, post_date, post_content FROM posts ORDER BY post_id  DESC ";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die("Cannot retrieve posts from database  ". mysqli_error($conn));
    }
    return $result;
}