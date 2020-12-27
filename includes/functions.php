<?php 
  include "db_conn.php";


  /******************************** Global variables **********************************/
  $semester = getCurrentSemester();

  
  
  
  
  
  
  
  
  
  /******************************** FUNCTIONS **********************************/
  
  //get the last semester_id in the database;
  function getCurrentSemester(){
    global $conn;
    $query = "SELECT semester_id FROM semesters ORDER BY semester_id DESC LIMIT 1";
    $query_result = mysqli_query($conn, $query);
    if($query_result){
      $result = mysqli_fetch_assoc($query_result);
      return $result['semester_id'];
    }else{
      return -1;
    }

  }


  //check the result of the query
  function checkQuery($query_result){
    global $conn;
    if(!$query_result){
      die(mysqli_error($conn));
    }
  }


  //get registered students in a course
  function getRegisteredStudents($courseId){
      global $conn;
      global $semester;
      $query = "SELECT id_student, arabic_name, level, student_group FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);
      $i = 1;
      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row["arabic_name"];
          $id = $row['id_student'];
          $level = $row['level'];
          $group = $row['student_group'];
          echo "
          <tr>
              <th scope='row'>$i</th>
              <th scope='row'>$id</th>
              <td>$name</td>
              <td>$level</td>
              <td>$group</td>
          </tr>";
          $i++;
      }
  }


  //get the mark breakdown of all registered students in a course
  function getRegisteredStudentsMarks($courseId){
      global $conn;
      global $semester;
      $query = "SELECT id_student, arabic_name, grade, gpa, oral, midterm, course_work, practical, final FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);

      // echo mysqli_error($conn);

      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row["arabic_name"];
          $id = $row['id_student'];
          $grade = $row['grade'] ? $row['grade'] : "F";
          $gpa = $row['gpa'];
          $oral = $row['oral'];
          $mid = $row['midterm'];
          $cw = $row['course_work'];
          $practical = $row['practical'];
          $final = $row['final'];
          $total = $mid+$oral+$cw+$practical+$final;
          echo "
          <tr>
              <th scope='row'>$id</th>
              <td>$name</td>
              <td>$mid</td>
              <td>$oral</td>
              <td>$practical</td>
              <td>$cw</td>
              <td>$final</td>
              <td>$total</td>
              <td>$grade</td>
              <td>$gpa</td>
          </tr>";  
      }
  }


  function getRegisteredStudentsMarksForEdit($courseId){
      global $conn;
      global $semester;
      $query = "SELECT id_student, arabic_name, grade, gpa, oral, midterm, course_work, practical, final FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);

      // echo mysqli_error($conn);

      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row["arabic_name"];
          $id = $row['id_student'];
          $grade = $row['grade'] ? $row['grade'] : "F";
          $gpa = $row['gpa'];
          $oral = $row['oral'];
          $mid = $row['midterm'];
          $cw = $row['course_work'];
          $practical = $row['practical'];
          $final = $row['final'];
          echo "
          <tr>
            <td>$id</td>
            <td>$name</td>
            <td><input type='number' name='midterm' value='$mid'></td>
            <td><input type='number' name='oral' value='$oral'></td>
            <td><input type='number' name='practical' value='$practical'></td>
            <td><input type='number' name='cw' value='$cw'></td>
            <td><input type='number' name='final' value='$final'></td>
          </tr>"; 
      }
  }


  function getInstructorCourses($instructorId){
      global $conn;
      global $semester;
      $query = "SELECT oc.course_id, level, student_count, name FROM open_courses oc INNER JOIN open_courses_instructors oci ON oc.course_id = oci.course_id
      INNER JOIN courses c ON oc.course_id = c.course_id WHERE instructor_id = $instructorId ";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
          $name = $row['name'];
          $id = $row['course_id'];
          $level = $row['level'];
          $count = $row['student_count'];
          echo"
            <div class='col-sm-12 col-md-6 col-lg-4 col-xl-3 course-item'>
            <a href='discussion.php?course_id=$id&sem_id=$semester' class='cbox'>
              <div class='course-title'>
                $name
              </div>
              <div class='course-info'>
                Level: $level
              </div>
              <div class='course-info'>
                Students: $count
              </div>
            </a>
            </div>              
          "; 
      }
  }


  function getStudentCourses($studentId){
      global $conn;
      global $semester;
      $query = "SELECT c.course_id, c.name, u.first_name, u.last_name FROM course_semester_students css 
      INNER JOIN courses c ON css.id_course = c.course_id
      INNER JOIN open_courses_instructors oci ON oci.course_id = c.course_id
      INNER JOIN instructors i on oci.instructor_id = i.instructor_id
      INNER JOIN users u on i.id_user = u.id 
      WHERE css.id_student = $studentId AND (u.type = 'professor' or u.type='admin')";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
          $fname = $row['first_name'];
          $lname = $row['last_name'];
          $cname = $row['name'];
          $id = $row['course_id'];
          echo"
            <div class='col-sm-12 col-md-6 col-lg-4 col-xl-3 course-item'>
            <a href='discussion.php?std_id=$studentId&course_id=$id&sem_id=$semester' class='cbox'>
              <div class='course-title'>
                $cname
              </div>
              <div class='course-info'>
                Prof. $fname $lname
              </div>
            </a>
            </div>              
          "; 
      }
  }

  function getStudentMarksForCourse($courseId, $std_id){
    global $conn;
    global $semester;
      $query = "SELECT * FROM course_semester_students WHERE id_student = $std_id AND id_course = $courseId AND id_semester = $semester";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
          $mid = $row['midterm'];
          $oral = $row['oral'];
          $cw = $row['course_work'];
          $practical = $row['practical'];
          $final = $row['final'];
          $total = $mid + $oral + $cw + $practical + $final;
          echo"
          <tr>
            <td>$mid</td>
            <td>$oral</td>
            <td>$cw</td>
            <td>$practical</td>
            <td>$final</td>
            <td>$total</td>
          </tr>              
          "; 
      }
  }

  function getCourseMaterial($courseId){
    global $conn;
    global $semester;
      $query = "SELECT m.title, u.first_name, u.last_name, material_ref FROM materials m
      INNER JOIN users u ON u.id = m.id_user
      WHERE id_course = $courseId AND semester_id = $semester";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
        $title = $row['title'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $material = $row['material_ref'];
        echo "<div class='container-fluid'>
        <div class='row conbody  text-center text-lg-left'>
          <div class='col-lg-5 text' >
            <a href='$material' target='_blank' class='a'>$title</a>
          </div>
          <div class='col-lg-4 text'>
            <p>$fname $lname</p>
          </div>
          <div class='col-lg-3 btn-column'>
            <a href='../files/$material' download='$title' type='button' class='btn btn-primary btn-block'>Download</a>
          </div>
        </div>
      </div>";
            
      }      
  }



  function getCourseMaterialEditable($courseId){
    global $conn;
    global $semester;
      $query = "SELECT m.title, u.first_name, u.last_name, material_ref, material_id FROM materials m
      INNER JOIN users u ON u.id = m.id_user
      WHERE id_course = $courseId AND semester_id = $semester";
      $query_result = mysqli_query($conn, $query);

      while($row = mysqli_fetch_assoc($query_result)){
        $title = $row['title'];
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $material = $row['material_ref'];
        $material_id = $row['material_id'];
        echo "<div class='container-fluid'>
        <div class='row conbody  text-center text-lg-left' >
          <div class='col-lg-5 text' >
            <a href='$material' target='_blank' class='a'>$title</a>
          </div>
          <div class='col-lg-4 text'>
            <p>$fname $lname</p>
          </div>
          <div class='col-lg-3 btn-column'>
          <a  data-id='$material_id' data-title='$title' data-file='../files/$material' class='btn btn-primary btn-block launch-modal' data-toggle='modal' data-target='#modalContactForm'>Options</a>
          </div>
        </div>
      </div>";
      // <a href='../files/$material' download='$title' type='button' class='btn btn-primary btn-block'>Download</a>
            
      }      
  }


  


  function uploadMaterial ($file){
      $file_name = $file['name'];
      $file_tmp_name = $file['tmp_name'];
      $file_error = $file['error'];
      $file_size = $file['size'];
      $file_type = $file['type'];
  
      if($file_error === 0){
          $fname=explode('.' , $file_name);
          $new_file_name = uniqid('', true) . "." . strtolower(end($fname));
          $destination = "../files/". $new_file_name ;
          move_uploaded_file($file_tmp_name, $destination);
          return $destination;
      }

      return false;

  }


  function putMaterialInDB($courseId, $title, $location, $user_id){
    global $conn;
    global $semester;
    $title = mysqli_real_escape_string($conn, $title);
    $query = "INSERT INTO materials(id_course, id_user, title, material_ref, semester_id)
    VALUES('$courseId', '$user_id', '$title', '$location', '$semester')";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    
  }

  function updateMaterial($title, $location, $material_id){
    global $conn;
    $title = mysqli_real_escape_string($conn, $title);
    $query = "UPDATE materials SET
    title='$title',
    material_ref='$location'
    WHERE
    material_id=$material_id";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

  }

  function deleteMaterial($material_id){
    global $conn;
    $query = "DELETE FROM materials WHERE material_id=$material_id";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

  }


  function getCoursePrerequisite($courseId){
    global $conn;
    $prerequisite = "-" ;
    $preq_query = "SELECT name from prerequisites p
    INNER JOIN courses c on p.prerequisite_id = c.course_id
    WHERE p.id_course = $courseId";
    $preq_query_result = mysqli_query($conn, $preq_query);
    $data = mysqli_fetch_assoc($preq_query_result);
    if(mysqli_num_rows($preq_query_result)){
      $prerequisite = $data['name'];
    }
    return $prerequisite;
  }

  function getOpenCourses(){
    global $conn;
    $query = "SELECT c.name, c.course_id, c.credits, c.category, c.has_preq, u.first_name, u.last_name FROM open_courses oc
    INNER JOIN courses c ON c.course_id = oc.course_id
    INNER JOIN open_courses_instructors oci ON oci.course_id = oc.course_id
    INNER JOIN instructors i ON i.instructor_id = oci.instructor_id
    INNER JOIN users u ON u.id = i.id_user
    WHERE u.type = 'professor' OR u.type = 'admin'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while($row = mysqli_fetch_assoc($query_result)){
      $cname = $row['name'];
      $id = $row['course_id'];
      $credits = $row['credits'];
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $category = $row['category'];
      $has_preq = $row['has_preq'];
      $prerequisite = '-';

      if($category == 'sim'){
        $category = strtoupper($category);
      }else{
        $category = ucfirst($category);
      }

      if($has_preq == '1'){
        $preq_query = "SELECT name from prerequisites p
        INNER JOIN courses c on p.prerequisite_id = c.course_id
        WHERE p.id_course = $id";
        $preq_query_result = mysqli_query($conn, $preq_query);
        $data = mysqli_fetch_assoc($preq_query_result);
        if(mysqli_num_rows($preq_query_result)){
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
            <a href='#' class='btn btn-primary'>View</a>
            <a href='#' class='btn btn-outline-primary'>Add Class</a>
            <a href='#' class='btn btn-outline-secondary'>Options</a>
          </div>
        </div>
      </div>
      ";
  
  }
  }

function getAvailableUniCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='university'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $id = $row['course_id'];
    $credits = $row['credits'];
    $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
    $has_preq = $row['has_preq'];
    $prerequisite = getCoursePrerequisite($id);

    echo "
    <tr>
      <td>$id</td>
      <td>$cname</td>
      <td>$credits</td>
      <td>$type</td>
      <td>$prerequisite</td>
      <td><a href='#' class='btn btn-primary'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";

}
}

function getAvailableFacultyCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='faculty'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $id = $row['course_id'];
    $credits = $row['credits'];
    $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
    $has_preq = $row['has_preq'];
    $prerequisite = getCoursePrerequisite($id); 

    echo "
    <tr>
      <td>$id</td>
      <td>$cname</td>
      <td>$credits</td>
      <td>$type</td>
      <td>$prerequisite</td>
      <td><a href='#' class='btn btn-primary'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";
  }


}

function getAvailableSIMCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='sim'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $id = $row['course_id'];
    $credits = $row['credits'];
    $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
    $has_preq = $row['has_preq'];
    $prerequisite = getCoursePrerequisite($id);

    echo "
    <tr>
      <td>$id</td>
      <td>$cname</td>
      <td>$credits</td>
      <td>$type</td>
      <td>$prerequisite</td>
      <td><a href='#' class='btn btn-primary'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";

  }


}


function getAvailableFreeCourses(){
  global $conn;
  $query = "SELECT * FROM courses WHERE category='free'";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $cname = $row['name'];
    $credits = $row['credits'];
    $id = $row['course_id'];



    echo "
    <tr>
      <td>$cname</td>
      <td>$credits</td>
      <td><a href='#' class='btn btn-primary'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";

  }


}

function getCoursesAsOptionsEditable($prerequisite){
  global $conn;
  $query = "SELECT * FROM courses";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $id = $row['course_id'];
    $cname = $row['name'];
    if($id==$prerequisite){
      echo "
      <option value='$id' selected='selected'>$id - $cname</option>
      ";
    }else{
      echo "
      <option value='$id'>$id - $cname</option>
      ";
    }
    
  }
}

