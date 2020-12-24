<?php
include "../includes/functions.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Course Material</title>

  <?php include "../includes/bootstrap_styles_start.php"; ?>
  <link rel="stylesheet" href="css/material.css">

  

</head>

<body>

  <div class="wrapper">
      <!-- Sidebar  -->
      <?php 
        include "../includes/prof_sidebar.php";
        $courseId = $_GET['course_id'];      
        $semester = $_GET['sem_id'];      
      ?>
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
                              <a class="nav-link" href="#">Material</a>
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


        <div class="container-fluid">
          <div class="row justify-content-end">
              <a href="upload_material.php?<?php echo "course_id=$courseId&sem_id=$semester"; ?>" class=" btn btn-primary btn-block w-25">Upload New</a>
          </div>
        </div>
        <hr class="mb-4">

        <?php 
          getCourseMaterialEditable($courseId, $semester);
        ?>

          <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel">Edit Material</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <label class="label" for="materialTitle">Venue Name</label>
                  <input type="text" class="form-control" id="materialTitle">
                  <br />
                  <label class="label" for="materialLocation">Vanue Location</label>
                  <input type="file" class="form-control" id="materialLocation">
                </div>
                <div class="modal-footer">

                  <button type="button" class="btn btn-primary">Save changes</button>
                  <button type="button" class="btn btn-outline-danger">Remove</button>
               </div>
              </div>
            </div>
          </div>


        










        <!-- STOP HERE -->
      </div>
    </div>

  </div>
  </div>

  <?php include "../includes/bootstrap_styles_end.php"; ?>

  <script type="text/javascript" src="../js/rootJS.js"></script>
  <script type="text/javascript" src="js/modal_material.js"></script>

</body>

</html>