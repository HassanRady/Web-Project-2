<?php
// getting connection
include_once "db_conn.php";
include_once "utils\\variables.php";
include_once "utils\\helper.php";
include_once "Admin" . DIRECTORY_SEPARATOR . "utils" . DIRECTORY_SEPARATOR . "all.php";
include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "paths.php";
include_once dirname(__FILE__, 1) . DIRECTORY_SEPARATOR . "Admin" . DIRECTORY_SEPARATOR . "students" . DIRECTORY_SEPARATOR . "functions.php";

include_once dirname(__FILE__, 1) . DIRECTORY_SEPARATOR . "Admin" . DIRECTORY_SEPARATOR . "all_types" . DIRECTORY_SEPARATOR . "functions.php";





/******************************** Global variables **********************************/
$semester = getCurrentSemester();
/******************************** Global variables **********************************/


function login()
{
    global $conn, $semester, $studentsType, $professorsType, $tasType, $sasType, $adminsType, $announcements_path, $announcements_student_path;
    $name = $_POST['email'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn, $name);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "Select * FROM users WHERE email= '{$username}' ";
    $username_check = mysqli_query($conn, $query);
    if (!$username_check) {
        die("Failed" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($username_check)) {
        $id = $row['id'];
        $email = $row['email'];
        $pass = $row['password'];
        $first_name = $row['first_name'];
        $middle_name = $row['middle_name'];
        $last_name = $row['last_name'];
        $type = $row['type'];
    }

    if ($username == $email && password_verify($password, $pass)) {
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;

        $_SESSION['first_name'] = $first_name;
        $_SESSION['middle_name'] = $middle_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['type'] = $type;

        if ($type !== $studentsType) {
            $data = getInstructor($id);
            $_SESSION['id_instructor'] = $data['instructor_id'];
        } else {
            $data = getStudent($id);
            $_SESSION['student_id'] = $data['student_id'];
        }
        $_SESSION['semester_id'] = $semester;
        switch ($type) {
            case $studentsType:
                header("Location: $announcements_student_path");
                break;
                //change path here
            case $professorsType:
                header("Location: academic/my_courses_instructor.php");
                break;
                //change path here
            case $tasType:
                header("Location: $announcements_path");
                break;
            case $sasType:
                header("Location: $announcements_path");
                break;
            case $adminsType:
                header("Location: $announcements_path");
                break;
        }
    } else {
        header("Location: ./login.php");
    }
}
function map_location($venue_id){
    global $conn;
    $query = "Select venue_location FROM venues where venue_id='$venue_id' ";
    $venue_query = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($venue_query);
    $location=$row["venue_location"];
return $location;
}
function add_venue()
{
    global $conn;
    $venue_name = $_POST['venue_name'];
    $venue_location = $_FILES['venue_location']['name'];
    $venue_location_temp = $_FILES['venue_location']['tmp_name'];
    move_uploaded_file($venue_location_temp, "../map/$venue_location");
    // Create connection
    $venue_name = mysqli_real_escape_string($conn, $venue_name);
    $venue_location = mysqli_real_escape_string($conn, $venue_location);

    $mainSqlQuery = "INSERT INTO venues (name,venue_location) VALUE ('$venue_name','$venue_location') ";

    $venue_query = mysqli_query($conn, $mainSqlQuery);
    if (!$venue_query) {
        die("Failed" . mysqli_error($conn));
    }
}
function update_venue()
{
    global $conn;
    $venue_id = $_POST['venue_id_get'];
    $venue_name = $_POST['name'];
    $venue_location = $_FILES['venue_location']['name'];
    $venue_location_temp = $_FILES['venue_location']['tmp_name'];
    move_uploaded_file($venue_location_temp, "../map/$venue_location");
    // Create connection
    $venue_name = mysqli_real_escape_string($conn, $venue_name);
    $venue_id = mysqli_real_escape_string($conn, $venue_id);
    $mainSqlQuery = "UPDATE venues SET name='{$venue_name}', venue_location='{$venue_location}' WHERE venue_id='{$venue_id}' ";
    $venue_query = mysqli_query($conn, $mainSqlQuery);
    if (!$venue_query) {
        die("Failed" . mysqli_error($conn));
    }
}
function remove_venue()
{
    global $conn;
    $venue_id = $_POST['venue_id_get'];

    // Create connection
    $venue_id = mysqli_real_escape_string($conn, $venue_id);
    $mainSqlQuery = "Delete from venues WHERE venue_id='{$venue_id}' ";
    $venue_query = mysqli_query($conn, $mainSqlQuery);
    if (!$venue_query) {
        die("Failed" . mysqli_error($conn));
    }
}
function Display_venues()
{
    global $conn;
    $query = "Select * FROM venues ";
    $venue_query = mysqli_query($conn, $query);
    if (!$venue_query) {
        die("Failed" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($venue_query)) {
        $venue_name = $row['name'];
        $venue_id = $row['venue_id'];
        $venue_location = $row['venue_location'];

        echo "
        


<div class='row conbody  text-center text-lg-left '>
            <div class='col-lg-10'>


              <a href='../map.php?venue_id=$venue_id'>
              $venue_name
              </a>
            </div>
            <!-- Modal -->
           <form method='post' enctype = 'multipart/form-data'>
            <div class='modal fade' id='$venue_id' tabindex='-1' role='dialog' aria-labelledby='$venue_id'
              aria-hidden='true'>
              <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h5 class='modal-title' id='exampleModalLabel'>Edit Venue</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>
                  <div class='modal-body'>
                    <label class='label' for='vanuename'>Venue Name</label>
                    <input type='text' name='name' class='form-control' id='vanuename' value='$venue_name'>
                    <br />
                    <input type='hidden' id='idofthevenue' name='venue_id_get' value='$venue_id'>

                    <label class='label' for='venuelocation'>Venue Location</label>
                    <input type='file' name='venue_location' class='form-control' id='venuelocation'>


                  </div>
                  <div class='modal-footer'>

                    <button type='submit' name='edit' class='btn btn-primary'>Save changes</button>

                    <button type='submit' name='remove' class='btn btn-outline-danger'>Remove</button>
</form>


                  </div>
                </div>
              </div>
            </div>
            <div class='col-lg-2'>
              <button type='button' class='btn btn-primary btn-block ' data-toggle='modal' data-target='#$venue_id'>
                Option
                </button>

            </div>
          </div>
  ";
    }
}
function add_assignment($id_course, $id_instructor, $semester)
{
    global $conn;
    $title = $_POST['assignment-title'];
    $due_date = $_POST['due_date'];
    $publish_date = date('Y-m-d');
    $time = $_POST['time'];
    $assignment = $_FILES['assignment']['name'];
    $assignment_temp = $_FILES['assignment']['tmp_name'];
    move_uploaded_file($assignment_temp, "../media/$assignment");
    $description = $_POST['description'];
    // Need semester id and join on course id && semester id
    $mainSqlQuery = "INSERT INTO asignments (id_course,id_semester,id_instructor,title,due_time,due_date,publish_date, assignment ,description) VALUES ('$id_course', '$semester','$id_instructor','$title','$time','$due_date','$publish_date','$assignment','$description') ";
    $assignment_query = mysqli_query($conn, $mainSqlQuery);
    if (!$assignment_query) {
        die("Failed " . mysqli_error($conn));
    }
}
function show_prof_assignment($id_course, $semester)
{
    global $conn;
    $query = "Select * FROM asignments where id_course='$id_course' and id_semester='$semester' ";
    $assignments_query = mysqli_query($conn, $query);
    if (!$assignments_query) {
        die("Failed" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($assignments_query)) {
        $id = $row['assignment_id'];
        $courseid = $row['id_course'];
        $title = $row['title'];
        $due_date = $row['due_date'];
        $publish_date = $row['publish_date'];
        $time = $row['due_time'];
        $assignment = $row['assignment'];
        $id_instructor = $row['id_instructor'];
        echo "
 <div class='conbody container-fluid'>
<div class='row'>
    <div class='btn-grp col-lg-5 col-md-12'>
        <table class='table table-borderless '>
            <tbody>
                <tr>
                    <th scope='row'>Assignment</th>
                    <td>$title</td>
                </tr>
                <tr>
                    <th scope='row'>Due Date</th>
                    <td>$due_date  &nbsp;&nbsp;  $time</td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class='btn-grp col-lg-5 col-md-12'>
        <table class='table table-borderless '>
            <tbody>
                <tr>
                    <th scope='row'>File</th>
                    <td><a href='../media/$assignment'>$assignment</a></td>
                </tr>
                <tr>
                    <th scope='row'>Upload Date</th>
                    <td>$publish_date</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class=' col-lg-2 col-md-12'>
    <form method='post'>
      <input type='hidden'  name='id' value='$id'>
        <a href='assignment-answers-students.php?course_id=$courseid&sem_id=$semester&ass_id=$id' class='btn btn-primary btn-block '>View</a>
            <a class='btn btn-outline-secondary btn-block ' href='Edit_assignment.php?id=$id&course_id=$courseid&sem_id=$semester'>Edit</a>
        <button type='submit'  name='remove' class='btn btn-outline-danger btn-block '>Remove</button> </form>
    </div>



</div>
</div>



";
    }
}
function remove_prof_assignment()
{
    global $conn;
    $id = $_POST['id'];
    $mainSqlQuery = "Delete from asignments WHERE assignment_id='{$id}' ";
    $ass_query = mysqli_query($conn, $mainSqlQuery);
    if (!$ass_query) {
        die("Failed" . mysqli_error($conn));
    }
}
function edit_prof_assignment_show($id, $id_course, $semester)
{
    global $conn;
    $query = "Select * FROM asignments where assignment_id='$id' and id_course='$id_course' and id_semester='$semester' ";
    $assignments_query = mysqli_query($conn, $query);
    if (!$assignments_query) {
        die("Failed" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($assignments_query)) {
        //  $id=$row['assignment_id'];
        // $courseid=$row['id_course'];
        $title = $row['title'];
        $due_date = $row['due_date'];
        // $publish_date=$row['publish_date'];
        $time = $row['due_time'];
        $assignment = $row['assignment'];
        $description = $row['description'];
    }

    echo "   <div class='row'>
                <div class='col-md-12 order-md-1 col-lg-12'>
                    <h4 class='mb-3'>Update Assignment</h4>
                    <hr class='mb-4'>
                    <form class='needs-validation'  method='post' enctype='multipart/form-data'>
                        <div class='row'>
                            <div class='col-lg-4 col-md-12 mb-3'>
                                <label for='title'>Title</label>
                                <input type='text' class='form-control' name='assignment-title' id='title' placeholder='' value='$title'
                                       required>
                                <div class='invalid-feedback'>
                                    Valid title is required.
                                </div>
                            </div>
                            <div class='col-lg-2 col-md-12 mb-3'>
                                <label for='group'>Group</label>
                                <input name='group' type='text' name='group' class='form-control' id='group' placeholder='' value=''
                                       required>
                            </div>
                            <div class='col-lg-3 col-md-12 mb-3'>
                                <label for='due date'>Due Date</label>
                                <input type='date' name='due_date' class='form-control' id='due_date' placeholder='' value='$due_date'
                                       required>
                            </div>
                            <div class='col-lg-3 col-md-12 mb-3'>
                                <label for='time'>Time</label>
                                <input type='time' name='time' class='form-control' id='time' placeholder='' value='$time'
                                       required>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col-lg-12 mb-3'>
                                <label for='custom-file'>Upload file</label>
                                <div class='custom-file'>
                                    <input type='file' name='assignment' class='custom-file-input' id='customFile' required>
                                    <label class='custom-file-label' for='customFile'>$assignment</label>
                                </div>

                            </div>

                            <div class='col-lg-12 mb-3'>
                                <label for='aboutTextArea'>Description</label>
                                <textarea class='form-control' name='description' placeholder='What is required?' id='aboutTextArea'
                                          style='resize: none; height: 150px;'>$description</textarea>
                            </div>

                        </div>



                        <hr class='mb-4'>

                        <button class='btn btn-primary btn-lg btn-block' name='update' type='submit'>Update</button>
                    </form>
                    <br>
                </div>
            </div>";
}
function edit_prof_assignment($id)
{
    global $conn;
    $title = $_POST['assignment-title'];
    $due_date = $_POST['due_date'];

    $time = $_POST['time'];
    $assignment = $_FILES['assignment']['name'];
    $assignment_temp = $_FILES['assignment']['tmp_name'];
    move_uploaded_file($assignment_temp, "../media/$assignment");
    $description = $_POST['description'];
    $mainSqlQuery = "UPDATE  asignments SET title ='$title',
    due_time= '$time',
    due_date= '$due_date',
    assignment = '$assignment',
    description = '$description'WHERE assignment_id='$id' ";
    $Edit_query = mysqli_query($conn, $mainSqlQuery);
    if (!$Edit_query) {
        die("Failed" . mysqli_error($conn));
    }
}

function show_prof_student_assignments($id, $id_sem, $id_course)
{
    global $conn;
    $query = "SELECT css.id_student
,s.arabic_name, s.student_group 
,sa.student_assignment,sa.grade ,sa.handin_date, sa.handin_time FROM course_semester_students css 
INNER JOIN students s ON css.id_student = s.student_id
INNER JOIN student_assignments sa on sa.id_student=css.id_student
 WHERE id_asignment='$id' and id_course='$id_course' and id_semester='$id_sem'";
    $i = 0;
    $result = mysqli_query($conn, $query);
    checkResultQuery($result, $conn, __FUNCTION__);
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row["arabic_name"];
        $id = $row['id_student'];
        $group = $row['student_group'];
        $assignment = $row['student_assignment'];
        $turn_date = $row['handin_date'];
        $turn_time = $row['handin_time'];
        $grade = $row['grade'];
        echo "
           <tr>
                                    <td><input type='hidden'  name='grade[$i][id]' value='$id'>$id</td>
                                    <td >$name</td>
                                    <td>$group</td>
                                    <td><a class='assmt-download' href='../media/$assignment'>Download</a></td>
        <td> $turn_date at $turn_time </td>
                                    <td><input type='number' name='grade[$i][point]' value='$grade'></td>
                                </tr>


        ";
        $i++;
    }
}
//grade for student choose semester id , course id , student id , name , group,
function display_student_assignments($semester, $courseid)
{
    global $conn;
    $query = "SELECT  a.assignment_id , a.title ,a.id_instructor ,
            a.due_time ,a.due_date, a.publish_date, a.assignment ,a.description 
            ,u.first_name , u.last_name 
            FROM asignments  a 
            INNER JOIN instructors i ON i.instructor_id= a.id_instructor
            INNER JOIN users  u ON i.id_user= u.id
            WHERE a.id_course ='$courseid' AND a.id_semester ='$semester'
    ";
    $assignments_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($assignments_query)) {
        $id = $row['assignment_id'];
        $title = $row['title'];
        $due_date = $row['due_date'];
        $publish_date = $row['publish_date'];
        $time = $row['due_time'];
        $assignment = $row['assignment'];
        $firstname = $row['first_name'];
        $lastname = $row['last_name'];

        echo "
    
    
                    <div class='conbody container-fluid'>
                        <div class='row'>
                            <div class='btn-grp col-lg-5 col-md-12'>
                                <table class='table table-borderless '>
                                    <tbody>
                                        <tr>
                                            <th scope='row'>Assignment</th>
                                            <td>$title</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Due Date</th>
                                            <td>$due_date &nbsp;&nbsp; $time</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class='btn-grp col-lg-5 col-md-12'>
                                <table class='table table-borderless '>
                                    <tbody>
                                        <tr>
                                            <th scope='row'>Uploaded By</th>
                                            <td>$firstname  $lastname</td>
                                        </tr>
                                        <tr>
                                            <th scope='row'>Upload Date</th>
                                            <td>$publish_date</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                         
                         
                            <div class='btn-grp col-lg-2 col-md-12'>
                    
                                <a href='UnHand.php?course_id=$courseid&sem_id=$semester&ass_id=$id' class='btn btn-primary btn-block'>View</a> 
                                
                              
        </div>



                        </div>
                    </div>
    
    ";
    }
}


function student_view_assignment($id, $studentid)
{
    global $conn;

    $check_query = "SELECT * FROM student_assignments WHERE id_asignment='$id' AND id_student='$studentid' ";
    $check = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check) != 0) {
        unturnin_view($id, $studentid);
    } else {
        turnin_view($id, $studentid);
    }
}


