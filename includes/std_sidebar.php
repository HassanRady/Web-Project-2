<?php
include "functions.php";
include_once dirname(__FILE__, 2)."\\paths.php";
include_once dirname(__FILE__, 1) .DIRECTORY_SEPARATOR. "functions.php";
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
        <a href="announcements.html">Home</a>
    </li>
    <li>
        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Courses</a>
        <ul class="collapse list-unstyled" id="pageSubmenu">
        <li>
            <a href="<?php echo $my_courses_path_student ?>">My Courses</a>
        </li>
        <li>
            <a href="course_registration.html">All Courses</a>
        </li>
        </ul>
    </li>
    <li>
        <a href="<?php echo $my_profile_path ?>">My Profile</a>
    </li>
    <li>
        <a href="timetable.html">Timetable</a>
    </li>
    </ul>

    <ul class="list-unstyled CTAs">
    <li>
        <form method="post">
            <input type="submit" class="cta-logout" name="logout-btn" value="Logout">
        </form>

    </li>
    </ul>
</nav>
