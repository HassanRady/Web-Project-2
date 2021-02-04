<?php
// getting connection
include_once "db_conn.php";

// global variables
include "variables.php";

// helper functions
include "helper.php";

// printing functions
include "print_functions.php";

// form data retriever functions
include "form_functions.php";

/******************************** Global variables **********************************/
// $semester = getCurrentSemester();
/******************************** Global variables **********************************/


function login()
{
    global $conn;
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
    if ($username != $email && $password != $pass) {

        header("Location: ./login.php");
    } elseif ($username == $email && $password == $pass) {
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $email;

        $_SESSION['first_name'] = $first_name;
        $_SESSION['middle_name'] = $middle_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['type'] = $type;
        switch ($type) {
            case "student":
                header("Location: /alpha/student/announcements.html");
                break;
            case "sa":
                header("Location: /alpha/academic/discussion.html");
                break;
            case "ta":
                header("Location: /alpha/academic/discussion.html");
                break;
            case "admin":
                header("Location: /alpha/admin/announcements.html");

                break;
            case "staff":
                header("Location: /alpha/sa/announcements.html");
                break;
        }
    } else {
        header("Location: ./login.php");
    }
}
function add_venue()
{
    global $conn;
    $venue_name = $_POST['venue_name'];
    $venue_location = $_FILES['venue_location']['name'];
    $venue_location_temp = $_FILES['venue_location']['tmp_name'];
    move_uploaded_file($venue_location_temp, "../media/$venue_location");
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
    move_uploaded_file($venue_location_temp, "../media/$venue_location");
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


              <a href='../media/$venue_location'>
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
        <a href='#' class='btn btn-primary btn-block '>View</a>
            <a class='btn btn-outline-secondary btn-block ' href='Edit_assignment.php?id=$id&courseid=$courseid&semester=$semester'>Edit</a>
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
function show_prof_student_assignments($id)
{
    global $conn;
    $query = "SELECT css.id_student
,s.arabic_name, s.student_group 
,sa.student_assignment,sa.grade ,sa.handin_date, sa.handin_time FROM course_semester_students css 
INNER JOIN students s ON css.id_student = s.student_id
INNER JOIN student_assignments sa on sa.id_student=css.id_student
 WHERE id_asignment='$id' ";
    $i = 0;
    $result = mysqli_query($conn, $query);
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
                    
                                <a href='UnHand.php?id=$id&student' class='btn btn-primary btn-block'>View</a> 
                                
                              
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

########################################################################################################################################
########################################################################################################################################

/**
 * This function is getting the number of records to show in the list
 * @param string $table the table from the database that need to be shown
 * @return int  
 */
function getRowsPerPage($table)
{
    global $rowsPerPage;

    $per_page = $rowsPerPage;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "";
    }

    if ($page == "" || $page == 1) {
        $page_1 = 0;
    } else {
        $page_1 = ($page * $per_page) - $per_page;
    }

    $dataBaseConnection = connectToDataBase();
    $post_query_count = "SELECT * FROM {$table}";
    $result = mysqli_query($dataBaseConnection, $post_query_count);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $count = mysqli_num_rows($result);
    $count  = ceil($count / $per_page);


    return array($per_page, $page_1, $count, $page);
}

/**
 * @param string $pageName
 */
function showStudents($pageName)
{
    global $studentsType;
    $type = $studentsType;
    $data = getStudentsData();
    printStudentsData($data, $type, $pageName);
}

/**
 * @param string $pageName
 */
function showProfessors($pageName)
{
    global $ProfessorsType;
    $type = $ProfessorsType;
    $data = getProfessorsData();
    printProfessorsData($data, $type, $pageName);
}

/**
 * @param string $pageName
 */
function showTas($pageName)
{
    global $TasType;
    $type = $TasType;
    $data = getTasData();
    printTasData($data, $type, $pageName);
}

/**
 * @param string $pageName
 */
function showSas($pageName)
{
    global $SasType;
    $type = $SasType;
    $data = getSasData();
    printSasData($data, $type, $pageName);
}





/**
 * @return string
 */
function getTypeForData()
{
    global $userTypes;
    $pageName = basename($_SERVER['PHP_SELF']);

    if (isset($_GET["type"])) {
        $type = $_GET["type"];
    } else {
        // check the file name which it has any type of users
        $pageUrl = strtolower($pageName);
        $type = which_type($pageUrl, $userTypes);
    }

    return $type;
}


/**
 * @return array all students data
 */
function getStudentsData()
{
    global $studentsTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($studentsTable);

    $mainSqlQuery = "SELECT s.*, u.* 
                FROM {$studentsTable} s 
                join users u 
                    on s.id_user = u.id";

    // for searching by level
    if (isset($_POST['search'])) {
        $level_search_str = $_POST['student-level'];
        $level_search = $level_search_str[6];
        $searchSqlQuery = " ORDER BY s.level = {$level_search} DESC, s.level DESC limit {$per_page};";
    } else {
        $searchSqlQuery = " ORDER BY s.level ASC limit {$page_1}, {$per_page};";
    }
    $mainSqlQuery .= $searchSqlQuery;

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $studentsData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $studentsData[$count++] = $row;
    }

    return $studentsData;
}


