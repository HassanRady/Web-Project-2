
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
    $type = $_SESSION['type'];

    if ($type === $adminsType )
        include $admin_sidebar_path;
    else
        include $professor_sidebar_path;
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

          <div class="row courseslist ">

              <?php
              $courses = getInstructorCourses($instructorId);
              while ($row = mysqli_fetch_assoc($courses)) {
                  $id = $row['course_id'];
                  ?>

                  <div class='col-sm-12 col-md-6 col-lg-4 col-xl-3 course-item'>
                      <a href='<?php echo "discussion.php?course_id=$id&sem_id=$semester" ?>' class='cbox'>
                          <div class='course-title'>
                              <?php echo $row['name']; ?>
                          </div>
                          <div class='course-info'>
                              <p>Level: <?php echo $row['level'];  ?></p>
                          </div>
                          <div class='course-enrollment'>
                              <p>Enrolled Students: <?php echo $row['student_count']; ?></p>
                          </div>
                      </a>
                  </div>


              <?php }
              ?>
        <!-- STOP HERE -->
      </div>


    </div>
  </div>

  <?php include "../includes/bootstrap_styles_end.php"; ?>
  <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>