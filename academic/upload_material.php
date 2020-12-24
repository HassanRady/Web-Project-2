<?php
include "../includes/functions.php"; 

$courseId = $_GET['course_id'];
$semester = $_GET['sem_id'];
$user_id = 1;

if(isset($_POST['submit'])){
    $location = uploadMaterial($_FILES['material_file']);
    if($location){
        putMaterialInDB($courseId, $semester, $_POST['material_title'], $location, $user_id);
        header("Location: material.php?course_id=$courseId&sem_id=$semester");
    }
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Upload Material</title>

    <?php include "../includes/bootstrap_styles_start.php"; ?>
    <link rel="stylesheet" href="prof-assmt.css">
    

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include "../includes/prof_sidebar.php"; ?>
        
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">Web Programming</a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto secondary-navigation">
                            <li class="nav-item active">
                                <a class="nav-link" href="discussion.html">Discusssion</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="assignment-hand-ins.html">Assignments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Material.html">Material</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="students_in_course.html">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="std_grades.html">Marks</a>
                            </li>
                        </ul>
                    </div>
            </nav>





            <div class="page-body">
                <!-- START HERE -->

                <div class="row">
                    <div class="col-md-12 order-md-1 col-lg-12">
                        <h4 class="mb-3">Upload Material</h4>
                        <hr class="mb-4">
                        <form class="needs-validation" action="#" method="POST" enctype="multipart/form-data" novalidate>
                            <div class="row">
                                <div class="col-lg-6 col-md-12 mb-3">
                                    <label for="material_title">Title</label>
                                    <input type="text" class="form-control" name="material_title" id="material_title" placeholder="What is this?" value=""
                                        required>
                                    <div class="invalid-feedback">
                                        Valid title is required.
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="custom-file">Upload file</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" name="material_file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>

                                </div>
                            </div>

                            <!-- <div class="row">


                                <div class="col-lg-12 mb-3">
                                    <label for="aboutTextArea">Description</label>
                                    <textarea class="form-control" placeholder="What is this?" id="aboutTextArea"
                                        style="resize: none; height: 150px;"></textarea>
                                </div>

                            </div> -->



                            <hr class="mb-4">

                            <button class="btn btn-primary btn-lg btn-block" name='submit' type="submit">Upload</button>
                        </form>
                        <br>
                    </div>
                </div>
                <!-- STOP HERE -->

            </div>


        </div>
    </div>

    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
          var fileName = $(this).val().split("\\").pop();
          $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
        </script>


</body>

</html>