<?php
include "includes/functions.php";
editProfile();
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Edit profile</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/rootStyles.css">
  <!-- Scrollbar Custom CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <img src="media/logo.jpeg" alt="SIM-LOGO">
      </div>
      <p>Navigation</p>
      <ul class="list-unstyled components">
        <li class="active">
          <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Users</a>
          <ul class="collapse list-unstyled" id="homeSubmenu">
            <li>
              <a href="#">Students</a>
            </li>
            <li>
              <a href="#">Professors</a>
            </li>
            <li>
              <a href="#">Teaching Assistants</a>
            </li>
            <li>
              <a href="#">Student Affairs</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Courses</a>
          <ul class="collapse list-unstyled" id="pageSubmenu">
            <li>
              <a href="#">Open Courses</a>
            </li>
            <li>
              <a href="#">All Courses</a>
            </li>
          </ul>
        </li>
        <li>
          <a href="my_profile.php?id=<?php echo $id_user . '&type=' . $type ?>">My Profile</a>
        </li>
        <li>
          <a href="#">Timetable</a>
        </li>
        <li>
          <a href="#">Others</a>
        </li>
      </ul>

      <ul class="list-unstyled CTAs">
        <li>
          <a href="#" class="cta-logout" id="logout-btn">Logout</a>
        </li>
      </ul>
    </nav>
    <!-- Page Content  -->
    <div id="content">

      <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fas fa-align-left"></i>
            <!-- <span id="nav-toggle-text">Navigation</span> -->
          </button>
          <a class="navbar-brand" id="page-title" href="#">Edit</a>
          <div class="ml-auto"></div>
      </nav>




      <div class="page-body">
        <!-- START HERE -->




        <div class="row">
          <div class="col-md-12 order-md-1 col-lg-12">
            <h4 class="mb-3">Edit profile</h4>
            <hr class="mb-4">
            <form class="needs-validation" novalidate action="" method="POST">
              <div class="row">
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="firstName" name="first_name" value="<?php echo $first_name ?>" required>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="lastName">Middle name </label>
                  <input type="text" class="form-control" id="middleName" name="middle_name" value="<?php echo $middle_name ?>" required>

                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="lastName">Last name </label>
                  <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo $last_name ?>" required>

                </div>
              </div>


              <hr class="mb-4">
              <div class="row">
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" id="password" placeholder="" value="" required>

                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="Re-enter Password">Re-enter Password </label>
                  <input type="text" class="form-control" id="Re-enter" placeholder="" value="" required>

                </div>

              </div>



              <?php
              if ($type === 'student')
                echo "
                    <hr class='mb-4'>
                    <div class='row'>
                          <div class='col-lg-6 col-md-12 mb-3'>
                            <label for='address'>Address</label>
                            <input type='text' class='form-control' id='address' name='address' value='$address' required>
                            <div class='invalid-feedback'>
                              Please enter your address.
                            </div>
                          </div>      
                    </div>";
              ?>

              <hr class="mb-4">
              <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                  <label for="gender">Mobile Number</label>
                  <input type="text" class="form-control" id="MobileNumber" name="mobile_number" value="<?php echo $mobile_number ?>" required>
                  <div class="invalid-feedback">Please enter your Mobile Number.</div>
                </div>

                <?php
                if ($type == 'student')
                  echo "
                        <div class='col-lg-4 col-md-6 col-sm-12 mb-3'>
                            <label for='gender'>Guardian Mobile Number</label>
                            <input type='text' class='form-control' id='GuardianMobileNumber' name='guardian_mobile_number' value='$guardian_mobile_number' required>
                              <div class='invalid-feedback'>Please enter your Guardian Mobile Number.</div>
                        </div>";
                ?>
                
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                  <label for="gender">Home Phone Number</label>
                  <input type="text" class="form-control" id="HomePhoneNumber" name="home_number" value="<?php echo $home_number ?>" required>
                  <div class="invalid-feedback">Please enter your Home Phone Number.</div>
                </div>

              </div>



              <hr class="mb-4">

              <button class="btn btn-primary btn-lg btn-block" type="submit" name="update">save changes</button>
            </form>
            <br>
          </div>
        </div>







        <!-- STOP HERE -->
      </div>


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