/**
 * @return array all professors data
 */
function getProfessorsData()
{
    global $professorsTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($professorsTable);

    $mainSqlQuery = "SELECT p.*, u.* 
                        FROM {$professorsTable} p 
                        join users u 
                            on p.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $professorsData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $professorsData[$count++] = $row;
    }

    return $professorsData;
}


/**
 * @return array all TA's data
 */
function getTasData()
{
    global $tasTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($tasTable);

    $mainSqlQuery = "SELECT t.*, u.* 
                        FROM {$tasTable} t 
                        join users u 
                            on t.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $tasData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $tasData[$count++] = $row;
    }

    return $tasData;
}


/**
 * @return array all SA's data
 */
function getSasData()
{
    global $sasTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($sasTable);

    $mainSqlQuery = "SELECT s.*, u.* 
                        FROM {$sasTable} s 
                        join users u 
                            on s.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $sasData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $sasData[$count++] = $row;
    }

    return $sasData;
}


/**
 * @return array all admins data
 */
function getAdminsData()
{
    global $adminsTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($adminsTable);

    $mainSqlQuery = "SELECT a.*, u.* 
                        FROM {$adminsTable} a 
                        join users u 
                            on a.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $adminsData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $adminsData[$count++] = $row;
    }

    return $adminsData;
}


function addStudent()
{
    $pageName = basename($_SERVER['PHP_SELF']);
    if (isset($_POST['submit'])) {

        $type = getTypeForData();

        list($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number) = NewUserDataForm();
        list($student_id, $arabic_name, $address, $guardian_mobile_number, $student_type) = NewStudentDataForm();

        // handling realescape
        $dataBaseConnection = connectToDataBase();
        $email = mysqli_real_escape_string($dataBaseConnection, $email);

        $password = encrypt_password($password);

        // for users table
        $firstSqlQuery = "INSERT INTO users 
                        VALUES (default, '$first_name', '$middle_name', '$last_name', $national_id, '$type', '$email', '$password', '$gender', '$mobile_number', '$home_number');";
        $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
        check_result($result, $dataBaseConnection, __FUNCTION__);

        $last_id = mysqli_insert_id($dataBaseConnection);

        // query for adding a student
        $secondSqlQuery = "INSERT INTO students (id_user, student_id, arabic_name, address, guardian_mobile_number, student_type)
                                    VALUES ($last_id, $student_id, '$arabic_name', '$address', '$guardian_mobile_number', '$student_type');";
        $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
        check_result($result, $dataBaseConnection, __FUNCTION__);
        $dataBaseConnection->close();


        header("Location:./{$pageName}?type={$type}&add=success");
    }
}



