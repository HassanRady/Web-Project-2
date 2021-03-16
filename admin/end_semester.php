<?php
ob_start();
include_once "../includes/functions.php";
session_start();

$semInfo = null;
$query = "SELECT * FROM semesters WHERE semester_id = $semester";
$result = mysqli_query($conn, $query);
if($result){
    $semInfo = mysqli_fetch_assoc($result);
    // print_r($semInfo);
}else{
    die("something went wrong with the query " . mysqli_error($conn));
}

function startFollowingSemester(){
    global $semInfo;
    global $conn;
    $curr_year = (int)$semInfo["sem_year"];
    $curr_season = $semInfo["season"];
    $new_year = $curr_year;
    $new_season = "";
    switch($curr_season){
        case "fall":
            $new_season = "summer";
            break;
        case "summer":
            $new_season = "spring";
            break;
        case "spring":
            $new_season = "fall";
            $new_year++;
            break;
    }
    $query = "INSERT INTO `semesters` (`semester_id`, `season`, `sem_year`, `ongoing`) VALUES (NULL, '$new_season', '$new_year', '1');";
    $result = mysqli_query($conn, $query);
    if(!$result){
        die(mysqli_error($conn));
    }
}

function endSemester(){
    global $semester;
    global $conn;

    header("Location: available_courses_t.php");


    startFollowingSemester();

    $semester_query = "UPDATE `semesters` SET `ongoing` = '0' WHERE `semesters`.`semester_id` = $semester;";
    $sem_result = mysqli_query($conn, $semester_query);
    if($sem_result){
        die(mysqli_error($conn));
    }

    $tables = array("open_courses", "open_courses_instructors", "classes", "comments", "course_discussions", "polls", "poll_options", "poll_votes", "posts", "votes");

    foreach($tables as $table_name){
        $table_query = "DELETE FROM $table_name WHERE 1";
        $result = mysqli_query($conn, $table_query);
        if(!$result){
            die(mysqli_error($conn));
        }
    }
    


}

if(isset($_POST['submit'])){
    endSemester();
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
        <?php include_once "../paths.php";
        include_once $admin_sidebar_path ?>
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">End semester</a>
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
                        <h5 class="card-title">Are you sure you want to end <?php echo ucfirst($semInfo['season']) . " " . $semInfo['sem_year'];  ?>?</h5>
                        <p class="card-text">Proceeding with this action means that all of the semesters's data including classes, open courses, and posts and discussions will be permanently deleted. You should only do this once all grades for all subjects have been entered and finalized. Are you sure you want to continue?</p>
                        <form action="#" method="post">
                            <a href="<?php echo $open_courses_path ?>" class="btn btn-outline-secondary">No, Go Back</a>
                            <button type="submit" name="submit" class="btn btn-danger">Yes, End Semester</button>
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