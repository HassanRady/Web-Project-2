<?php
ob_start();
include "../includes/functions.php";
session_start();

?>
<?php 
    if(isset($_POST['submit'])){
        $name = $_POST['courseName'];
        $id = $_POST['courseId'];
        $credits = $_POST['credits'];
        $category = $_POST['category'];
        $type = $_POST['type'];
        $prerequisite = $_POST['prerequisite'];
        $practicalCheckbox = $_POST['practicalCheckbox'];
        $sectionsCheckbox = $_POST['sectionsCheckbox'];
        addNewCourse($id, $name, $credits, $category, $type, $prerequisite, $practicalCheckbox, $sectionsCheckbox);
        header("Location: available_courses_t.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Add New Course</title>

    <?php include "../includes/bootstrap_styles_start.php"; ?>


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
                    <a class="navbar-brand" id="page-title" href="#">Courses</a>
                    <div class="ml-auto"></div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                <div class="row">
                    <div class="col-md-12 order-md-1 col-lg-12">
                        <h4 class="mb-3">Add New Course</h4>
                        <hr class="mb-4">
                        <form class="needs-validation" action='#' method='post' novalidate>
                            <div class="row">
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="courseName">Course Name</label>
                                    <input type="text" class="form-control" id="courseName" name="courseName" placeholder="e.g. Math 4" value=""
                                        required>
                                    <div class="invalid-feedback">
                                        A valid name is required.
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="courseId">Course ID</label>
                                    <input type="text" class="form-control" id="courseId" name="courseId" placeholder="0417XXXX" value=""
                                        required>
                                    <div class="invalid-feedback">
                                        A valid ID is required.
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="credits">Credits</label>
                                    <input name='credits' id='credits' type="text" class="form-control" id="address" placeholder="e.g. 3"
                                        required>
                                    <div class="invalid-feedback">Please enter a valid number.</div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="row">
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <label for="category">Category</label>
                                    <select class="custom-select d-block w-100" name="category" id="category" required>
                                        <option value="">Choose...</option>
                                        <option value='university'>University</option>
                                        <option value='faculty'>Faculty</option>
                                        <option value='sim'>SIM</option>
                                        <option value='free'>Free</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid category.
                                    </div>
                                </div>


                                <div class="col-md-4 col-sm-12 mb-3">
                                    <label for="type">Type</label>
                                    <select class="custom-select d-block w-100" name="type" id="type" required>
                                        <option value="">Choose...</option>
                                        <option value='no'>Mandatory</option>
                                        <option value='yes'>Elective</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid category.
                                    </div>
                                </div>

                                <div class="col-md-5 col-sm-12 mb-3">
                                    <label for="prerequisite">Prerequisite</label>
                                    <select class="custom-select d-block w-100" name="prerequisite" id="prerequisite">
                                        <option value="">None</option>
                                        <?php getCoursesAsOptions() ?>
                                        
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a prerequisite.
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-4">
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="practicalCheckbox" id="practicalCheckbox" value='1'>
                                        <label class="form-check-label" for="practicalCheckbox">This course is practical</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="sectionsCheckbox" id="sectionsCheckbox" value='1'>
                                        <label class="form-check-label" for="sectionsCheckbox" >This course has labs/sections</label>
                                    </div>
                                </div>

                            </div>
                            
                            

                            <button class="btn btn-primary btn-lg btn-block" type="submit" name='submit'>Add Course</button>
                        </form>
                        <br>
                    </div>
                </div>


                <!-- STOP HERE -->
            </div>


        </div>
    </div>

    <?php include "../includes/bootstrap_styles_start.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>