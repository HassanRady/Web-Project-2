<?php
include_once dirname(__FILE__, 2) . "\\db_conn.php";

include_once dirname(__FILE__, 2) . "\\utils\\helper.php";
include_once dirname(__FILE__, 2) . "\\utils\\variables.php";

include_once dirname(__FILE__, 3) . "\\paths.php";



/*
* OMAR
* @param int $std_id : the ID of the student whose table we want 
* @return an associative array with the weekdays as keys and the information as an array of values
*/
function getStudentTimetable($std_id)
{
  global $conn;
  $semester = getCurrentSemester();
  $query = "SELECT
    c.name AS cname,
    v.name AS vname,
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
    INNER JOIN course_semester_students css ON
        css.id_course = cl.id_course
    INNER JOIN venues v ON
        v.venue_id = cl.id_venue
    INNER JOIN instructors i ON
        i.instructor_id = cl.id_instructor
    INNER JOIN users u ON
        u.id = i.id_user
    WHERE
        css.id_student = $std_id AND css.id_semester = $semester
    ORDER BY CASE
        cl.day WHEN 'saturday' THEN 1 WHEN 'sunday' THEN 2 WHEN 'monday' THEN 3 WHEN 'tuesday' THEN 4 WHEN 'wednesday' THEN 4 WHEN 'thursday' THEN 4
    END,
    cl.start ASC";
  // die($query);
  $query_result = mysqli_query($conn, $query);
  $result_array = array();
  if ($query_result) {
    while ($row = mysqli_fetch_assoc($query_result)) {
      $day = $row['day'];
      if (!array_key_exists($day, $result_array)) {
        $result_array[$day] = array();
      }
      array_push($result_array[$day], $row);
    }
    return $result_array;
  } else {
    return false;
  }
}


function getStudentCourses($studentId)
{
  global $conn, $discussion_student_path;
  $semester = getCurrentSemester();
  $query = "SELECT c.course_id, c.name, u.first_name, u.last_name FROM course_semester_students css 
      INNER JOIN courses c ON css.id_course = c.course_id
      INNER JOIN open_courses_instructors oci ON oci.course_id = c.course_id
      INNER JOIN instructors i on oci.instructor_id = i.instructor_id
      INNER JOIN users u on i.id_user = u.id 
      WHERE css.id_student = $studentId AND (u.type = 'professor' or u.type='admin')";
  $query_result = mysqli_query($conn, $query);
  checkResultQuery($query_result, $conn, "getStudentCourses");
  return $query_result;
}


/**
 * @author Hassan
 * @param int $studentId
 * @return void
 */
