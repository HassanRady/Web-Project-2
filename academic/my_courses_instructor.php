
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Doctor's Courses</title>

  
  <link rel="stylesheet" href="css/style.css">
  <?php include "../includes/bootstrap_styles_start.php"; ?>

</head>

<body>

  <div class="wrapper">
    <!-- Sidebar  -->
    <?php 
      include "../includes/prof_sidebar.php";
      session_start();
      $instructorId = $_SESSION['id_instructor'];
    ?>
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

        <div class="container-fluid ">

          <div class="row">


            <?php

            getInstructorCourses($instructorId);
            ?>
            
            

            
          </div>

        </div>
        <!-- STOP HERE -->
      </div>


    </div>
  </div>

  <?php include "../includes/bootstrap_styles_end.php"; ?>
  <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>