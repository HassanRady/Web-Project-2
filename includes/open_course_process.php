<?php
ob_start();
include "functions.php";

$courseId = $_GET['course_id'];

if(checkIfCourseIsOpen($courseId)){
    header("Location: open_courses.php#$courseId");
}else{
    header("Location: course_open.php?course_id=$courseId");
}

?>