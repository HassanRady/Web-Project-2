<!DOCTYPE html>
<?php include '../includes/functions.php'; ?>
<?php
if(isset($_POST['edit'])){
update_venue();
}
if(isset($_POST['remove'])){
    remove_venue();
}

if(isset($_POST['Add'])){
    add_venue();
}
?>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Collapsible sidebar using Bootstrap 4</title>
  <link rel="stylesheet" href="css/venues.css">
  <!-- <link rel="stylesheet" href="css/available_courses.css"> -->

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
    integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="../css/rootStyles.css">
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
  <?php
            include dirname(__FILE__, 2) . "\\includes\\admin_sidebar.php";
        ?>
    <!-- Page Content  -->
    <div id="content">

      <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="btn btn-primary">
            <i class="fas fa-align-left"></i>
            <!-- <span id="nav-toggle-text">Navigation</span> -->
          </button>
          <a class="navbar-brand" id="page-title" href="#">Venues</a>
          <div class="ml-auto"></div>
      </nav>


      <!--page body-->

      <div class="page-body">
        <!-- START HERE -->
          <!-- Modal -->
          <form method="post" enctype="multipart/form-data">
          <div class="modal conbody fade" id="Add_Form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
               aria-hidden="true">
              <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Add Venue</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                          <label class="label" for="venuename">Venue Name</label>
                          <input type="text" name="venue_name" class="form-control" id="venuename">
                          <br />
                          <label class="label" for="venuelocation">Venue Location</label>
                          <input type="file" name="venue_location" class="form-control" id="vanuelocation">


                      </div>
                      <div class="modal-footer">

                          <button type="submit" name="Add" class="btn btn-primary">Add</button>
                          <button type="button" class="btn btn-outline-danger " data-dismiss="modal" >Close</button>

          </form>

      </div>
                  </div>
              </div>
          </div>
          <div class="container-fluid">
          <div class="row justify-content-end">
              <button type="button" class="btn btn-primary btn-block w-25 " data-toggle="modal" data-target="#Add_Form">
                  Add Venue
              </button>
          </div>
      </div>
        <hr class="mb-4">
        
          <?php   Display_venues();?>

        </div>

        <!-- <a href="#" class="btn btn-outline-danger">Remove</a> -->
      </div>



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