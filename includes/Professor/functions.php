<?php 
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
    FROM
        classes cl
    INNER JOIN courses c on c.course_id = cl.id_course
    INNER JOIN venues v on v.venue_id = cl.id_venue
    INNER JOIN instructors i ON
            i.instructor_id = cl.instructor_id
    INNER JOIN users u ON u.id = i.id_user
    WHERE
        cl.instructor_id = $id
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
?>
