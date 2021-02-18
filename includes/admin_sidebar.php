<?php
include_once "..\\includes\\utils\\variables.php";
?>

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
                            <a href="<?php echo $students_list_paht ?>">Students</a>
                        </li>
                        <li>
                            <a href="Professors.php">Professors</a>
                        </li>
                        <li>
                            <a href="ta_list.php">Teaching Assistants</a>
                        </li>
                        <li>
                            <a href="sa_list.php">Student Affairs</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Courses</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="<?php echo $all_courses_path;?>">All Courses</a>
                        </li>
                        <li>
                            <a href="available_courses.html">Open Courses</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $my_profile_path ?>">My Profile</a>
                </li>
                <li>
                    <a href="timetable.html">Timetable</a>
                </li>
                <li>
                    <a href="<?php echo $venues_path ?>">Venues</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <li>
                    <a href="#" class="cta-logout" id="logout-btn">Logout</a>
                </li>
            </ul>
        </nav>