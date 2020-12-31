<?php
ob_start();
include "../includes/functions.php";
session_start();

if(isset($_POST['editCourse'])){
    $course_id = $_POST['courseID'];
    $instructor_id = $_POST['professorName'];
    $level = $_POST['level'];
    updateOpenCourse($course_id, $instructor_id, $level);

}

if(isset($_POST['closeCourse'])){
    $course_id = $_POST['courseID'];
    closeOpenCourse($course_id);
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
        <?php include "../includes/admin_sidebar.php"; ?>
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
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                <div class="container-fluid">
                    <div class="row justify-content-end">
                        <a href="available_courses_t.php" class=" btn btn-primary btn-block w-25">Add New</a>
                    </div>
                </div>
                <hr class="mb-4">

                <?php 
                    getOpenCourses();
                ?>

                <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Open Course</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <label class="label" for="professorName">Professor</label>
                        <select class="custom-select d-block w-100" name="professorName" id="professorName" required>
                            <option value="">Choose...</option>
                            <?php getProfessorList(); ?>
                        </select>
                        <br>
                        <label class="label" for="level">Level</label>
                        <select class="custom-select d-block w-100" name="level" id="level" required>
                            <option value="1">Level 1</option>
                            <option value="2">Level 2</option>
                            <option value="3">Level 3</option>
                            <option value="4">Level 4</option>
                        </select>
                        <input type="text" class="form-control" name="courseID" id="courseID" style="display:none;">
                        </div>
                        <div class="modal-footer">
                        <button type="submit" name="editCourse" class="btn btn-primary">Save Changes</button>  
                        <button type="submit" name="closeCourse" class="btn btn-danger">Close Course</button>  
                        </div>
                    </div>
                    </div>
                </form>
                </div>

            </div>

        </div>


        <!-- </div> -->
    </div>


    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>
    <script type="text/javascript" src="js/modal_edit_open_courses.js"></script>


</body>

</html>
<?php ob_end_flush(); ?>