function unturnin_view($id, $studentid)
{
    global $conn;
    $unturn_query = "Select a.assignment_id , a.title  , a.due_time ,a.due_date , a.assignment ,a.description , a.points,
            sa.grade , sa.student_assignment , sa.handin_date , sa.handin_time
            from asignments a 
            inner join student_assignments sa on 
            a.assignment_id=sa.id_asignment
            WHERE sa.id_asignment='$id' and sa.id_student='$studentid' ";
    $unturn = mysqli_query($conn, $unturn_query);
    while ($row = mysqli_fetch_array($unturn)) {
        $title = $row['title'];
        $due_date = $row['due_date'];
        $time = $row['due_time'];
        $assignment = $row['assignment'];
        $student_assignment = $row['student_assignment'];
        $description = $row['description'];
        $points = $row['points'];
        $grade = $row['grade'];
        $turndate = $row['handin_date'];
        $turntime = $row['handin_time'];
    }
    echo "
<form method='post' enctype='multipart/form-data'>
<div class='row'>
  <div class='col-lg-8'>

            <h3 class='font-weight-bold' style=' color:rgb(31,108,236);'>
              $title </h3>              <p class='handtime'>
                            Due $due_date at $time
                          </p>
                        </div>
  <div class='col-lg-4'>
    <p class='turntime handtime'>
Turned in $turndate at $turntime
    </p>
    <button type='submit' class='btn btn-primary  turnbutton' name='unturn' type='submit'>Un Turn in</button>

</div>
                        </div>
 <hr class='mb-4 mt-1'>
<div class='row'>

    <div class='col-lg-6'>


              <h6 class='Instructions'>Instructions</h6>
              <p class='handtime'>
$description <br>
              </p>


</div>


<div class='col-lg-6'>
<h6> Points</h6>
<p class='points'>
    $grade/$points
</p>
</div>


</div>
<div class='row'>
<div class='col-lg-6'>
<h6>Referenece Metrial</h6>
<p class='handtime'><a href='../media/$assignment'>$assignment</a></p>
</div>

</div>


<div class='row'>
  <div class='col-lg-6'>
    <h6 >My Work</h6>

<div class='custom-file'>
    
    <label class='custom-file-label' for='validatedCustomFile'><a href='../media/$student_assignment'>$student_assignment</a></label>
    <div class='invalid-feedback'>Example invalid custom file feedback</div>
  </div>
</div>
</div>
<br><br>
</form>

";
}


