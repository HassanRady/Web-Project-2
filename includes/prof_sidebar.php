<?php
/**
 * @author Hassan
 */


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
            <a href="<?php echo $announcements_path ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo $my_courses_path_professor ?>">My Courses</a>
        </li>
        <li>
            <a href="<?php echo $my_profile_path ?>">My Profile</a>
        </li>
        <li>
            <a href="<?php echo $timetable_professor_path ?>">Timetable</a>
        </li>
    </ul>
    <ul class="list-unstyled CTAs">
        <li>
            <form method="post">
                <button type="submit" class="btn btn-block cta-logout" style="background-color: #fafafa; color: red;" name="logout-btn" value="Logout">Logout</button>

            </form>
        </li>
    </ul>
</nav>
