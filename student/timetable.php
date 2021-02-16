<?php
ob_start();
include "../includes/functions.php";
include "../includes/sas/functions.php";
session_start();
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
                        function getStudentTimetable(){
                            global $conn;
                            global $semester;
                            $query = "SELECT courses.name, v.name, c.type, c.start, c.end, c.instructor_id, c.freq, u.first_name, u.middle_name, u.last_name, c.students_group, c.day FROM open_courses oc INNER JOIN courses on oc.course_id = courses.course_id INNER JOIN course_semester_students css ON oc.course_id = css.id_course INNER JOIN classes c on oc.course_id = c.id_course INNER JOIN venues v on c.id_venue = v.venue_id INNER JOIN instructors i on i.instructor_id = c.instructor_id INNER JOIN users u on u.id = i.id_user WHERE css.id_student = 1952320201 AND css.id_semester = 7 ORDER BY c.start ASC ";
                            $query_result = mysqli_query($conn, $query);
                            $result_array = array(
                                // "saturday"=>array(),
                                // "sunday"=>array(),
                                // "monday"=>array(),
                                // "tuesday"=>array(),
                                // "wednesday"=>array(),
                                // "thursday"=>array(),
                            );
                            while($row = mysqli_fetch_assoc($query_result)){
                                $day = $row['day'];
                                if(!array_key_exists($day, $result_array)){
                                    $result_array[$day] = array();
                                }
                                array_push($result_array[$day], $row);
                            }
                            print_r($result_array);
                        }
                        getStudentTimetable()
                        ?>

                        <tr class="table-row">
                            <td class="table-cell day-cell" style="color:black" ;>Saturday</td>
                            <td class="table-cell content-cell">
                                <span class="name">Web Programming</span>
                                <span class="type">(Lecture)</span>
                                <span class="instructor">Prof. Omar Khalid</span>
                                <div class="description"><span>8-10 / </span><a href="#" class="location">Hall 9</a>
                                </div>
                            </td>
                        </tr>
                        <tr class="table-row">
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

                        </tr>


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