<?php
include "../includes/functions.php";
add();

?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Add Student</title>

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="../css/rootStyles.css">
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
                    <img src="../media/logo.jpeg" alt="SIM-LOGO">
                </div>
                <p>Navigation</p>
                <ul class="list-unstyled components">
                    <li>
                        <a href="announcements.html">Home</a>
                    </li>
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Users</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="Students.html">Students</a>
                            </li>
                            <li>
                                <a href="Professors.html">Professors</a>
                            </li>
                            <li>
                                <a href="ta_list.html">Teaching Assistants</a>
                            </li>
                            <li>
                                <a href="sa_list.html">Student Affairs</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="../my_profile.html">My Profile</a>
                    </li>
                    <li>
                        <a href="timetable.html">Timetable</a>
                    </li>
                    <li>
                        <a href="venues.html">Venues</a>
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
                        <a class="navbar-brand" id="page-title" href="#">Add New User</a>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
          </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto secondary-navigation">
                                <li class="nav-item ">
                                    <a class="nav-link" href="add_new_student.html">Student</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="add_new_prof.html">Professor</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="add_new_ta.html">Teaching Assistant</a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link" href="add_new_sa.html">Student Affairs</a>
                                </li>
                            </ul>
                        </div>
                </nav>


                <div class="page-body">
                    <!-- START HERE -->

                    <div class="row">
                        <div class="col-md-12 order-md-1 col-lg-12">
                            <h4 class="mb-3">Add New Student</h4>
                            <hr class="mb-4">
                            <form class="needs-validation" novalidate action="add_new_student.php" method="POST">
                                <div class="row">
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <label for="firstName">First name (English)</label>
                                        <input type="text" class="form-control" id="firstName" name="first_name" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <label for="lastName">Middle name (English)</label>
                                        <input type="text" class="form-control" id="lastName" name="middle_name" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <label for="lastName">Last name (English)</label>
                                        <input type="text" class="form-control" id="lastName" name="last_name" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-8 col-md-12 mb-3">
                                        <label for="firstName">Full Name (Arabic)</label>
                                        <input type="text" class="form-control" id="firstName" name="arabic_name" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid first name is required.
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <label for="lastName">National ID Number</label>
                                        <input type="text" class="form-control" id="lastName" name="national_id" placeholder="" value="" required>
                                        <div class="invalid-feedback">
                                            Valid last name is required.
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">

                                <div class="row">
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <label for="email">University E-mail</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="example@alexu.edu.eg">
                                        <div class="invalid-feedback">
                                            Please enter a valid email address.
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" required>
                                        <div class="invalid-feedback">
                                            Please enter your shipping address.
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="gender">Gender</label>
                                        <select class="custom-select d-block w-100" id="country" name="gender" required>
                    <option value="">Choose...</option>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                                        <div class="invalid-feedback">
                                            Please select a valid country.
                                        </div>
                                    </div>


                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="math">Starting Math</label>
                                        <select class="custom-select d-block w-100" id="state" name="student_type" required>
                    <option value="">Choose...</option>
                    <option>Math 0</option>
                    <option>Math 1</option>
                  </select>
                                        <div class="invalid-feedback">
                                            Please provide a valid state.
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-3">
                                        <label for="zip">Student ID</label>
                                        <input type="text" class="form-control" id="zip" name="student_id" placeholder="" required>
                                        <div class="invalid-feedback">
                                            Zip code required.
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-4">
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label for="gender">Student Mobile Number</label>
                                        <input type="text" class="form-control" id="address" name="mobile_number" placeholder="01234567890" required>
                                        <div class="invalid-feedback">Please enter your shipping address.</div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label for="gender">Guardian Mobile Number</label>
                                        <input type="text" class="form-control" id="address" name="guardian_mobile_number" placeholder="01234567890" required>
                                        <div class="invalid-feedback">Please enter your shipping address.</div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label for="gender">Home Phone Number</label>
                                        <input type="text" class="form-control" id="address" name="home_number" placeholder="(optional)" required>
                                        <div class="invalid-feedback">Please enter your shipping address.</div>
                                    </div>

                                </div>



                                <hr class="mb-4">

                                <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Add Student</button>
                            </form>
                            <br>
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
                <script type="text/javascript" src="../js/rootJS.js"></script>

    </body>

    </html>