function turnin_view($id, $studentid)
{
    global $conn;
    $query = "Select * from asignments where assignment_id=$id ";
    $assignments_query = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($assignments_query)) {
        $title = $row['title'];
        $due_date = $row['due_date'];
        $time = $row['due_time'];
        $assignment = $row['assignment'];
        $description = $row['description'];
        $points = $row['points'];
    }
    //  Turned in Fri Dec 11, 2020 at 7:01 PM


    echo "
<form method='post' enctype='multipart/form-data'>
<div class='row'>
  <div class='col-lg-10'>

            <h3 class='font-weight-bold' style=' color:rgb(31,108,236);'>
              $title </h3>              <p class='handtime'>
                            Due $due_date at $time
                          </p>
                        </div>
  <div class='col-lg-2'>
    <p class='turntime handtime'>

    </p>
    <button type='submit' class='btn btn-primary  turnbutton' name='turn' type='submit'>Turn in</button>

</div>
                        </div>
 <hr class='mb-4 mt-1'>
<div class='row'>

    <div class='col-lg-6'>


              <h6 class='Instructions'>Instructions</h6>
              <p class='handtime'>
$description <br>
              </p>


</div>


<div class='col-lg-6'>
<h6> Points</h6>
<p class='points'>
    $points
</p>
</div>


