<?php
ob_start();
include "../includes/functions.php";
include "../includes/Admin/admin_functions.php";
// session_start();

$level = "1";

if(isset($_GET['level'])){
    $level = $_GET["level"];
// }else{
//     header("Location: announcements.php");
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
        <?php include "../includes/admin_sidebar.php"; ?>
        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fas fa-align-left"></i>
                    </button>
                    <a class="navbar-brand" id="page-title" href="#">Timetable</a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto secondary-navigation">
                            <li class="nav-item <?php if($level == 1) echo 'active'; ?> ">
                                <a class="nav-link" href="timetable.php?level=1">Level 1</a>
                            </li>
                            <li class="nav-item <?php if($level == 2) echo 'active'; ?> ">
                                <a class="nav-link" href="timetable.php?level=2">Level 2</a>
                            </li>
                            <li class="nav-item <?php if($level == 3) echo 'active'; ?>">
                                <a class="nav-link" href="timetable.php?level=3">Level 3</a>
                            </li>
                            <li class="nav-item <?php if($level == 4) echo 'active'; ?>">
                                <a class="nav-link" href="timetable.php?level=4">Level 4</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
            <div class="page-body">
                <!-- START HERE -->
                <table class="table table-borderless table-responsive-lg">
                    <tbody>
                        <?php
                        $timetable = getAdminTimetable($level);
                        if ($timetable) {
                            // timetable exists
                            foreach($timetable as $day => $data){
                                // day row
                                /*********************************************************** DAY OPEN */
                                ?> 
                                <tr class='table-row' >
                                    <td class='table-cell day-cell' style='color: black;'> <?php echo ucfirst($day) ?></td>
                                <?php
                                //output data
                                $length = count($data);
                                $numItems = 0;
                                for($i = 0; $i < $length; $i++){
                                    // echo map_location($data[$i]['vid']);
                                    if($i == $length -1){
                                        /*********************************************************** REGULAR OUTPUT */
                                        ?> 
                                        <td class='table-cell content-cell'>
                                            <span class='name'>
                                                <?php echo $data[$i]['cname']; ?>
                                            </span>
                                            <span class='type'>
                                                <?php echo $data[$i]['type'] . " (" . $data[$i]['freq'] . ")" ; ?>
                                            </span>
                                            <span class='instructor'>
                                                <?php echo $data[$i]['first_name'] . " " . $data[$i]['last_name']; ?>
                                            </span>
                                            <div class='description'>
                                                <span>
                                                    <?php echo substr($data[$i]['start'], 0 , 5) . " - " . substr($data[$i]['end'], 0 , 5); ?> / 
                                                </span>
                                                <a href='../map.php?venue_id=<?php echo $data[$i]['vid']; ?>' class='location'>
                                                    <?php echo $data[$i]['vname']; ?>
                                                </a>
                                            </div>
                                        </td>
                                        <?php
                                        //end of length if
                                    }else{
                                        //we can look into the next one
                                        $current = (int)substr($data[$i]['start'], 0, 2);
                                        $next = (int)substr($data[$i+1]['start'], 0, 2);
                                        if($next == $current){
                                            $array = array();
                                            while($next == $current && $i != $length -1){
                                                array_push($array, $data[$i]);
                                                $current = (int)substr($data[$i]['start'], 0, 2);
                                                $next = (int)substr($data[$i+1]['start'], 0, 2);
                                                $i++;
                                            }
                                            
                                            // open container
                                            /*********************************************************** CONTAINER OPEN */
                                            echo "<td class='table-cell '>";
                                            /*********************************************************** MULTIPLE DATA */
                                            for($j = 0; $j < count($array); $j++){
                                                    ?> 
                                                    <div class='content-cell'>
                                                        <span class='name'>
                                                            <?php echo $array[$j]['cname']; ?>
                                                        </span>
                                                        <span class='type'>
                                                            <?php echo $array[$j]['type'] . " (" . $array[$j]['freq'] . ")" ; ?>
                                                        </span>
                                                        <span class='instructor'>
                                                            <?php echo $array[$j]['first_name'] . " " . $array[$j]['last_name']; ?>
                                                        </span>
                                                        <div class='description'>
                                                            <span>
                                                                <?php echo substr($array[$j]['start'], 0 , 5) . " - " . substr($array[$j]['end'], 0 , 5); ?> / 
                                                            </span>
                                                            <a href='../map.php?venue_id=<?php echo $array[$i]['vid']; ?>' class='location'>
                                                                <?php echo $array[$j]['vname']; ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <?php
                                                if($j < count($array) - 1){
                                                    echo "<hr>";
                                                }
                                            }
                                            
                                            if($i < $length){
                                                $i--;
                                            }
                                            /*********************************************************** CONTAINER CLOSE */
                                            echo "</td>";
                                        }else{
                                            /*********************************************************** REGULAR OUTPUT */
                                            ?> 
                                        <td class='table-cell content-cell'>
                                            <span class='name'>
                                                <?php echo $data[$i]['cname']; ?>
                                            </span>
                                            <span class='type'>
                                                <?php echo $data[$i]['type'] . " (" . $data[$i]['freq'] . ")" ; ?>
                                            </span>
                                            <span class='instructor'>
                                                <?php echo $data[$i]['first_name'] . " " . $data[$i]['last_name']; ?>
                                            </span>
                                            <div class='description'>
                                                <span>
                                                    <?php echo substr($data[$i]['start'], 0 , 5) . " - " . substr($data[$i]['end'], 0 , 5); ?> / 
                                                </span>
                                                <a href='../map.php?venue_id=<?php echo $data[$i]['vid']; ?>' class='location'>
                                                    <?php echo $data[$i]['vname']; ?>
                                                </a>
                                            </div>
                                        </td>
                                        <?php
                                            //end of time comparison else
                                        }
                                        //end of length else
                                    }
                                    // end of for loop
                                }
                                /*********************************************************** DAY CLOSE */
                                echo "</tr>";
                                //end of day row
                            //end of foreach
                            }
                        }else{
                            // timetable doesn't exist
                            /*********************************************************** ERROR TEXT */
                            echo "timetable doesn't exist";

                        }

                        ?>
                    </tbody>
                </table>
                <a href="../map.php?venue_id=24" class="btn btn-primary btn-block">Map</a>
                <!-- STOP HERE -->
            </div>
        </div>
    </div>

    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="rootJS.js"></script>

</body>

</html>