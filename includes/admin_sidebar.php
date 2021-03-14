<?php
/**
 * @author Hassan
 */


include_once dirname(__FILE__, 2)."\\paths.php";
include_once "functions.php";
?>
<?php 
if(isset($_POST['logout-btn'])){
    logout();
}

?>


<nav id="sidebar">
            <div class="sidebar-header">
                <img src="<?php echo $logo_path ?>" alt="SIM-LOGO">
            </div>
            <p>Navigation</p>
            <ul class="list-unstyled components">
                <li>
                    <a href="<?php echo $announcements_path ?>">Home</a>
                </li>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Users</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="<?php echo $students_list_path ?>">Students</a>
                        </li>
                        <li>
                            <a href="<?php echo $professors_list_path ?>">Professors</a>
                        </li>
                        <li>
                            <a href="<?php echo $tas_list_path ?>">Teaching Assistants</a>
                        </li>
                        <li>
                            <a href="<?php echo $sas_list_path ?>">Student Affairs</a>
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
                            <a href="<?php echo $open_courses_path;?>">Open Courses</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo $my_profile_path ?>">My Profile</a>
                </li>
                <li>
                    <a href="<?php echo $timetable_admin_path ?>">Timetable</a>
                </li>
                <li>
                    <a href="<?php echo $venues_path ?>">Venues</a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <form method="post">
                    <button type="submit" class="btn btn-block cta-logout" style="background-color: #fafafa; color: red;" name="logout-btn" value="Logout">Logout</button>
                </form>
            </ul>
        </nav>