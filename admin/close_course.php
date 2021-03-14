<?php
ob_start();
include_once "../includes/functions.php";
session_start();

$courseId = null;
$courseInfo = null; 

function closeCourse($courseId){
    global $conn;
    $classes_query = "DELETE FROM classes WHERE id_course = $courseId";
    $css_query = "DELETE FROM course_semester_students WHERE id_course = $courseId";
    $open_courses_query = "DELETE FROM open_courses WHERE course_id = $courseId";
    $oci_query = "DELETE FROM open_courses_instructors WHERE course_id = $courseId";

    $queries = array($classes_query, $css_query, $open_courses_query, $oci_query);

    foreach( $queries as $q){
        $result = mysqli_query($conn, $q);
        print("here");
        if(!$result){
            die(mysqli_error($conn));
        }
    }

    header("Location: open_courses.php");

}


if(isset($_GET['course_id'])){
    $courseId = $_GET['course_id'];
}else{
    header("Location: ../announcements.php");
}

if(isset($_POST['submit'])){
    closeCourse($courseId);
}


$query = "SELECT * FROM courses WHERE course_id = $courseId";
$result = mysqli_query($conn, $query);

if($result){
    $courseInfo = mysqli_fetch_assoc($result);
    // print_r($courseInfo);
}else{
    die("something went wrong with the query " . mysqli_error($conn));
}




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
                </div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                
                <div class="card text-center">
                    <!-- <div class="card-header">
                        Featured
                    </div> -->
                    <div class="card-body">
                        <h5 class="card-title">Are you sure you want to delete "<?php echo $courseInfo['name'] ?>"?</h5>
                        <p class="card-text">Proceeding with this action means that all of the course's data including classes, students' grades, and assignments will be permanently deleted. Are you sure you want to continue?</p>
                        <form action="#" method="post">
                            <a href="#" class="btn btn-outline-secondary">No, Go Back</a>
                            <button type="submit" name="submit" class="btn btn-danger">Yes, Close Course</button>
                        </form>
                        
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