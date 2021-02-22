<?php
ob_start();



$id = "";

if(isset($_GET['id'])){
    $id = $_GET["id"];
}else{
    header("Location: discussion.php");
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Timetable</title>
    <?php include "../includes/bootstrap_styles_start.php"; ?>
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../css/rootStyles.css">
    <link rel="stylesheet" href="css/timetable.css">

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar  -->
        <?php include "../includes/prof_sidebar.php"; ?>
        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fas fa-align-left"></i>
                    <!-- <span id="nav-toggle-text">Navigation</span> -->
                </button>
                <a class="navbar-brand" id="page-title" href="#">TITLE</a>
                <div class="ml-auto"></div>
            </nav>
            <div class="page-body">
                <!-- START HERE -->
                <table class="table table-borderless table-responsive-lg">
                    <tbody>
                        <?php
                        $timetable = getInstructorTimetable($id);
                        if ($timetable) {
                            foreach ($timetable as $day => $data) {
                                ?>
                                <tr class="table-row">
                                    <td class="table-cell day-cell" style="color:black" ;><?php echo ucfirst($day) ?></td>
                                    <?php for ($i = 0; $i < count($data); $i++) {
                                    ?>
                                        <td class="table-cell content-cell">
                                            <span class="name"><?php echo $data[$i]['cname'] ?></span>
                                            <span class="type"><?php echo ucfirst($data[$i]['type']) . " (" . $data[$i]['freq'] . ")" ?></span>
                                            <div class="description"><span><?php echo substr($data[$i]['start'], 0, 5) . "-" . substr($data[$i]['end'], 0, 5)  ?> / </span><a href="#" class="location"><?php echo $data[$i]['vname'] ?></a>
                                            </div>
                                        </td>
                                    <?php
                                } ?>
                                </tr>
                                <?php
                            }
                        }else{?>
                            <h3>No timetable data available. Please check again later.</h3>
                        <?php } ?>
                    </tbody>
                </table>
                <!-- STOP HERE -->
            </div>
        </div>
    </div>

    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="rootJS.js"></script>

</body>

</html>