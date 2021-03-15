<!DOCTYPE html>
<?php

include "includes/Admin/callable_functions.php";
include "includes/utils/variables.php";
include_once "paths.php";

$location=$_GET["venue_id"];
?>
<html>

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Map</title>
    <?php include "includes/bootstrap_styles_start.php"; ?>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/rootStyles.css">

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


            <div class="container-fluid">


<hr class="mb-4">
<div class=" container-fluid">
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="map/<?php echo"". map_location($location);?>" allowfullscreen></iframe>
    </div>
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