</div>
<div class='row'>
<div class='col-lg-6'>
<h6>Referenece Metrial</h6>
<p class='handtime'><a href='../media/$assignment'>$assignment</a></p>
</div>

</div>

<div class='row'>
  <div class='col-lg-6'>
    <h6 >My Work</h6>

<div class='custom-file'>
    <input type='file' name='student_assignment'  class='custom-file-input' id='validatedCustomFile'  required>
    <label class='custom-file-label' for='validatedCustomFile'>Choose file...</label>
    <div class='invalid-feedback'>Example invalid custom file feedback</div>
  </div>
</div>
</form>
</div>
<br><br>
";
}


function turnin($id, $studentid)
{
    global $conn;
    $student_assignment = $_FILES['student_assignment']['name'];
    $student_assignment_temp = $_FILES['student_assignment']['tmp_name'];
    $handin_date = date('Y-m-d');
    $handin_time = date("h:i:sa");
    move_uploaded_file($student_assignment_temp, "../media/$student_assignment");
    $query = "INSERT INTO  student_assignments (id_asignment,student_assignment,id_student,handin_date,handin_time) VALUES ('$id','$student_assignment','$studentid','$handin_date','$handin_time') ";

    $turnin_query = mysqli_query($conn, $query);
    echo "<META HTTP-EQUIV='Refresh' Content='0'; >";

    if (!$turnin_query) {
        die("Failed" . mysqli_error($conn));
    }
}
function unturnin($id, $studentid)
{
    global $conn;
    $query = "Delete from student_assignments where id_asignment='$id'and id_student='$studentid' ";
    $unturnin_query = mysqli_query($conn, $query);
    echo "<META HTTP-EQUIV='Refresh' Content='0'; >";

    if (!$unturnin_query) {
        die("Failed" . mysqli_error($conn));
    }
}
function add_assignment_grade()
{
    global $conn;
    $h = count($_POST['grade']);


    for ($i = 0; $i < $h; $i++) {
        $point = $_POST['grade'][$i]['point'];
        $id = $_POST['grade'][$i]['id'];
        $query = "UPDATE student_assignments SET grade='{$point}' WHERE id_student='{$id}' ";
        $result = mysqli_query($conn, $query);
    }
    echo "<meta http-equiv='refresh' content='0'>";
}

########################################################################################################################################################




//check the result of the query
function checkQuery($query_result)
{
    global $conn;
    if (!$query_result) {
        die(mysqli_error($conn));
    }
}


