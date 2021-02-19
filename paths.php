<?php

$root ="Web-Project-2"; # "Web-Project-2" is the root directory before "web project" is the "htdocs"
$logo_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "media" .DIRECTORY_SEPARATOR. "logo.jpeg";
$my_profile_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "my_profile.php";


// Admin's paths
$admin_sidebar_path = __DIR__ .DIRECTORY_SEPARATOR. "includes" .DIRECTORY_SEPARATOR. "admin_sidebar.php";
$all_courses_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "admin" .DIRECTORY_SEPARATOR. "available_courses_t.php";
$venues_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR."admin" .DIRECTORY_SEPARATOR. "venues.php";
$students_list_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "admin" .DIRECTORY_SEPARATOR. "Students.php";
$professors_list_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "admin" .DIRECTORY_SEPARATOR. "Professors.php";
$tas_list_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "admin" .DIRECTORY_SEPARATOR. "ta_list.php";
$sas_list_path = DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "admin" .DIRECTORY_SEPARATOR. "sa_list.php";


// Student's paths
$student_sidebar_path = __DIR__ .DIRECTORY_SEPARATOR. "includes" .DIRECTORY_SEPARATOR. "std_sidebar.php";
$my_courses_path =  DIRECTORY_SEPARATOR. $root .DIRECTORY_SEPARATOR. "student" .DIRECTORY_SEPARATOR. "my_courses_std.php";


$professor_sidebar_path = __DIR__ .DIRECTORY_SEPARATOR. "includes" .DIRECTORY_SEPARATOR. "prof_sidebar.php";