function getCoursesAsOptions(){
  global $conn;
  $query = "SELECT * FROM courses";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);

  while($row = mysqli_fetch_assoc($query_result)){
    $id = $row['course_id'];
    $cname = $row['name'];
    echo "
      <option value='$id'>$id - $cname</option>
    ";
  }
}

function addNewCourse($id, $name, $credits, $category, $type, $prerequisite, $practicalCheckbox, $sectionsCheckbox){
  global $conn;
  $course_name = $name;
  $course_id = $id;
  $course_credits = $credits;
  $course_category = $category;
  $course_type = $type;
  $course_prerequisite = $prerequisite;
  $course_practicalCheckbox = $practicalCheckbox == '1'? 1 : 0 ;
  $course_sectionsCheckbox = $sectionsCheckbox == '1'? 1 : 0;
  $course_has_prereq = $prerequisite == "" ? 0 : 1 ; 
  $query = "INSERT INTO courses(course_id, credits, has_preq, has_labs, has_practical, name, category, elective)
  VALUES('$course_id', '$course_credits', '$course_has_prereq', '$course_sectionsCheckbox', '$course_practicalCheckbox', '$course_name', '$course_category', '$course_type')";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if($course_has_prereq == 1){
    $preq_query = "INSERT INTO prerequisites(id_course, prerequisite_id) VALUES('$course_id', '$course_prerequisite')";
    $preq_query_result = mysqli_query($conn, $preq_query);
    checkQuery($preq_query_result); 
  }
}

