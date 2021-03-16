<?php 
include_once dirname(__FILE__, 2) ."\\utils\\helper.php";

$semester = getCurrentSemester();


/*
* OMAR
* @param int $id : the ID of the instructor whose timetable we want 
* @return an associative array with the weekdays as keys and the information as an array of values
*/
function getInstructorTimetable($id){
    global $conn;
    $query = "SELECT
    c.name AS cname,
    v.name AS vname,
    cl.type,
    cl.start,
    cl.end,
    cl.freq,
    cl.students_group,
    cl.day
,v.venue_id
    FROM
        classes cl
    INNER JOIN courses c on c.course_id = cl.id_course
    INNER JOIN venues v on v.venue_id = cl.id_venue
    INNER JOIN instructors i ON
            i.instructor_id = cl.id_instructor
    INNER JOIN users u ON u.id = i.id_user
    WHERE
        cl.id_instructor = $id
    ORDER BY CASE
        cl.day WHEN 'saturday' THEN 1 WHEN 'sunday' THEN 2 WHEN 'monday' THEN 3 WHEN 'tuesday' THEN 4 WHEN 'wednesday' THEN 4 WHEN 'thursday' THEN 4
    END,
    cl.start ASC";
    $query_result = mysqli_query($conn, $query);
    $result_array = array();
    if($query_result){
        while($row = mysqli_fetch_assoc($query_result)){
            $day = $row['day'];
            if(!array_key_exists($day, $result_array)){
                $result_array[$day] = array();
            }
            array_push($result_array[$day], $row);
        }
        return $result_array;
    }else{
        return false;
    }
    
}


/* OMAR
 * @param int $courseId : the course whose student marks is returned
 * @return a resultset containing the arabic name and grades of each student registered in the course
 */
function getRegisteredStudentsMarks($courseId)
{
    global $conn;
    global $semester;
    $query = "SELECT id_student, arabic_name, grade, gpa, oral, midterm, course_work, practical, final FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    return $query_result;
}

/* OMAR
 * @param int $courseId : the course whose student marks are submitted
 */
function updateStudentGrades($courseId){
    global $conn;
    global $semester;
    $elements = count($_POST['grade']);

    for ($i = 0; $i < $elements; $i++) {
        $id = $_POST["grade"][$i]['id'];
        $midterm = $_POST['grade'][$i]['midterm'];
        $oral = $_POST['grade'][$i]['oral'];
        $practical = $_POST['grade'][$i]['practical'];
        $cw = $_POST['grade'][$i]['cw'];
        $final = $_POST['grade'][$i]['final'];
        $query = "UPDATE `course_semester_students`
        SET
        `oral`=$oral,
        `midterm`=$midterm,
        `course_work`=$cw,
        `practical`=$practical,
        `final`=$final
         WHERE `id_semester`=$semester AND `id_course`=$courseId AND `id_student`=$id";
        $result = mysqli_query($conn, $query);
        checkResultQuery($result, $conn, "updateStudentGrades id=$id");
    }
    // echo "<meta http-equiv='refresh' content='0'>";
    return true;
}

?>
