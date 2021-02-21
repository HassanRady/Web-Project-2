<?php
include_once dirname(__FILE__, 2) .DIRECTORY_SEPARATOR. "paths.php";
include_once "functions.php";
?>

<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">TITLE</a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto secondary-navigation">
                            <li class="nav-item active">
                                <a class="nav-link" href="<?php echo $discussion_path."?course_id={$_GET['course_id']}&sem_id=$semester" ?>">Discussion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $assignments_student_path."?course_id={$_GET['course_id']}&sem_id=$semester" ?>">Assignments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $materials_student_path."?course_id={$_GET['course_id']}&sem_id=$semester" ?>">Material</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo $grades_student_path."?course_id={$_GET['course_id']}&sem_id=$semester" ?>">Marks</a>
                            </li>
                        </ul>
                    </div>
            </nav>