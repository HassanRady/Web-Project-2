<?php

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
        include "../includes/std_sidebar.php";
        $courseId = $_GET['course_id'];      
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
                              <a class="nav-link" href="discussion.php?course_id=<?php echo $courseId ?>">Discusssion</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="assignment-hand-ins.php?course_id=<?php echo $courseId ?>">Assignments</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="material.php?course_id=<?php echo $courseId ?>">Material</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="my_marks_std.php?course_id=<?php echo $courseId ?>">Marks</a>
                          </li>
                      </ul>
                  </div>
          </nav>

      <div class="page-body">
        <!-- START HERE -->

        <?php 
          getCourseMaterial($courseId);
        ?>

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