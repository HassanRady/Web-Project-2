<!DOCTYPE html>
<html>
<?php

$aid=$_GET['id'];



?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <link rel="stylesheet" href="unhand.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include "../includes/std_sidebar.php";
        $student=$_SESSION['id'];
        ?>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                        <!-- <span id="nav-toggle-text">Navigation</span> -->
                    </button>
                      <a class="navbar-brand" id="page-title" href="#">Dicussion</a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto secondary-navigation">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">ITEM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ITEM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ITEM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ITEM</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">ITEM</a>
                            </li>
                        </ul>
                    </div>
            </nav>




            <div class="page-body">
            <!-- START HERE -->
                <?php  student_view_assignment($aid,$student);
                if(isset($_POST['turn'])){
turnin($aid,$student);
                }
                if(isset($_POST['unturn'])){
                    unturnin($aid,$student);
                }
                ?>
<!--
<div class="row">
  <div class="col-lg-8">

            <h3 class="font-weight-bold" style=" color:rgb(31,108,236);">
              Assignment Title </h3>              <p class="handtime">
                            Due tomorrow at 11:59 pm
                          </p>
                        </div>
  <div class="col-lg-4">
    <p class="turntime handtime">
  Turned in Fri Dec 11, 2020 at 7:01 PM
    </p>
    <button type="submit" class="btn btn-primary  turnbutton">Undo Turn in</button>

</div>
                        </div>
 <hr class="mb-4 mt-1">
<div class="row">

    <div class="col-lg-6">


              <h6 class="Instructions">Instructions</h6>
              <p class="handtime">
                "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
              </p>


</div>


<div class="col-lg-6">
<h6> Points</h6>
<p class="points">
  10 points
</p>
</div>


</div>


<div class="row">
  <div class="col-lg-6">
    <h6 >My Work</h6>

<div class="custom-file">
    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
    <div class="invalid-feedback">Example invalid custom file feedback</div>
  </div>
</div>

</div>
<br><br> -->
            <!-- STOP HERE -->
            </div>


        </div>
    </div> </div>

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
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
</body>

</html>
