<?php

include "includes/callable_functions.php";
include "includes/utils/variables.php";
userProfile();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>my profile</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/rootStyles.css">
  <link rel="stylesheet" href="myprofile.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

  <div class="wrapper">
    <!-- Sidebar  -->
    <?php
    
    if ($type === $studentsType) {
      include "includes\std_sidebar.php";
    } else {
      include "includes\prof_sidebar.php";
    }
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
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto secondary-navigation">
              <li class="nav-item active">
                <a class="nav-link" href="#">Discussion</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="academic\assignment-answers-students.php">Assignments</a>
                <a class="nav-link" href="academic\assignment-hand-ins.php">Assignments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Material</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Students</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Marks</a>
              </li>
            </ul>
          </div>
      </nav>




      <div class="page-body">
        <!-- START HERE -->
        <div class="row container-fluid w-100 justify-content-center" id="card-container">
          <div class="card col-md-6 col-sm-12 ">
            <div class="card-body">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="<?php echo $image_path ?>" alt="profile-pic" class="rounded-circle" width="150">
                <div class="mt-3">
                  <h4><?php echo $full_name; ?></h4>

                  <?php
                  if ($type === $studentsType)
                    echo "
                      <p class='text-secondary mb-1'>Level $level</p>";
                  ?>

                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="file-input" id="f">
                    <input type="file" id="file" class="file" name="image">
                    <button type="submit" class="" name="submit">submit</button>
                  </div>
                </form>
                

                  <a href="editprofile.php" class="btn btn-outline-primary btn-md">Edit</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <br>
        <div class="tab">
          <div class="card ">
            <div class="card-body">
              <div class="row align-items-center">

                <div class="col-md-6 ">
                  <h6>Full Name</h6>
                </div>
                <div class="col-md-6 text-secondary">
                  <?php echo $full_name; ?>
                </div>
              </div>
              <hr class="mb-4">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <h6>Email</h6>
                </div>
                <div class="col-md-6 text-secondary">
                  <?php echo $email; ?>
                </div>
              </div>
              <hr class="mb-4">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <h6>Phone</h6>
                </div>
                <div class="col-md-6 text-secondary">
                  <?php echo $mobile_number; ?>
                </div>
              </div>

              <?php
              if ($type === $studentsType)
                echo "
              <hr class='mb-4'>
              <div class='row align-items-center'>
                <div class='col-md-6 '>
                  <h6 >Guardian Phone </h6>
                </div> 
                <div class='col-md-6 text-secondary'>
                $guardian_mobile_number
                </div>
              </div>";
              ?>

              <hr class="mb-4">
              <div class="row align-items-center">
                <div class="col-md-6 ">
                  <h6>Home Phone </h6>
                </div>
                <div class="col-md-6 text-secondary">
                  <?php echo $home_number; ?>
                </div>
              </div>

              <?php
              if ($type === $studentsType)
                echo "
              <hr class='mb-4'>
              <div class='row align-items-center'>
                <div class='col-md-6 '>
                  <h6>Address</h6>
                </div>
                <div class='col-md-6 text-secondary'>
                $address
                </div>
              </div>";
              ?>

            </div>
          </div>
        </div>
        <br>
      </div>


<?php
if($type == $studentsType) {
  echo "<button><a href='student\student_assignments.php'>course_assignments</a></button>";
}
?>


     <!-- STOP HERE -->
    </div>


  </div>


  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  <!-- jQuery Custom Scroller CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <!-- Navbar -->
  <script type="text/javascript" src="rootJS.js"></script>

</body>

</html>