//get registered students in a course
function getRegisteredStudents($courseId)
{
    global $conn;
    global $semester;
    $query = "SELECT id_student, arabic_name, level, student_group FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
    $query_result = mysqli_query($conn, $query);
    $i = 1;
    while ($row = mysqli_fetch_assoc($query_result)) {
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

/*
 * @author Omar 
 */
function getInstructorList(){
    global $conn;
    $query = "SELECT u.id, u.first_name, u.middle_name, u.last_name, i.instructor_id FROM instructors i
    INNER JOIN users u on i.id_user = u.id";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while($row = mysqli_fetch_assoc($query_result)){
      $id = $row['instructor_id'];
      $fname = $row['first_name'];
      $mname = $row['middle_name'];
      $lname = $row['last_name'];
      echo "
        <option value='$id'>$fname $mname $lname</option>
      ";
    }
  }



function getInstructorCourses($instructorId)
{
    global $conn;
    global $semester;
    $query = "SELECT oc.course_id, level, student_count, name FROM open_courses oc INNER JOIN open_courses_instructors oci ON oc.course_id = oci.course_id
      INNER JOIN courses c ON oc.course_id = c.course_id WHERE instructor_id = $instructorId ";
    $query_result = mysqli_query($conn, $query);


 return $query_result;
    }


    



function getStudentMarksForCourse($courseId, $std_id)
{
    global $conn;
    global $semester;
    $query = "SELECT * FROM course_semester_students WHERE id_student = $std_id AND id_course = $courseId AND id_semester = $semester";
    $query_result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $mid = $row['midterm'];
        $oral = $row['oral'];
        $cw = $row['course_work'];
        $practical = $row['practical'];
        $final = $row['final'];
        $total = $mid + $oral + $cw + $practical + $final;
        echo "
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

function getCourseMaterial($courseId)
{
    global $conn;
    global $semester;
    $query = "SELECT m.title, u.first_name, u.last_name, material_ref FROM materials m
      INNER JOIN users u ON u.id = m.id_user
      WHERE id_course = $courseId AND semester_id = $semester";
    $query_result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($query_result)) {
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
      </div> <br> ";
    }
}



function getCourseMaterialEditable($courseId)
{
    global $conn;
    global $semester;
    $query = "SELECT m.title, u.first_name, u.last_name, material_ref, material_id FROM materials m
      INNER JOIN users u ON u.id = m.id_user
      WHERE id_course = $courseId AND semester_id = $semester";
    $query_result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($query_result)) {
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
      </div> <br>";
        // <a href='../files/$material' download='$title' type='button' class='btn btn-primary btn-block'>Download</a>
    }
}







function uploadMaterial($file)
{
    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];
    $file_type = $file['type'];

    if ($file_error === 0) {
        $fname = explode('.', $file_name);
        $new_file_name = uniqid('', true) . "." . strtolower(end($fname));
        $destination = "../files/" . $new_file_name;
        move_uploaded_file($file_tmp_name, $destination);
        return $destination;
    }


    return false;
}


function putMaterialInDB($courseId, $title, $location, $user_id)
{
    global $conn;
    global $semester;
    $title = mysqli_real_escape_string($conn, $title);
    $query = "INSERT INTO materials(id_course, id_user, title, material_ref, semester_id)
    VALUES('$courseId', '$user_id', '$title', '$location', '$semester')";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
}

function updateMaterial($title, $location, $material_id)
{
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

function deleteMaterial($material_id)
{
    global $conn;
    $query = "DELETE FROM materials WHERE material_id=$material_id";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
}


function getOpenCourses()
{
    global $conn;
    $query = "SELECT c.name, c.course_id, c.credits, c.category, c.has_preq, u.first_name, u.last_name FROM open_courses oc
    INNER JOIN courses c ON c.course_id = oc.course_id
    INNER JOIN open_courses_instructors oci ON oci.course_id = oc.course_id
    INNER JOIN instructors i ON i.instructor_id = oci.instructor_id
    INNER JOIN users u ON u.id = i.id_user
    WHERE u.type = 'professor' OR u.type = 'admin'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

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
            $preq_query_result = mysqli_query($conn, $preq_query);
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
            <a href='../academic/discussion.php?course_id=$id' class='btn btn-primary'>View</a>
            <a href='../admin/Add_Class.php?course_id=$id' class='btn btn-outline-primary'>Add Class</a>
            <a href='../admin/close_course.php?course_id=$id' class='btn btn-outline-danger'>Close</a>
          </div>
        </div>
      </div>
      ";
    }
}


function getCoursesAsOptionsEditable($prerequisite)
{
    global $conn;
    $query = "SELECT * FROM courses";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $id = $row['course_id'];
        $cname = $row['name'];
        if ($id == $prerequisite) {
            echo "
      <option value='$id' selected='selected'>$id - $cname</option>
      ";
        } else {
            echo "
      <option value='$id'>$id - $cname</option>
      ";
        }
    }
}

function getCoursesAsOptions()
{
    global $conn;
    $query = "SELECT * FROM courses";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $id = $row['course_id'];
        $cname = $row['name'];
        echo "
      <option value='$id'>$id - $cname</option>
    ";
    }
}

function addNewCourse($id, $name, $credits, $category, $type, $prerequisite, $practicalCheckbox, $sectionsCheckbox)
{
    global $conn;
    $course_name = $name;
    $course_id = $id;
    $course_credits = $credits;
    $course_category = $category;
    $course_type = $type;
    $course_prerequisite = $prerequisite;
    $course_practicalCheckbox = $practicalCheckbox == '1' ? 1 : 0;
    $course_sectionsCheckbox = $sectionsCheckbox == '1' ? 1 : 0;
    $course_has_prereq = $prerequisite == "" ? 0 : 1;
    $query = "INSERT INTO courses(course_id, credits, has_preq, has_labs, has_practical, name, category, elective)
  VALUES('$course_id', '$course_credits', '$course_has_prereq', '$course_sectionsCheckbox', '$course_practicalCheckbox', '$course_name', '$course_category', '$course_type')";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    if ($course_has_prereq == 1) {
        $preq_query = "INSERT INTO prerequisites(id_course, prerequisite_id) VALUES('$course_id', '$course_prerequisite')";
        $preq_query_result = mysqli_query($conn, $preq_query);
        checkQuery($preq_query_result);
    }
}

function updateCourse($old, $id, $name, $credits, $category, $type, $prerequisite, $practicalCheckbox, $sectionsCheckbox)
{
    global $conn;
    $course_name = $name;
    $course_id = $id;
    $course_credits = $credits;
    $course_category = $category;
    $course_type = $type;
    $course_prerequisite = $prerequisite;
    $course_practicalCheckbox = $practicalCheckbox == '1' ? 1 : 0;
    $course_sectionsCheckbox = $sectionsCheckbox == '1' ? 1 : 0;
    $course_has_prereq = $prerequisite == "" ? 0 : 1;
    $query = "UPDATE courses SET course_id = $course_id, credits= $course_credits, has_preq = $course_has_prereq, has_labs = $course_sectionsCheckbox, has_practical = $course_practicalCheckbox, name = '$course_name', category = '$course_category', elective = '$course_type'
   WHERE course_id = $old";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    if ($course_has_prereq == 1) {
        $preq_query = "UPDATE prerequisites SET id_course = $course_id, prerequisite_id = $course_prerequisite WHERE id_course = $old";
        $preq_query_result = mysqli_query($conn, $preq_query);
        checkQuery($preq_query_result);
    }
}

