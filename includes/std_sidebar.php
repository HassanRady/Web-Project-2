<?php
include_once dirname(__FILE__, 2)."\\paths.php"; 
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
            <a href="<?php echo $my_courses_path ?>">My Courses</a>
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
        <a href="login.php" class="cta-logout" id="logout-btn">Logout</a>
    </li>
    </ul>
</nav>
