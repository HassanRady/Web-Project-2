<?php 

/*
* OMAR
* @param int $level : the level whose timetable is to be returned 
* @return an associative array with the weekdays as keys and the information as an array of values
*/
function getAdminTimetable($level){
    global $conn;
    $query = "SELECT
    c.name AS cname,
    v.name AS vname,
    cl.id_venue AS vid,
    cl.type,
    cl.start,
    cl.end,
    cl.freq,
    cl.students_group,
    cl.day,
    u.first_name,
    u.middle_name,
    u.last_name
    FROM
        classes cl
    INNER JOIN courses c ON
        c.course_id = cl.id_course
    INNER JOIN venues v ON
        v.venue_id = cl.id_venue
    INNER JOIN instructors i ON
        i.instructor_id = cl.id_instructor
    INNER JOIN users u ON
        u.id = i.id_user
    INNER JOIN open_courses oc ON
        oc.course_id = c.course_id
    WHERE 
        cl.level = $level
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
    }
    return false;
    
}
?>