function updateCourse($old, $id, $name, $credits, $category, $type, $prerequisite, $practicalCheckbox, $sectionsCheckbox){
  global $conn;
  $course_name = $name;
  $course_id = $id;
  $course_credits = $credits;
  $course_category = $category;
  $course_type = $type;
  $course_prerequisite = $prerequisite;
  $course_practicalCheckbox = $practicalCheckbox == '1'? 1 : 0 ;
  $course_sectionsCheckbox = $sectionsCheckbox == '1'? 1 : 0;
  $course_has_prereq = $prerequisite == "" ? 0 : 1 ; 
  $query = "UPDATE courses SET course_id = $course_id, credits= $course_credits, has_preq = $course_has_prereq,
  has_labs = $course_sectionsCheckbox, has_practical = $course_practicalCheckbox,
  name = '$course_name', category = '$course_category', elective = '$course_type'
   WHERE course_id = $old";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if($course_has_prereq == 1){
    $preq_query = "UPDATE prerequisites SET id_course = $course_id, prerequisite_id = $course_prerequisite WHERE id_course = $old";
    $preq_query_result = mysqli_query($conn, $preq_query);
    checkQuery($preq_query_result); 
  }
}

function deleteCourse($courseId){
  global $conn;
  $query = "DELETE FROM courses WHERE course_id = $courseId";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
}


function checkIfCourseIsOpen($courseId){
  global $conn;
  $query = "SELECT EXISTS (SELECT * FROM open_courses WHERE course_id = $courseId)";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if(mysqli_num_rows($query_result) == 1){
    return true;
  }
  return false;
}

function getCourseInfo($courseId){
  global $conn;
  $query = "SELECT * FROM courses WHERE course_id = $courseId";
  $query_result = mysqli_query($conn, $query);
  checkQuery($query_result);
  if(mysqli_num_rows($query_result) == 1){
    $row = mysqli_fetch_assoc($query_result);
    return $row;
  }
  return false;
}



?>