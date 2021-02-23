<?php 
  session_start();
  include "../includes/Student/functions.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>My Courses</title>

  <?php include "../includes/bootstrap_styles_start.php"; ?>
  <link rel="stylesheet" href="css/style.css">

</head>

<body>




  <div class="wrapper">
    <!-- Sidebar  -->
    <?php
    include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "paths.php";

    include_once $student_sidebar_path;
    // $std_id = $_SESSION['student_id'];
    $std_id = $_GET['std_id'];
    
    ?>


    <!-- Page Content  -->
    <div id="content">

      <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fas fa-align-left"></i>
            <!-- <span id="nav-toggle-text">Navigation</span> -->
          </button>
          <a class="navbar-brand" id="page-title" href="#">My Courses</a>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto secondary-navigation">
              <li class="nav-item active">
                <a class="nav-link" href="course_registration.html">All Courses</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">My Courses</a>
              </li>

            </ul>
          </div>
      </nav>



      <div class="page-body">
        <!-- START HERE -->

        <div class="container-fluid ">

          <div class="row courseslist ">

            <?php
            $courses = getStudentCourses($std_id);
            while ($row = mysqli_fetch_assoc($courses)) {
              $id = $row['course_id'];
              ?>
              
              <div class='col-sm-12 col-md-6 col-lg-4 col-xl-3 course-item'>
                <a href='<?php echo "$discussion_student_path?std_id=$$std_id&course_id=$id&sem_id=$semester"?>' class='cbox'>
                  <div class='course-title'>
                    <?php echo $row['name']; ?>
                  </div>
                  <div class='course-info'>
                    <?php echo $row['first_name'] . ' ' . $row['last_name'];  ?>
                  </div>
                </a>
              </div>              
                
          
            
            <?php }
            ?>

          </div>
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