<?php
ob_start();
include "../includes/functions.php";
include "../includes/sas/functions.php";
session_start();

$std_id = "";

if(isset($_GET['std_id'])){
    $std_id = $_GET["std_id"];
}else{
    header("Location: announcements.php");
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
        <?php include "../includes/std_sidebar.php"; ?>
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
                        /*
                        * OMAR
                        * @param int $std_id : the ID of the student whose table we want 
                        * @return an associative array with the weekdays as keys and the information as an array of values
                        */
                        function getStudentTimetable($std_id){
                            global $conn;
                            $semester = getCurrentSemester();
                            $query = "SELECT
                            courses.name AS cname,
                            v.name AS vname,
                            c.type,
                            c.start,
                            c.end,
                            c.freq,
                            u.first_name,
                            u.middle_name,
                            u.last_name,
                            c.students_group,
                            c.day
                        FROM
                            open_courses oc
                        INNER JOIN courses ON oc.course_id = courses.course_id
                        INNER JOIN course_semester_students css ON
                            oc.course_id = css.id_course
                        INNER JOIN classes c ON
                            oc.course_id = c.id_course
                        INNER JOIN venues v ON
                            c.id_venue = v.venue_id
                        INNER JOIN instructors i ON
                            i.instructor_id = c.instructor_id
                        INNER JOIN users u ON
                            u.id = i.id_user
                        WHERE
                            css.id_student = $std_id AND css.id_semester = $semester
                        ORDER BY CASE
                            c.day WHEN 'saturday' THEN 1 WHEN 'sunday' THEN 2 WHEN 'monday' THEN 3 WHEN 'tuesday' THEN 4 WHEN 'wednesday' THEN 4 WHEN 'thursday' THEN 4
                        END,
                        c.start ASC";
                            $query_result = mysqli_query($conn, $query);
                            $result_array = array();
                            while($row = mysqli_fetch_assoc($query_result)){
                                $day = $row['day'];
                                $start = $row['start'];
                                $end = $row['end'];
                                if(!array_key_exists($day, $result_array)){
                                    $result_array[$day] = array();
                                }
                                array_push($result_array[$day], $row);
                            }
                            // print_r($result_array);
                            return $result_array;
                            
                        }
                        $timetable = getStudentTimetable($std_id);

                        foreach($timetable as $day => $data){
                        ?>
                        <tr class="table-row">
                            <td class="table-cell day-cell" style="color:black" ;><?php echo ucfirst($day) ?></td>
                            <?php for($i = 0; $i < count($data); $i++) {

                                ?>
                                <td class="table-cell content-cell">
                                    <span class="name"><?php echo $data[$i]['cname'] ?></span>
                                    <span class="type"><?php echo ucfirst($data[$i]['type']) . " (" . $data[$i]['freq'] . ")" ?></span>
                                    <span class="instructor"><?php echo $data[$i]['first_name'] . " " . $data[$i]['last_name'] ?></span>
                                    <div class="description"><span><?php echo substr($data[$i]['start'], 0, 5) . "-" . substr($data[$i]['end'], 0, 5)  ?> / </span><a href="#" class="location"><?php echo $data[$i]['vname'] ?></a>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>

                        
                        <!-- <tr class="table-row">
                            <td class="table-cell day-cell" style="color:black" ;>Sunday</td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="table-cell day-cell" style="color:black" ;>Monday</td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>

                        </tr>
                        <tr class="table-row">
                            <td class="table-cell day-cell" style="color:black" ;>Tuesday</td>

                        </tr>
                        <tr class="table-row">
                            <td class="table-cell day-cell" style="color:black" ;>Wednesday</td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
                            <td class="table-cell day-cell" style="color:black" ;>Thursday</td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>

                        </tr> -->


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