function deleteCourse($courseId)
{
    global $conn;
    $query = "DELETE FROM courses WHERE course_id = $courseId";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
}




function getCourseInfo($courseId)
{
    global $conn;
    $query = "SELECT * FROM courses WHERE course_id = $courseId";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    if (mysqli_num_rows($query_result) == 1) {
        $row = mysqli_fetch_assoc($query_result);
        return $row;
    }
    return false;
}

function getProfessorList()
{
    global $conn;
    $query = "SELECT u.id, u.first_name, u.middle_name, u.last_name, i.instructor_id FROM instructors i
  INNER JOIN users u on i.id_user = u.id where u.type = 'professor' or u.type = 'admin'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    return $query_result;
}





function showAllCourses()
{
    global $conn;
    $query = "SELECT * FROM courses ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("QUERY OF SHOW ALL COURSES FAILED" . mysqli_error($conn));
    }
    return $result;
}
function getCourseID($courseName)
{
    global $conn;
    $courseID_query = "SELECT course_id FROM courses WHERE `name` = '$courseName'";
    $result = mysqli_query($conn, $courseID_query);
    if (!$result) {
        die("CANT GET THE COURSE ID" . mysqli_error($conn));
    }
    return $result;
}
function getVenueID($venueName)
{
    global $conn;
    $courseID_query = "SELECT venue_id FROM venues WHERE `name` = '$venueName'";
    $result = mysqli_query($conn, $courseID_query);
    if (!$result) {
        die("CANT GET THE Venue ID" . mysqli_error($conn));
    }
    return $result;
}


function showAllVenues(){
    global $conn;
    $query = "SELECT venue_id, name FROM venues";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("QUERY OF SHOW ALL COURSES FAILED". mysqli_error($conn));
    }
    return $result;
}

function addToClassTable($courseId, $instructorId, $location, $start_time, $end_time, $day, $type, $group, $frequency, $level){
    global $conn;
    $query = "INSERT INTO `classes` (`class_id`, `id_course`, `id_venue`, `start`, `end`, `day`, `type`, `students_group`, `freq`, `id_instructor`, `level`) 
    VALUES(NULL,'$courseId','$location','$start_time','$end_time','$day','$type', '$group', '$frequency', '$instructorId', '$level' );";
    $result = mysqli_query($conn,$query);
    checkQuery($result);

}
function getUserName($user_id)
{
    global  $conn;
    $query = "SELECT first_name, middle_name FROM users  WHERE id = '$user_id' ";
    $result = mysqli_query($conn, $query);
    $user_name = "";
    if (!$result) {
        die("Cannot get user name " . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $first = $row['first_name'];
        $middle = $row['middle_name'];
        $user_name .= $first;
        $user_name .= " ";
        $user_name .= $middle;
    }
    return $user_name;
}


function addNewPost($id_user, $id_semester, $id_course, $post_title, $post_author, $post_user, $post_date, $post_content, $post_tags, $page)
{
    global $conn;
    $query = "INSERT INTO `posts`(id_user, id_semester, id_course, post_title, post_author, post_user, post_date, post_content, post_tags) ";
    $query .= "VALUES('$id_user', $id_semester, '$id_course', '$post_title', '$post_author', '$post_user', '$post_date', '$post_content','$post_tags')";
    // die($query);
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot add post to database  " . mysqli_error($conn));
    }
    if($id_course ==0){
        header("Location: $page");
    }
    else{
        header("Location: $page?course_id=$id_course&sem_id=$id_semester");
    }

    return $result;
}


function getAllPosts($course_id, $id_semester)
{
    global $conn;
    $query = "SELECT post_id, id_user,post_author, post_date, post_content, votes FROM posts WHERE id_course ='$course_id' AND id_semester = '$id_semester' ORDER BY post_id  DESC ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot retrieve posts from database  " . mysqli_error($conn));
    }
    return $result;
}

function getPost($post_id)
{
    global $conn;
    $query = "SELECT post_author, post_date, post_content, votes FROM posts WHERE post_id = '$post_id' ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot retrieve posts from database  " . mysqli_error($conn));
    }
    return $result;
}

function deletePost($post_id)
{
    global $conn;
    $query = "DELETE FROM posts WHERE post_id = '$post_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot delete post" . mysqli_error($conn));
    } else {
        deletePostComments($post_id);
    }
}

function deletePostComments($id_post)
{
    global $conn;
    $query = "DELETE FROM comments WHERE id_post = '$id_post'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot delete comments" . mysqli_error($conn));
    }
}

function addNewComment($id_post, $id_user, $comment_author, $comment_content, $comment_date, $course_id, $page)
{
    global $conn;
    $query = "INSERT INTO `comments`(id_post, id_user, comment_author, comment_content, comment_date) ";
    $query .= "VALUES('$id_post', '$id_user', '$comment_author', '$comment_content', '$comment_date')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot add post to database  " . mysqli_error($conn));
    }
    header("Location: $page?course_id=$course_id&p_id=$id_post&u_id=$id_user");
    return $result;
}

function getAllComments($id_post)
{
    global $conn;
    $query = "SELECT id_user, comment_id, comment_author, comment_content, comment_date FROM comments WHERE id_post ='$id_post' ORDER BY comment_id  ASC ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot retrieve comments from database  " . mysqli_error($conn));
    }
    return $result;
}