function getOpenCoursesForStudents($studentId)
{
  $query = "SELECT c.name, c.course_id, c.credits, c.category, c.has_preq, u.first_name, u.last_name FROM open_courses oc
    left JOIN (SELECT * FROM course_semester_students css WHERE css.id_student = $studentId) css ON css.id_course = oc.course_id
         JOIN courses c ON c.course_id = oc.course_id
         JOIN open_courses_instructors oci ON oci.course_id = oc.course_id
         JOIN instructors i ON i.instructor_id = oci.instructor_id
         JOIN users u ON u.id = i.id_user
        WHERE css.id_course is null;";
  $dataBaseConnection = connectToDataBase();
  $query_result = mysqli_query($dataBaseConnection, $query);
  checkResultQuery($dataBaseConnection, $query_result,  __FUNCTION__);

  while ($row = mysqli_fetch_assoc($query_result)) {
    $cname = $row['name'];
    $id = $row['course_id'];
    $credits = $row['credits'];
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $category = $row['category'];
    $has_preq = $row['has_preq'];
    $prerequisite = '-';

    if ($category == 'sim') {
      $category = strtoupper($category);
    } else {
      $category = ucfirst($category);
    }

    if ($has_preq == '1') {
      $preq_query = "SELECT name from prerequisites p
        INNER JOIN courses c on p.prerequisite_id = c.course_id
        WHERE p.id_course = $id";
      $preq_query_result = mysqli_query($dataBaseConnection, $preq_query);
      checkResultQuery($dataBaseConnection, $preq_query_result, __FILE__ . "/" . __FUNCTION__);
      $data = mysqli_fetch_assoc($preq_query_result);
      if (mysqli_num_rows($preq_query_result)) {
        $prerequisite = $data['name'];
      }
    }
    echo "
      <div class='conbody container-fluid'>
        <div class='row'>
          <div class='col-lg-5 col-md-12'>
            <table class='table table-borderless '>
              <tbody>
                <tr>
                  <th scope='row'>Course Name</th>
                  <td>$cname</td>
                </tr>
                <tr>
                  <th scope='row'>Course ID</th>
                  <td>$id</td>
                </tr>
                <tr>
                  <th scope='row'>Credit Hours</th>
                  <td>$credits</td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <div class='col-lg-5 col-md-12'>
            <table class='table table-borderless '>
              <tbody>
                <tr>
                  <th scope='row'>Professor</th>
                  <td>Prof. $fname $lname</td>
                </tr>
                <tr>
                  <th scope='row'>Prerequisites</th>
                  <td>$prerequisite</td>
                </tr>
                <tr>
                  <th scope='row'>Category</th>
                  <td>$category</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class='btn-grp col-lg-2 col-md-12'>
          <form action='' method='post'>
            <button name='submit' class='btn btn-primary'>Enroll</button>
            <input type='hidden' name='course_id' value=$id />
            </form>
          </div>
        </div>
      </div>
      ";
  }
  $dataBaseConnection->close();
}

/**
 * @author Hassan
 * @param int $enrolledHours
 * @return boolean
 */
function checkHours($enrolledHours)
{
  global $hoursLimit;
  if ($enrolledHours >= $hoursLimit)
    return false;
  else
    return true;
}

/**
 * @author Hassan
 * @param int $studentId
 * @return int
 */
function getEnrolledHours($studentId)
{
  $semester_id = getCurrentSemester();

  $query = "SELECT sum(c.credits) as hours FROM courses c
            JOIN (SELECT * FROM course_semester_students css WHERE css.id_student = $studentId and css.id_semester = $semester_id) css ON css.id_course = c.course_id;";

  $dataBaseConnection = connectToDataBase();
  $result = mysqli_query($dataBaseConnection, $query);
  checkResultQuery($result, $dataBaseConnection, __FUNCTION__ . '@' . __FILE__);

  $enrolledHours = (int) mysqli_fetch_assoc($result)['hours'];
  $dataBaseConnection->close();

  if (!$enrolledHours)
    $enrolledHours = 0;
  return $enrolledHours;
}

/**
 * @author Hassan
 * @param int $studentId
 * @param int $course_id
 * @return void
 */
function enrollToCourse($studentId, $course_id)
{
  $semester_id = getCurrentSemester();

  $enrolledHours = getEnrolledHours($studentId);
  $canEnroll = checkHours($enrolledHours);
  if (!$canEnroll)
    die("Hour Limit");

  $query = "INSERT INTO course_semester_students (id_student, id_course, id_semester) VALUES ($studentId, $course_id, $semester_id);";

  $dataBaseConnection = connectToDataBase();
  $result = mysqli_query($dataBaseConnection, $query);
  checkResultQuery($result, $dataBaseConnection, __FUNCTION__ . '@' . __FILE__);
  $dataBaseConnection->close();
}

/**
 * @author Hassan
 * @param int $studentId
 * @param int $course_id
 * @return void
 */
function unEnrollFromCourse($studentId, $courseId) {
  global $my_courses_path_student;
  $semester_id = getCurrentSemester();

  $query = "DELETE FROM course_semester_students WHERE id_course = $courseId AND id_student = $studentId;";

  $dataBaseConnection = connectToDataBase();
  $result = mysqli_query($dataBaseConnection, $query);
  checkResultQuery($result, $dataBaseConnection, __FUNCTION__ . '@' . __FILE__);
  $dataBaseConnection->close();

  header("Location: $my_courses_path_student");
}