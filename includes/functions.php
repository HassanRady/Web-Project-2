<?php
include "db_conn.php";
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

            header("Location: ../login/login.html  ");
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
                case"staff":
                    header("Location: /alpha/sa/announcements.html");
                    break;

            }
        } else {
            header("Location: ../login/login.html  ");

        }


}
function add_venue(){
global $conn;
    $venue_name=$_POST['venue_name'];
    $venue_location=$_FILES['venue_location']['name'];
    $venue_location_temp=$_FILES['venue_location']['tmp_name'];
move_uploaded_file($venue_location_temp,"../media/$venue_location");
// Create connection
   $venue_name= mysqli_real_escape_string($conn, $venue_name);
   $venue_location= mysqli_real_escape_string($conn, $venue_location);

    $sql = "INSERT INTO venues (name,venue_location) VALUE ('$venue_name','$venue_location') ";

    $venue_query=mysqli_query($conn,$sql);
    if(!$venue_query){
        die("Failed". mysqli_error($conn));
    }


}
function update_venue(){
global $conn;
$venue_id=$_POST['venue_id_get'];
$venue_name=$_POST['name'];
    $venue_location=$_FILES['venue_location']['name'];
    $venue_location_temp=$_FILES['venue_location']['tmp_name'];
    move_uploaded_file($venue_location_temp,"../media/$venue_location");
// Create connection
    $venue_name= mysqli_real_escape_string($conn, $venue_name);
    $venue_id= mysqli_real_escape_string($conn, $venue_id);
    $sql = "UPDATE venues SET name='{$venue_name}', venue_location='{$venue_location}' WHERE venue_id='{$venue_id}' ";
    $venue_query=mysqli_query($conn,$sql);
    if(!$venue_query){
        die("Failed". mysqli_error($conn));
    }


}
function remove_venue(){
    global $conn;
    $venue_id=$_POST['venue_id_get'];

// Create connection
    $venue_id= mysqli_real_escape_string($conn, $venue_id);
    $sql = "Delete from venues WHERE venue_id='{$venue_id}' ";
    $venue_query=mysqli_query($conn,$sql);
    if(!$venue_query){
        die("Failed". mysqli_error($conn));
    }

}
function Display_venues(){
global $conn;
    $query="Select * FROM venues ";
 $venue_query=mysqli_query($conn,$query);
    if(!$venue_query){
        die("Failed". mysqli_error($conn));
    }
    while ($row=mysqli_fetch_array($venue_query)){
$venue_name=$row['name'];
$venue_id=$row['venue_id'];
$venue_location=$row['venue_location'];

        echo"
        


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
function add_assignment($id_course,$id_instructor,$semester){
    global $conn;
    $title=$_POST['assignment-title'];
    $due_date=$_POST['due_date'];
    $publish_date=date('Y-m-d');
    $time=$_POST['time'];
$assignment=$_FILES['assignment']['name'];
$assignment_temp=$_FILES['assignment']['tmp_name'];
    move_uploaded_file($assignment_temp,"../media/$assignment");
$description=$_POST['description'];
// Need semester id and join on course id && semester id
    $sql = "INSERT INTO asignments (id_course,id_semester,id_instructor,title,due_time,due_date,publish_date, assignment ,description) VALUES ('$id_course', '$semester','$id_instructor','$title','$time','$due_date','$publish_date','$assignment','$description') ";
    $assignment_query=mysqli_query($conn,$sql);
    if(!$assignment_query){
        die("Failed ". mysqli_error($conn));
    }

}
function show_prof_assignment($id_course,$semester){
    global $conn;
    $query="Select * FROM asignments where id_course='$id_course' and id_semester='$semester' ";
    $assignments_query=mysqli_query($conn,$query);
    if(!$assignments_query){
        die("Failed". mysqli_error($conn));
    }
    while ($row=mysqli_fetch_array($assignments_query)){
        $id=$row['assignment_id'];
        $courseid=$row['id_course'];
        $title=$row['title'];
        $due_date=$row['due_date'];
        $publish_date=$row['publish_date'];
        $time=$row['due_time'];
        $assignment=$row['assignment'];
        $id_instructor=$row['id_instructor'];
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
function remove_prof_assignment(){
    global $conn;
   $id= $_POST['id'];
    $sql = "Delete from asignments WHERE assignment_id='{$id}' ";
    $ass_query=mysqli_query($conn,$sql);
    if(!$ass_query){
        die("Failed". mysqli_error($conn));
    }
}
function edit_prof_assignment_show($id,$id_course,$semester){

    global $conn;
    $query="Select * FROM asignments where assignment_id='$id' and id_course='$id_course' and id_semester='$semester' ";
    $assignments_query=mysqli_query($conn,$query);
    if(!$assignments_query){
        die("Failed". mysqli_error($conn));
    }
    while ($row=mysqli_fetch_array($assignments_query)){
      //  $id=$row['assignment_id'];
       // $courseid=$row['id_course'];
        $title=$row['title'];
        $due_date=$row['due_date'];
       // $publish_date=$row['publish_date'];
        $time=$row['due_time'];
        $assignment=$row['assignment'];
        $description=$row['description'];}

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
function edit_prof_assignment($id){
    global $conn;
    $title=$_POST['assignment-title'];
    $due_date=$_POST['due_date'];

    $time=$_POST['time'];
    $assignment=$_FILES['assignment']['name'];
    $assignment_temp=$_FILES['assignment']['tmp_name'];
    move_uploaded_file($assignment_temp,"../media/$assignment");
    $description=$_POST['description'];
    $sql = "UPDATE  asignments SET title ='$title',
    due_time= '$time',
    due_date= '$due_date',
    assignment = '$assignment',
    description = '$description'WHERE assignment_id='$id' ";
    $Edit_query=mysqli_query($conn,$sql);
    if(!$Edit_query){
        die("Failed". mysqli_error($conn));
    }


}
function show_prof_student_assignments($id){
global $conn;
$query="SELECT css.id_student
,s.arabic_name, s.student_group 
,sa.student_assignment,sa.grade ,sa.handin_date, sa.handin_time FROM course_semester_students css 
INNER JOIN students s ON css.id_student = s.student_id
INNER JOIN student_assignments sa on sa.id_student=css.id_student
 WHERE id_asignment='$id' ";
$i=0;
$result=mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($result)){
        $name = $row["arabic_name"];
        $id = $row['id_student'];
        $group = $row['student_group'];
        $assignment=$row['student_assignment'];
        $turn_date=$row['handin_date'];
        $turn_time=$row['handin_time'];
        $grade=$row['grade'];
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

function display_student_assignments($semester,$courseid){
    global $conn;
    $query="SELECT  a.assignment_id , a.title ,a.id_instructor ,
            a.due_time ,a.due_date, a.publish_date, a.assignment ,a.description 
            ,u.first_name , u.last_name 
            FROM asignments  a 
            INNER JOIN instructors i ON i.instructor_id= a.id_instructor
            INNER JOIN users  u ON i.id_user= u.id
            WHERE a.id_course ='$courseid' AND a.id_semester ='$semester'
    "  ;
    $assignments_query=mysqli_query($conn,$query);
    while ($row=mysqli_fetch_array($assignments_query)){
        $id=$row['assignment_id'];
        $title=$row['title'];
        $due_date=$row['due_date'];
        $publish_date=$row['publish_date'];
        $time=$row['due_time'];
        $assignment=$row['assignment'];
        $firstname=$row['first_name'];
        $lastname=$row['last_name'];
    
    echo"
    
    
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



function student_view_assignment($id,$studentid){
    global $conn;

    $check_query="SELECT * FROM student_assignments WHERE id_asignment='$id' AND id_student='$studentid' ";
    $check=mysqli_query($conn,$check_query);
if(mysqli_num_rows($check)!=0) {
 unturnin_view($id,$studentid);
}
else{
  turnin_view($id,$studentid);
    }
}
function unturnin_view($id,$studentid){
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
Assignment file: <a href='../media/$assignment'>$assignment</a>
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
function turnin_view($id,$studentid){
    global $conn;
    $query="Select * from asignments where assignment_id=$id ";
    $assignments_query=mysqli_query($conn,$query);
    while ($row=mysqli_fetch_array($assignments_query)) {
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
<a href='../media/$assignment'>$assignment</a>
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
function turnin ($id,$studentid){
    global $conn;
$student_assignment=$_FILES['student_assignment']['name'];
$student_assignment_temp=$_FILES['student_assignment']['tmp_name'];
$handin_date=date('Y-m-d');
$handin_time=date("h:i:sa");
    move_uploaded_file($student_assignment_temp,"../media/$student_assignment");
    $query="INSERT INTO  student_assignments (id_asignment,student_assignment,id_student,handin_date,handin_time) VALUES ('$id','$student_assignment','$studentid','$handin_date','$handin_time') ";

    $turnin_query=mysqli_query($conn,$query);
   echo "<META HTTP-EQUIV='Refresh' Content='0'; >";

    if(!$turnin_query){
        die("Failed". mysqli_error($conn));
    }
}
function unturnin ($id,$studentid){
    global $conn;
    $query="Delete from student_assignments where id_asignment='$id'and id_student='$studentid' ";
    $unturnin_query=mysqli_query($conn,$query);
    echo "<META HTTP-EQUIV='Refresh' Content='0'; >";

    if(!$unturnin_query){
        die("Failed". mysqli_error($conn));
    }
}
function add_assignment_grade(){
    global $conn;
$h=count($_POST['grade']);


 for($i=0;$i<$h;$i++){
     $point=$_POST['grade'][$i]['point'];
     $id=$_POST['grade'][$i]['id'];
         $query="UPDATE student_assignments SET grade='{$point}' WHERE id_student='{$id}' ";
         $result=mysqli_query($conn, $query);

     }
    echo "<meta http-equiv='refresh' content='0'>";
}