function deleteComment($comment_id)
{
    global $conn;
    $query = "DELETE FROM comments WHERE comment_id = '$comment_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot delete post" . mysqli_error($conn));
    }
}

function upVote($post_id, $user_id)
{
    global $conn;
    $query1 = "INSERT INTO `votes`(id_post, id_user, vote_value) VALUES('$post_id', '$user_id', 1)";
    $query2 = "UPDATE posts SET votes = votes + 1 WHERE post_id = '$post_id' ";
    $result1 = mysqli_query($conn, $query1);
    if ($result1) {
        $result2 = mysqli_query($conn, $query2);
        if (!$result2) {
            die("cannot update the votes value in posts " . mysqli_error($conn));
        }
    } else {
        die('cannot add vote record to votes database ' . mysqli_error($conn));
    }
}

function downVote($post_id, $user_id)
{
    global $conn;
    $query1 = "INSERT INTO `votes`(id_post, id_user, vote_value) VALUES('$post_id', '$user_id', -1)";
    $query2 = "UPDATE posts SET votes = votes - 1 WHERE post_id = '$post_id'";
    $result1 = mysqli_query($conn, $query1);
    if (!$result1) {
        die("query 1 error " . mysqli_error($conn));
    }
    $result2 = mysqli_query($conn, $query2);
    if (!$result2) {
        die("query 2 error " . mysqli_error($conn));
    }
}

function redoVotePost($post_id, $user_id)
{
    global $conn;
    $query1 = "SELECT vote_value FROM votes WHERE id_post = '$post_id' AND id_user = '$user_id'";
    $query2 = "DELETE FROM votes WHERE id_post = '$post_id' AND id_user = '$user_id' ";
    $result1 = mysqli_query($conn, $query1);
    if (!$result1) {
        die("Query1 error redoVote" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_assoc($result1)) {
        $valueOfVote = $row['vote_value'];
    }
    $query3 = "UPDATE posts SET votes = votes - '$valueOfVote' WHERE post_id = '$post_id'";
    $result2 = mysqli_query($conn, $query2);
    if (!$result2) {
        die("Query2 error redoVote " . mysqli_error($conn));
    }
    $result3 = mysqli_query($conn, $query3);
    if (!$result3) {
        die("Query3 error redoVote " . mysqli_error($conn));
    }
}

// to check if user has already vote in a post or not
function checkIfVotedPost($post_id, $user_id)
{
    global $conn;
    $query = "SELECT * FROM votes WHERE id_post = '$post_id' AND id_user = '$user_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('there is an error while accessing votes db ' . mysqli_error($conn));
    }

    return mysqli_num_rows($result) != 0;
}

// adding new poll


function addNewPoll($id_user, $id_semester, $id_course, $poll_content, $poll_date, $page)
{
    global $conn;
    $query = "INSERT INTO polls(id_user, id_semester, id_course ,poll_content, poll_date) VALUES('$id_user', $id_semester, '$id_course', '$poll_content','$poll_date')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("cannot insert to poll table " . mysqli_error($conn));
    }
    $retQuery = "SELECT poll_id FROM polls ORDER BY poll_id DESC LIMIT 1; ";
    $retResult = mysqli_query($conn, $retQuery);
    if (!$retResult) {
        die("cannot Select poll_id addNewPoll " . mysqli_error($conn));
    }
    $retPoll_id = 0;
    while ($row = mysqli_fetch_assoc($retResult)) {
        $retPoll_id = $row['poll_id'];
    }
    if($id_course==0){
        header("Location: $page");
    }
    else{
        header("Location: $page?course_id=$id_course&sem_id=$id_semester");
    }

    return $retPoll_id;
}


function addPollOption($id_poll, $option_content)
{
    global $conn;
    $query = "INSERT INTO poll_options(id_poll, option_content) VALUES('$id_poll', '$option_content')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("cannot Insert to poll_options table" . mysqli_error($conn));
    }
}

function getPolls($id_course, $id_semester)
{
    global $conn;
    $query = "SELECT * FROM polls WHERE id_course = '$id_course' AND id_semester = '$id_semester' ORDER BY poll_id DESC ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("cannot get the polls " . mysqli_error($conn));
    }
    return $result;
}

function getPollOptions($id_poll)
{
    global $conn;
    $query = "SELECT * FROM poll_options WHERE id_poll = '$id_poll' ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("cannot get the polls " . mysqli_error($conn));
    }
    return $result;
}
function votePoll($id_user, $id_poll, $id_option)
{
    global $conn;
    $query1 = "INSERT INTO poll_votes(`id_user`, `id_poll`, `id_option`) VALUES('$id_user', '$id_poll', '$id_option')";
    $result1 = mysqli_query($conn, $query1);
    if (!$result1) {
        die("cannot insert to poll_votes " . mysqli_error($conn));
    }
    $query2 = "UPDATE poll_options SET votes = votes +1 WHERE option_id = '$id_option'";
    $result2 = mysqli_query($conn, $query2);
    if (!$result2) {
        die("cannot update the votes " . mysqli_error($conn));
    }
}
function checkIfVotedPoll($poll_id, $user_id)
{
    global $conn;
    $query = "SELECT * FROM poll_votes WHERE id_poll = '$poll_id' AND id_user = '$user_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('there is an error while accessing votes db ' . mysqli_error($conn));
    }

    return mysqli_num_rows($result) != 0;
}
function redoVotePoll($user_id, $poll_id)
{
    global $conn;
    $query1 = "SELECT id_option FROM poll_votes WHERE id_user = '$user_id' AND id_poll = '$poll_id' ";
    $query2 = "DELETE FROM poll_votes WHERE id_user = '$user_id' AND id_poll = '$poll_id' ";
    $result1 = mysqli_query($conn, $query1);
    if (!$result1) {
        die("Cannot select the option_id record redoVotePoll.. " . mysqli_error($conn));
    }
    $option_id = null;
    while ($row = mysqli_fetch_assoc($result1)) {
        $option_id = $row['id_option'];
    }
    $query3 = "UPDATE poll_options SET votes = votes - 1 WHERE option_id = $option_id";
    $result2 = mysqli_query($conn, $query2);
    if (!$result2) {
        die("Cannot delete the vote record in redoVotePoll" . mysqli_error($conn));
    }
    $result3 = mysqli_query($conn, $query3);
    if (!$result3) {
        die("Cannot update the votes in redoVotePoll" . mysqli_error($conn));
    }
}
function deletePoll($poll_id)
{
    global $conn;
    $query1 = "DELETE FROM polls WHERE poll_id = '$poll_id'";
    $result1 = mysqli_query($conn, $query1);
    if (!$result1) {
        die("Cannot delete the poll deletePoll" . mysqli_error($conn));
    }
}