function add()
{
    global $conn;
    $basename = basename($_SERVER['PHP_SELF']);
    if (isset($_POST['submit'])) {

        // user type
        $type = $_GET["type"];

        // retrieving user values from the input form
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $national_id = $_POST['national_id'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $mobile_number = $_POST['mobile_number'];
        $home_number = $_POST['home_number'];
        $password =  $national_id;         // temp until user changes it

        // handling realescape
        $email = mysqli_real_escape_string($conn, $email);

        // hashing password
        $password = encrypt_password($password);

        // query for adding the user
        $sql1 = "INSERT INTO users 
                        VALUES (default, '$first_name', '$middle_name', '$last_name', $national_id, '$type', '$email', '$password', '$gender', '$mobile_number', '$home_number');";
        // execute the query
        $result =  mysqli_query($conn, $sql1);
        // check the first query
        if ($result) {
            $last_id = mysqli_insert_id($conn);
            $sql2 = null;

            switch ($type) {

                    // adding the student user in students table with deafult values
                case "student":

                    // retrieving student values from the input form
                    $arabic_name = $_POST['arabic_name'];
                    $address = $_POST["address"];
                    $student_type = $_POST['student_type'];
                    $student_id = $_POST['student_id'];
                    $guardian_mobile_number = $_POST['guardian_mobile_number'];

                    // query for adding a student
                    $sql2 = "INSERT INTO students (id_user, student_id, arabic_name, address, guardian_mobile_number, student_type)
                                    VALUES ($last_id, $student_id, '$arabic_name', '$address', '$guardian_mobile_number', '$student_type');";

                    break;

                    // adding the professor user in professors table with deafult values
                case "professor":
                    // retrieving professor values from the input form
                    $description = $_POST['description'];
                    $instructor_id = $national_id;             // temp until we figure it out

                    // query for adding instructor
                    $sql1_5 = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
                    $result1_1 = mysqli_query($conn, $sql1_5);
                    if ($result1_1) {
                        // query for adding a professor
                        $sql2 = "INSERT INTO professors VALUES ($last_id, $instructor_id, '$description');";
                    } else {
                        // error message
                        die("Could not insert data from sql1_5-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                    }
                    break;

                    // adding the TA user in TAs table with deafult values
                case "ta":
                    // retrieving TA values from the input form
                    $description = $_POST['description'];
                    $instructor_id = $national_id;             // temp until we figure it out

                    // query for adding instructor
                    $sql1_5 = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
                    $result1_1 = mysqli_query($conn, $sql1_5);
                    if ($result1_1) {
                        // query for adding a TA
                        $sql2 = "INSERT INTO tas VALUES ($last_id, $instructor_id, '$description');";
                    } else {
                        // error message
                        die("Could not insert data from sql1_5-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                    }
                    break;

                    // adding the sa user in admins table with deafult values
                case "sa":
                    // retrieving SA values from the input form
                    $instructor_id = $national_id;             // temp until we figure it out

                    // query for adding instructor
                    $sql1_5 = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
                    $result1_1 = mysqli_query($conn, $sql1_5);
                    if ($result1_1) {
                        // query for adding an admin
                        $sql2 = "INSERT INTO admins VALUES ($last_id, $instructor_id);";
                    } else {
                        // error message
                        die("Could not insert data from sql1_5-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                    }
                    break;

                default:
                    echo "There is no type";
            }
            // checking sql2 is formed by one of the above cases got selected
            if (!is_null($sql2)) {

                $result2 =  mysqli_query($conn, $sql2);

                // // check the second query
                if ($result2) {
                    header("Location:./{$basename}?type={$type}&add=success");
                } else {
                    // error message
                    die("Could not insert data from sql2-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
            } else {
                // error message
                echo "sql2 wasn't formed";
            }
        } else {
            // error message
            die("Could not insert data from sql1-add: " . mysqli_error($conn) . " " . mysqli_errno($conn));
        }
    }
    // Close connection
    $conn->close();
}


function update()
{
    global $conn, $type, $first_name, $middle_name, $last_name, $national_id,
        $email, $gender, $mobile_number, $home_number;

    $id_user = (int)$_GET['id'];
    $type = $_GET['type'];
    // retrieving data
    $data = NULL;
    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $national_id = $data['national_id'];
    // $type_user = $data['type'];
    $email = $data['email'];
    $gender = $data['gender'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];

    // Setting auto commit to false
    mysqli_autocommit($conn, FALSE);
    switch ($type) {
        case 'student':
            global $student_id, $arabic_name,  $address,
                $guardian_mobile_number, $student_type;

            // retrieving student data
            $student_id = $data['student_id'];
            $arabic_name = $data['arabic_name'];
            // $level = $data['level'];
            // $finished_hours = $data['finished_hours'];
            // $cgpa = $data['cgpa'];
            // $status = $data['status'];
            $address = $data['address'];
            $guardian_mobile_number = $data['guardian_mobile_number'];
            $student_type = $data['student_type'];
            // if update is pressed 
            if (isset($_POST['update'])) {

                // ------------------------------------------------------------------------
                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];                   // this can be written one time with two switch statments (PRIVATE)
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];
                // --------------------------------------------------------------------------

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving student values from the input form
                $arabic_name = $_POST['arabic_name'];
                $address = $_POST["address"];
                $student_type = $_POST['student_type'];
                $student_id = $_POST['student_id'];
                $guardian_mobile_number = $_POST['guardian_mobile_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);
                $address = mysqli_real_escape_string($conn, $address);

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}',
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating student in students table
                $sql2 = "UPDATE students
                        SET student_id={$student_id}, arabic_name='{$arabic_name}', 
                            address='{$address}', guardian_mobile_number='{$guardian_mobile_number}',
                            student_type='{$student_type}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("Could not insert data from sql1-student-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("Could not insert data from sql2-student-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./Students.php?type={$type}&update=success");
                }
            }
            break;

        case "professor":
            global $description;
            // retrieving professor data
            $description = $data['description'];
            // if update is pressed
            if (isset($_POST['update'])) {

                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving professor values from the input form
                $instructor_id = $national_id;
                $description = $_POST['description'];

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}', 
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating instructor in instructors table
                $sql2 = "UPDATE instructors
                SET instructor_id='{$instructor_id}'
                WHERE id_user = {$id_user};";
                // query for updating professor in professors table
                $sql3 = "UPDATE professors
                        SET description='{$description}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("FAILED QUERY from sql1-professor-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("FAILED QUERY from sql2-professor-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result3 = mysqli_query($conn, $sql3);
                if (!$result3) {
                    // error message
                    die("FAILED QUERY from sql3-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./Professors.php?type={$type}&update=success");
                }
            }
            break;

        case "ta":
            global $department;
            // retrieving professor data
            $department = $data['department'];
            // if update is pressed
            if (isset($_POST['update'])) {

                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving ta values from the input form
                $instructor_id = $national_id;
                $department = $_POST['department'];

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}', 
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating instructor in instructors table
                $sql2 = "UPDATE instructors
                        SET instructor_id='{$instructor_id}'
                        WHERE id_user = {$id_user};";
                // query for updating professor in professors table
                $sql3 = "UPDATE tas
                        SET department='{$department}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("FAILED QUERY from sql1-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("FAILED QUERY from sql2-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                $result3 = mysqli_query($conn, $sql3);
                if (!$result3) {
                    // error message
                    die("FAILED QUERY from sql3-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./ta_list.php?type={$type}&update=success");
                }
            }
            break;
        case "sa":
            // if update is pressed
            if (isset($_POST['update'])) {

                // retrieving user values from the input form
                $first_name = $_POST['first_name'];
                $middle_name = $_POST['middle_name'];
                $last_name = $_POST['last_name'];
                $national_id = $_POST['national_id'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $mobile_number = $_POST['mobile_number'];
                $home_number = $_POST['home_number'];

                // handling realescape
                $email = mysqli_real_escape_string($conn, $email);

                // hashing password
                $password = $national_id;
                $password = encrypt_password($password);

                // retrieving sa values from the input form
                $instructor_id = $national_id;

                // query for updating user in users table
                $sql1 = "UPDATE users
                        SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}', 
                            last_name='{$last_name}', national_id={$national_id},
                            email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
                        WHERE id = {$id_user};";
                // query for updating instructor in instructors table
                $sql2 = "UPDATE instructors
                        SET instructor_id='{$instructor_id}'
                        WHERE id_user = {$id_user};";
                // executing query 1
                $result1 = mysqli_query($conn, $sql1);
                if (!$result1) {
                    // error message
                    die("FAILED QUERY from sql1-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                }
                // executing query 2
                $result2 = mysqli_query($conn, $sql2);
                if (!$result2) {
                    // error message
                    die("FAILED QUERY from sql2-ta-update\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
                } else {
                    // Commit transaction
                    mysqli_commit($conn);

                    header("Location:./sa_list.php?type={$type}&update=success");
                }
            }
            break;

        default:
            die("NONE TYPE");
    }
    // Close connection
    $conn->close();
}


function deleteUser()
{
    global $conn;

    if (isset($_GET['delete'])) {
        reconnectToDataBase();

        $id_user = $_GET['delete'];
        $pageName = basename($_SERVER['PHP_SELF']);

        $mainSqlQuery = "DELETE FROM users WHERE id = {$id_user};";
        $result = mysqli_query($conn, $mainSqlQuery);

        check_result($result, $conn, "mainSqlQuery-delete");

        header("Location:./{$pageName}");
    }
}


// function to get user's data
function userProfile()
{
    global $conn, $id_user, $type, $first_name, $middle_name, $last_name, $full_name,
        $email, $mobile_number, $home_number;
    // user id and type
    $id_user = $_GET["id"];

    // getting user's data
    $data = NULL;
    // Close connection
    $conn->close();

    $type = $data['type'];

    // what can be shown for all users
    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];
    // user full name
    $full_name = $first_name . " " . $middle_name . " " . $last_name;

    if ($type === "student") {
        global $address, $level, $guardian_mobile_number;
        $address = $data['address'];
        $level = $data['level'];
        $guardian_mobile_number = $data['guardian_mobile_number'];
    }
}


function editProfile()
{
    userProfile();
    global $conn, $type, $id_user;
    // db reconnectToDataBaseion
    reconnectToDataBase();

    if (isset($_POST['update'])) {

        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $mobile_number = $_POST['mobile_number'];
        $home_number = $_POST['home_number'];
        $password  = $_POST['password'];
        // $repassword  = $_POST['repassword'];

        // handling realescape and enrypting
        $password = mysqli_real_escape_string($conn, $password);
        $password = encrypt_password($password);

        // Setting auto commit to false
        mysqli_autocommit($conn, FALSE);

        if ($type === "student") {
            $address = $_POST['address'];
            $guardian_mobile_number = $_POST['guardian_mobile_number'];

            // handling realescape
            $address = mysqli_real_escape_string($conn, $address);

            // query for updating user in users table
            $sql1 = "UPDATE users
             SET first_name='{$first_name}', password='{$password}', middle_name='{$middle_name}',
                 last_name='{$last_name}',  mobile_number='{$mobile_number}', home_number='{$home_number}'
             WHERE id = {$id_user};";
            // query for updating student in students table
            $sql2 = "UPDATE students
             SET address='{$address}', guardian_mobile_number='{$guardian_mobile_number}'
             WHERE id_user = {$id_user};";

            // executing query 1
            $result1 = mysqli_query($conn, $sql1);
            check_result($result1, $conn);

            // executing query 2
            $result2 = mysqli_query($conn, $sql2);
            check_result($result2, $conn);
        }

        // query for updating user in users table
        $sql1 = "UPDATE users
         SET first_name='{$first_name}', password='{$password}', middle_name='{$middle_name}',
             last_name='{$last_name}',  mobile_number='{$mobile_number}', home_number='{$home_number}'
         WHERE id = {$id_user};";

        // executing query 1
        $result1 = mysqli_query($conn, $sql1);
        check_result($result1, $conn);

        // Commit transaction
        mysqli_commit($conn);
        header("Location:./my_profile.php?id={$id_user}&type={$type}&update=success");
    }

    // Close connection
    $conn->close();
}

########################################################################################################################################
########################################################################################################################################

//get the last semester_id in the database;
function getCurrentSemester()
{
    global $conn;
    $query = "SELECT semester_id FROM semesters ORDER BY semester_id DESC LIMIT 1";
    $query_result = mysqli_query($conn, $query);
    if ($query_result) {
        $result = mysqli_fetch_assoc($query_result);
        return $result['semester_id'];
    } else {
        return -1;
    }
}


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


//get the mark breakdown of all registered students in a course
function getRegisteredStudentsMarks($courseId)
{
    global $conn;
    global $semester;
    $query = "SELECT id_student, arabic_name, grade, gpa, oral, midterm, course_work, practical, final FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
    $query_result = mysqli_query($conn, $query);

    // echo mysqli_error($conn);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $name = $row["arabic_name"];
        $id = $row['id_student'];
        $grade = $row['grade'] ? $row['grade'] : "F";
        $gpa = $row['gpa'];
        $oral = $row['oral'];
        $mid = $row['midterm'];
        $cw = $row['course_work'];
        $practical = $row['practical'];
        $final = $row['final'];
        $total = $mid + $oral + $cw + $practical + $final;
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


function getRegisteredStudentsMarksForEdit($courseId)
{
    global $conn;
    global $semester;
    $query = "SELECT id_student, arabic_name, grade, gpa, oral, midterm, course_work, practical, final FROM course_semester_students css INNER JOIN students s ON css.id_student = s.student_id WHERE id_course = $courseId AND id_semester = $semester";
    $query_result = mysqli_query($conn, $query);

    // echo mysqli_error($conn);

    while ($row = mysqli_fetch_assoc($query_result)) {
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


function getInstructorCourses($instructorId)
{
    global $conn;
    global $semester;
    $query = "SELECT oc.course_id, level, student_count, name FROM open_courses oc INNER JOIN open_courses_instructors oci ON oc.course_id = oci.course_id
      INNER JOIN courses c ON oc.course_id = c.course_id WHERE instructor_id = $instructorId ";
    $query_result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $name = $row['name'];
        $id = $row['course_id'];
        $level = $row['level'];
        $count = $row['student_count'];
        echo "
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


function getStudentCourses($studentId)
{
    global $conn;
    global $semester;
    $query = "SELECT c.course_id, c.name, u.first_name, u.last_name FROM course_semester_students css 
      INNER JOIN courses c ON css.id_course = c.course_id
      INNER JOIN open_courses_instructors oci ON oci.course_id = c.course_id
      INNER JOIN instructors i on oci.instructor_id = i.instructor_id
      INNER JOIN users u on i.id_user = u.id 
      WHERE css.id_student = $studentId AND (u.type = 'professor' or u.type='admin')";
    $query_result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $fname = $row['first_name'];
        $lname = $row['last_name'];
        $cname = $row['name'];
        $id = $row['course_id'];
        echo "
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
      </div>";
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
      </div>";
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


function getCoursePrerequisite($courseId)
{
    global $conn;
    $prerequisite = "-";
    $preq_query = "SELECT name from prerequisites p
    INNER JOIN courses c on p.prerequisite_id = c.course_id
    WHERE p.id_course = $courseId";
    $preq_query_result = mysqli_query($conn, $preq_query);
    $data = mysqli_fetch_assoc($preq_query_result);
    if (mysqli_num_rows($preq_query_result)) {
        $prerequisite = $data['name'];
    }
    return $prerequisite;
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
            <a href='#' class='btn btn-primary'>View</a>
            <a href='#' class='btn btn-outline-primary'>Add Class</a>
            <a href='#' class='btn btn-outline-secondary'>Options</a>
          </div>
        </div>
      </div>
      ";
    }
}

function getAvailableUniCourses()
{
    global $conn;
    $query = "SELECT * FROM courses WHERE category='university'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
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
      <td><a data-courseId='$id' class='btn btn-primary' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";
    }
}

function getAvailableFacultyCourses()
{
    global $conn;
    $query = "SELECT * FROM courses WHERE category='faculty'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
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
      <td><a data-courseId='$id' class='btn btn-primary' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";
    }
}

function getAvailableSIMCourses()
{
    global $conn;
    $query = "SELECT * FROM courses WHERE category='sim'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
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
      <td><a data-courseId='$id' class='btn btn-primary' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
    ";
    }
}


function getAvailableFreeCourses()
{
    global $conn;
    $query = "SELECT * FROM courses WHERE category='free'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $cname = $row['name'];
        $credits = $row['credits'];
        $id = $row['course_id'];



        echo "
    <tr>
      <td>$cname</td>
      <td>$credits</td>
      <td><button type='submit' name='openFree' class='btn btn-primary'>Confirm</button></td>
      <td><a href='edit_course.php?course_id=$id' class='btn btn-outline-secondary'>Options</a></td>
    </tr>
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
    $query = "UPDATE courses SET course_id = $course_id, credits= $course_credits, has_preq = $course_has_prereq,
  has_labs = $course_sectionsCheckbox, has_practical = $course_practicalCheckbox,
  name = '$course_name', category = '$course_category', elective = '$course_type'
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


function checkIfCourseIsOpen($courseId)
{
    global $conn;
    $query = "SELECT EXISTS (SELECT * FROM open_courses WHERE course_id = $courseId)";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    if (mysqli_num_rows($query_result) == 1) {
        return true;
    }
    return false;
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

    while ($row = mysqli_fetch_assoc($query_result)) {
        $id = $row['instructor_id'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $lname = $row['last_name'];
        echo "
      <option value='$id'>$fname $mname $lname</option>
    ";
    }
}


function openCourse($courseId, $professorId)
{
    global $conn;
    $query = "INSERT INTO ";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);

    while ($row = mysqli_fetch_assoc($query_result)) {
        $id = $row['instructor_id'];
        $fname = $row['first_name'];
        $mname = $row['middle_name'];
        $lname = $row['last_name'];
        echo "
      <option value='$id'>$fname $mname $lname</option>
    ";
    }
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


function showALlVenues()
{
    global $conn;
    $query = "SELECT `name` FROM venues ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("QUERY OF SHOW ALL COURSES FAILED" . mysqli_error($conn));
    }
    return $result;
}

function addToClassTable($course_id, $venue_id, $startTime, $endTime, $day, $type, $freq)
{
    global $conn;
    $query = "INSERT INTO `classes` (`class_id`, `id_course`, `id_venue`, `start`, `end`, `day`, `type`, `freq`) VALUES(NULL,'$course_id','$venue_id','$startTime','$endTime','$day','$type','$freq' );";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "DATA ARE INSERTED";
    } else {
        die("cannot insert data" . mysqli_error($conn));
    }
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


function addNewPost($id_user, $id_course, $post_title, $post_author, $post_user, $post_date, $post_content, $post_tags)
{
    global $conn;
    $query = "INSERT INTO `posts`(id_user, id_course, post_title, post_author, post_user, post_date, post_content, post_tags) ";
    $query .= "VALUES('$id_user', '$id_course', '$post_title', '$post_author', '$post_user', '$post_date', '$post_content','$post_tags')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot add post to database  " . mysqli_error($conn));
    }
    return $result;
}



function getAllPosts($course_id)
{
    global  $conn;
    $query = "SELECT post_id, id_user,post_author, post_date, post_content, votes FROM posts WHERE id_course ='$course_id' ORDER BY post_id  DESC ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot  postsForm from database  " . mysqli_error($conn));
    }
    return $result;
}
function getPost($post_id)
{
    global  $conn;
    $query = "SELECT post_author, post_date, post_content, votes FROM posts WHERE post_id = '$post_id' ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot  postsForm from database  " . mysqli_error($conn));
    }
    return $result;
}
function deletePost($post_id)
{
    global  $conn;
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
function addNewComment($id_post, $id_user, $comment_author, $comment_content, $comment_date)
{
    global $conn;
    $query = "INSERT INTO `comments`(id_post, id_user, comment_author, comment_content, comment_date) ";
    $query .= "VALUES('$id_post', '$id_user', '$comment_author', '$comment_content', '$comment_date')";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot add post to database  " . mysqli_error($conn));
    }
    return $result;
}
function getAllComments($id_post)
{
    global  $conn;
    $query = "SELECT id_user, comment_id, comment_author, comment_content, comment_date FROM comments WHERE id_post ='$id_post' ORDER BY comment_id  ASC ";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Cannot  commentsForm from database  " . mysqli_error($conn));
    }
    return $result;
}
function deleteComment($comment_id)
{
    global  $conn;
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
function redoVote($post_id, $user_id)
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
function checkIfVoted($post_id, $user_id)
{
    global $conn;
    $query = "SELECT * FROM votes WHERE id_post = '$post_id' AND id_user = '$user_id'";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die('there is an error while accessing votes db ' . mysqli_error($conn));
    }

    return mysqli_num_rows($result) != 0;
}
