<?php
include "includes/Admin/callable_functions.php";
include "includes/utils/variables.php";
include_once "paths.php";
updateProfile();
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
<script type="text/javascript" src="forms.js"> </script>
</head>

<body>

  <div class="wrapper">
    <?php
    session_start();
    $type = $_SESSION['type'];
    if ($type === $studentsType)
      include $student_sidebar_path;
    elseif ($type === $adminsType || $type == $sasType)
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
          <a class="navbar-brand" id="page-title" href="#">Edit</a>
          <div class="ml-auto"></div>
      </nav>




      <div class="page-body">
        <!-- START HERE -->




        <div class="row">
          <div class="col-md-12 order-md-1 col-lg-12">
            <h4 class="mb-3">Edit profile</h4>
            <hr class="mb-4">
            <form novalidate action="" method="POST" onsubmit="return !!(empty_field1() & validate_names() & validate_MobileNumber() &  validate_HomeNumber() & validate_1stpassword() & validate_2ndpassword())">
              <div class="row">
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="firstName">First name</label>
                  <input type="text" class="form-control" id="firstName" name="first_name"  value="<?php echo $first_name ?>" >
                   <h6 id="warn1" style="font-style: italic;color: red;" ></h6>
                  <div class="invalid-feedback">
                    Valid first name is required.
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="lastName">Middle name </label>
                  <input type="text" class="form-control" id="middleName" name="middle_name" value="<?php echo $middle_name ?>" >
                   <h6 id="warn2" style="font-style: italic;color: red;" ></h6>

                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="lastName">Last name </label>
                  <input type="text" class="form-control" id="lastName" name="last_name" value="<?php echo $last_name ?>" >
                   <h6 id="warn3" style="font-style: italic;color: red;" ></h6>

                </div>
              </div>


              <hr class="mb-4">
              <div class="row">
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" id="password" name="password" value="" >
                  <h6 id="warn4" style="font-style: italic;color: red;" ></h6>

                </div>
                <div class="col-lg-4 col-md-12 mb-3">
                  <label for="Re-enter Password">Re-enter Password </label>
                  <input type="text" class="form-control" id="Re-enter" name="repassword" value=""  onfocus ="check_password()" >
                  <h6 id="warn5" style="font-style: italic;color: red;" ></h6>

                </div>

              </div>



              <?php
              if ($type === $studentsType)
                echo "
                    <hr class='mb-4'>
                    <div class='row'>
                          <div class='col-lg-6 col-md-12 mb-3'>
                            <label for='address'>Address</label>
                            <input type='text' class='form-control' id='address' name='address' value='$address'>
                             <h6 id='warn9' style='font-style: italic;color: red;'' ></h6>
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
                  <input type="text" class="form-control" id="phone" name="mobile_number" value="<?php echo $mobile_number ?>" >
                   <h6 id="warn6" style="font-style: italic;color: red;" ></h6>
                  <div class="invalid-feedback">Please enter your Mobile Number.</div>
                </div>

                <?php
                if ($type == $studentsType)
                  echo "
                        <div class='col-lg-4 col-md-6 col-sm-12 mb-3'>
                            <label for='gender'>Guardian Mobile Number</label>
                            <input type='text' class='form-control' id='phone2' name='guardian_mobile_number' value='$guardian_mobile_number' >
                             <h6 id='warn7' style='font-style: italic;color: red;' ></h6>
                              <div class='invalid-feedback'>Please enter your Guardian Mobile Number.</div>
                        </div>";
                ?>

                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                  <label for="gender">Home Phone Number</label>
                  <input type="text" class="form-control" id="HomeNumber" name="home_number" value="<?php echo $home_number ?>">
                   <h6 id="warn8" style="font-style: italic;color: red;" ></h6>
                  <div class="invalid-feedback">Please enter your Home Phone Number.</div>
                </div>

              </div>



              <hr class="mb-4">

              <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">save changes</button>
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