function grade_courses()
{
    global $conn;

    $query = "Select * from course_semester_students ";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_array($result)) {
        $total = $row['total'];
        $rate = grade_gpa($total);
        $grade = $rate[0];
        $gpa = $rate[1];
        $course = $row['id_course'];
        $student = $row['id_student'];
        $query2 = "update course_semester_students set grade ='$grade' , gpa='$gpa' where id_course='$course'and id_student='$student' and total='$total' ";
        $update = mysqli_query($conn, $query2);
        if (!$update) {
            die("" . mysqli_error($conn));
        }
    }
}
function grade_gpa($total)
{
    $grade = 'f';
    $gpa = 0;
    switch ($total) {
        case $total >= 90:
            $grade = 'A';
            $gpa = 4;
            break;
        case $total >= 85 && $total < 90:
            $grade = 'A-';
            $gpa = 3.67;
            break;
        case $total >= 80 && $total < 85:
            $grade = 'B+';
            $gpa = 3.33;
            break;

        case $total >= 75 && $total < 80:
            $grade = 'B';
            $gpa = 3.00;
            break;

        case $total >= 70 && $total < 75:
            $grade = 'B-';
            $gpa = 2.67;
            break;
        case $total >= 65 && $total < 70:
            $grade = 'C+';
            $gpa = 2.33;
            break;

        case $total >= 60 && $total < 65:
            $grade = 'C';
            $gpa = 2.00;
            break;
        case $total >= 56 && $total < 60:
            $grade = 'C-';
            $gpa = 1.67;
            break;
        case $total >= 53 && $total < 56:
            $grade = 'D+';
            $gpa = 1.33;
            break;
        case $total >= 50 && $total < 53:
            $grade = 'D';
            $gpa = 1.00;
            break;

        case $total < 50:
            $grade = 'F';
            $gpa = 0.00;
            break;
    }
    $array = [$grade, $gpa];
    return $array;
}
function cgpa($id)
{
    global $conn;
    $query = "Select css.id_course,css.gpa, c.credits from course_semester_students as css inner join courses as c on c.course_id = css.id_course where css.id_student='$id'";
    $result = mysqli_query($conn, $query);
    $cgpa = 0;
    $credits = 0;


    while ($row = mysqli_fetch_array($result)) {
        $data[$row['id_course']] = array($row['gpa'], $row['credits']);
    }

    foreach ($data as $x => $x_value) {
        $cgpa += $x_value[0] * $x_value[1];
        $credits += $x_value[1];
    }
    if ($credits > 0) {
        $cgpa = $cgpa / $credits;
    } else {
        $cgpa = 0;
    }
    return $cgpa;
}
function insert_cgpa($id)
{
    global $conn;
    $cgpa = cgpa($id);
    $query = "update students set cgpa ='$cgpa' where student_id='$id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot insert cgpa" . mysqli_error($conn));
    }
}

function transcript_student_information($id)
{
    global $conn;
    $query = "select * from students where student_id='$id'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_array($result);

    $array = [$row['arabic_name'], $row['level'], $row['student_group'], $row['cgpa']];
    return $array;
}
function transcript($id)
{
    global $conn;
    $query = "select s.season, s.sem_year, c.name , c.credits, css.grade , css.gpa , css.id_course , css.id_semester from course_semester_students as css 
           inner join semesters as s on s.semester_id=css.id_semester
           inner join courses as c on c.course_id=css.id_course
            where id_student='$id' ORDER BY css.id_semester ASC ";
    $result = mysqli_query($conn, $query);
    $flag = 0;
    $tgpa = 0;
    $tcredits = 0;
    if (!$result) {
        die("Cannot insert cgpa" . mysqli_error($conn));
    }
    while ($row = mysqli_fetch_array($result)) {
        $semester = $row['id_semester'];
        $season = $row['season'];
        $sem_year = $row['sem_year'];
        $coursename = $row['name'];
        $credits = $row['credits'];
        $grade = $row['grade'];
        $gpa = $row['gpa'];
        $courseid = $row['id_course'];


        if ($flag != $semester) {
            if ($flag != 0) {
                $sgpa = $tgpa / $tcredits;
                echo " </table>
                </div>
                <p style='
  color: rgb(31, 108, 236);'>GPA: $sgpa</p>";
                $tgpa = $tcredits = 0;
            }

            echo "  <h5 class='semester-heading'>$season $sem_year</h5>
   <div class='row table-container'>
     <table class='table'>
    <thead>
                        <tr>
                            <th>Course</th>
                            <th>Code</th>
                            <th>Credit Hours</th>
                            <th>Grade</th>
                        </tr>
                        </thead>
                        <tbody>";
            $flag = $semester;
        }
        if ($flag == $semester) {
            $tgpa += $gpa * $credits;
            $tcredits += $credits;
            echo "<tr>
                            <td>$coursename</td>
                            <td>$courseid</td>
                            <td>$credits</td>
                            <td>$grade</td>
                        </tr>";
        }
    }
    if ($tcredits != 0) {
        $sgpa = $tgpa / $tcredits;
        echo " </table>
                </div>
                <p style='
  color: rgb(31, 108, 236);'>GPA: $sgpa</p>";
    }
}


function logout()
{
    global $login_path;
    session_destroy();
    header("Location:$login_path");
}
