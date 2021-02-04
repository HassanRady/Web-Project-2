<?php
ob_start();
include "../includes/callable_functions.php";
include "../includes/variables.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit Professor Information</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="stu_prof.css">
    <link rel="stylesheet" href="css/tables.css">
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
                            <a href="Students.php?type=<?php echo $studentsType ?>">Students</a>
                        </li>
                        <li>
                            <a href="Professors.php?type=<?php echo $professorsType ?>">Professors</a>
                        </li>
                        <li>
                            <a href="ta_list.php?type=<?php echo $tasType ?>">Teaching Assistants</a>
                        </li>
                        <li>
                            <a href="sa_list.php?type=<?php echo $sasType ?>">Student Affairs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Courses</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="available_courses.html">All Courses</a>
                        </li>
                        <li>
                            <a href="available_courses.html">Open Courses</a>
                        </li>
                        <li>
                            <a href="#">My Courses</a>
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
                    <a href="venues.php">Venues</a>
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
                                <a class="nav-link" href="Students.php?type=<?php echo $studentsType ?>">Student</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="Professors.php?type=<?php echo $professorsType ?>">Professor</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="ta_list.php?type=<?php echo $tasType ?>">Teaching Assistant</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="sa_list.php?type=<?php echo $sasType ?>">Student Affairs</a>
                            </li>
                        </ul>
                    </div>
            </nav>


            <div class="page-body">
                <!-- START HERE -->
                <div class="container-fluid">
                    <div class="row justify-content-end">
                        <a href="add_new_prof.php?type=<?php echo $professorsType ?>" class=" btn btn-primary btn-block w-25">Add New</a>
                    </div>
                </div>
                <hr class="mb-4">

                <div class="container-fluid table-container">
                    <!-- Search form -->
                    <form>
                        <div class="row ">
                            <div class="col-md mt-4">
                                <label for="student-name">Professor Name</label>
                                <input type="text" class="form-control" placeholder="Professor Name" id="student-name" name="student-name">
                            </div>
                            <div class="col-md mt-4">
                                <label for="student-id">Professor Email</label>
                                <input type="text" class="form-control" placeholder="Professor ID" id="student-id" name="student-id">
                            </div>
                            <div class="col-md mt-4">
                                <label for="student-email">Phone Number</label>
                                <input type="text" class="form-control" placeholder="Professor Phone Number" id="student-email" name="student-email">
                            </div>
                        </div>
                        <div class="row justify-content-center ">
                            <button class="btn btn-primary w-50 btn-block right-btn search-btn">Search</button>
                        </div>

                    </form>
                </div>

                <br>

                <h3 class="font-weight-bold" style=" color:rgb(31,108,236);">
                    Professor List
                </h3>
                <hr class="mb-4">
                <div class="container-fluid">
                    <div class="row table-container table-responsive">
                        <table class="table">
                            <thead>
                                <tr style="color:rgb(31,108,236);">
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0,0.5);">

                                <?php
                                showWichData();
                                deleteUser();
                                ?>

                            </tbody>

                        </table>
                    </div>
                </div>





                <div class="modal fade" id="edit-info-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Student Information</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="edit-name" class="col-form-label">Student Name:</label>
                                        <input type="text" class="form-control" id="edit-name" placeholder="Abdulrahman Khalid">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-name" class="col-form-label">Student Email:</label>
                                        <input type="text" class="form-control" id="edit-email" placeholder="sim.abdulrahman.khaled@alexu.edu.eg">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-name" class="col-form-label">Student Phone Number:</label>
                                        <input type="text" class="form-control" id="edit-phone" placeholder="12345678910">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit-name" class="col-form-label">Student ID:</label>
                                        <input type="text" class="form-control" id="edit-ID" placeholder="1952523712">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="16" fill="currentColor" class="bi bi-x-square" viewBox="-2 -2 17 17">
                                        <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                                    </svg>Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mb-4">
                <div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <?php
                        list($per_page, $page_1, $count, $page) = getRowsPerPage("professors");   
                        for ($i = 1; $i <= $count; $i++) {
                            if ($i == $page) {
                                echo "<button type='button' class='btn btn-primary'><a class='active_link' href='Professors.php?page={$i}'>{$i}</a></button>";
                            } else {
                                echo "<button type='button' class='btn btn-primary'><a class='active_link' href='Professors.php?page={$i}'>{$i}</a></button>";
                            }
                        }

                        ?>
                    </div>

                </div>
                <br>

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
<?php ob_end_flush(); ?>