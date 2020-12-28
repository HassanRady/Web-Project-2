<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <link rel="stylesheet" href="css/dispost.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"
        integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"
        integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"
        crossorigin="anonymous"></script>

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
                <li>
                    <a href="my_courses_prof_ta.html">My Courses</a>
                </li>
                <li>
                    <a href="../my_profile.html">My Profile</a>
                </li>
                <li>
                    <a href="timetable.html">Timetable</a>
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
                    <a class="navbar-brand" id="page-title" href="#">TITLE</a>
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
                              <a class="nav-link" href="students_in_course.php?course_id=<?php echo $courseId ?>">Students</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="std_grades.php?course_id=<?php echo $courseId ?>">Marks</a>
                          </li>
                      </ul>
                  </div>
            </nav>




            <div class="page-body">
                <!-- START HERE -->
                <h3 style="color: #206cef;">
                    Course Discussion
                </h3>
                <hr class="mb-4">

                <div class="container discussion-form">
                    <h5 class="">Start a new discussion:</h5>
                    <form class="row">
                        <div class="col-lg-12">
                            <textarea class="w-100 p-3" id="exampleFormControlTextarea1"
                                style="resize: none; height: 125px; border-radius: 8px;"
                                placeholder="What are you thinking about?"></textarea>
                        </div>
                        <div class="btn-grp w-100">
                            <a type="button" class="col-lg-4 btn btn-primary">Post</a>
                            <div class="col-lg-4">OR</div>
                            <a type="button" class="col-lg-4 btn btn-primary" data-toggle="modal"
                                data-target="#myModal">Make Poll</a>
                        </div>


                    </form>
                </div>

                <!-- MODAL -->

                <div class="modal" id="myModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">

                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                        style=" height: 60px; position:relative;left:120px;"
                                        placeholder="Enter Topic here..."></textarea>

                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <textarea class="w-50 p-3" id="exampleFormControlTextarea1" rows="3"
                                    style=" height: 30px;"></textarea>

                                <textarea class="w-50 p-3" id="exampleFormControlTextarea1" rows="3"
                                    style=" height: 30px;position:relative;left:14px; "></textarea>

                                <a href="#"
                                    style="text-decoration: none; color:blue; font-weight: bold; font-size: 40px; position:relative;left:20px;">+</a>

                            </div>
                            <div class="modal-footer">
                                <div class="container">
                                    <div class="text-left">
                                        <div class="row ">
                                            <div class="form-group col-xs-3 ">
                                                <select class="form-control form-control-lg "
                                                    style="background-color: #206cef; color: white; cursor: pointer;">
                                                    <option value="" disabled selected>Poll Length</option>
                                                    <option>1 Day</option>
                                                    <option>2 Days</option>
                                                    <option>3 Days</option>
                                                    <option>4 Days</option>
                                                    <option>5 Days</option>
                                                    <option>6 Days</option>
                                                    <option>7 Days</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Post Poll</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- POSTS -->


                <div class="container post">
                    <h6>Prof.Abdallah Yassser Gaber</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut
                        labore et dolore magna aliqua.
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo
                        consequat.
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                        pariatur.
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim
                        id est laborum.
                    </p>
                    <p class="date"> 11/11/2020 </p>
                </div>

                <div class="container post">
                    <h6>Prof.Abdallah Yassser Gaber</h6>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt
                        ut
                        labore et dolore magna aliqua.
                    </p>

                    <hr>

                    <!-- Radio -->
                    <p class="text-center">
                        <strong>Your Vote</strong>
                    </p>
                    <div class="form-check mb-4">
                        <input class="form-check-input" name="group1" type="radio" id="radio-179" value="option1"
                            checked>
                        <label class="form-check-label" for="radio-179">Very good</label>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" name="group1" type="radio" id="radio-279" value="option2">
                        <label class="form-check-label" for="radio-279">Good</label>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" name="group1" type="radio" id="radio-379" value="option3">
                        <label class="form-check-label" for="radio-379">Mediocre</label>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" name="group1" type="radio" id="radio-479" value="option4">
                        <label class="form-check-label" for="radio-479">Bad</label>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                    <div class="form-check mb-4">
                        <input class="form-check-input" name="group1" type="radio" id="radio-579" value="option5">
                        <label class="form-check-label" for="radio-579">Very bad</label>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
                    </div>
                    <!-- Radio -->

                    <div class="modal-footer justify-content-center">
                        <a type="button" class="btn btn-primary waves-effect waves-light">Send
                            <i class="fa fa-paper-plane ml-1"></i>
                        </a>
                        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Cancel</a>
                    </div>
                    <p class="date"> 11/11/2020 </p>
                </div>

                <!-- STOP HERE -->
            </div>


        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Navbar -->
    <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>