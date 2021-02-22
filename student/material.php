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
        include_once dirname(__FILE__, 2) .DIRECTORY_SEPARATOR. "paths.php";

        include_once $student_sidebar_path;
        $courseId = $_GET['course_id'];      
      ?>
      <!-- Page Content  -->
      <div id="content">

          <?php
          include_once $student_navbar_path;
          ?>

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