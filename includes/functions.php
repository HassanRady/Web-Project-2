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
function add_assignment($id_course,$id_instructor){
    global $conn;
    $title=$_POST['assignment-title'];
    $due_date=$_POST['due_date'];
    $publish_date=date('Y-m-d');
    $time=$_POST['time'];
$assignment=$_FILES['assignment']['name'];
$assignment_temp=$_FILES['assignment']['tmp_name'];
    move_uploaded_file($assignment_temp,"../media/$assignment");
$description=$_POST['description'];
    $sql = "INSERT INTO asignments (id_course,id_instructor,title,due_time,due_date,publish_date, assignment ,description) VALUES ('$id_course','$id_instructor','$title','$time','$due_date','$publish_date','$assignment','$description') ";
    $assignment_query=mysqli_query($conn,$sql);
    if(!$assignment_query){
        die("Failed ". mysqli_error($conn));
    }

}
function show_prof_assignment($id_course,$id_instructor){
    global $conn;
    $query="Select * FROM asignments where id_course='$id_course' and id_instructor='$id_instructor' ";
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
            <a class='btn btn-outline-secondary btn-block ' href='Edit_assignment.php?id=$id&courseid=$courseid&instructorid=$id_instructor'>Edit</a>
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
function edit_prof_assignment_show($id,$id_course,$id_instructor){

    global $conn;
    $query="Select * FROM asignments where assignment_id='$id' and id_course='$id_course' and id_instructor='$id_instructor' ";
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
                    <form class='needs-validation' novalidate method='post' enctype='multipart/form-data'>
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
                                    <input type='file' name='assignment' class='custom-file-input' id='customFile' value=''>
                                    <label class='custom-file-label' for='customFile'>$assignment</label>
                                </div>

                            </div>

                            <div class='col-lg-12 mb-3'>
                                <label for='aboutTextArea'>Description</label>
                                <textarea class='form-control' name='description' placeholder='What is required?' id='aboutTextArea'
                                          style='resize: none; height: 150px;'> $description</textarea>
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
    $publish_date=date('Y-m-d');
    $time=$_POST['time'];
    $assignment=$_FILES['assignment']['name'];
    $assignment_temp=$_FILES['assignment']['tmp_name'];
    move_uploaded_file($assignment_temp,"../media/$assignment");
    $description=$_POST['description'];
    $sql = "UPDATE  asignments SET title ='$title',
    due_time= '$time',
    due_date= '$due_date',
    publish_date= '$publish_date',
    assignment = '$assignment',
    description = '$description'WHERE assignment_id='$id' ";
    $Edit_query=mysqli_query($conn,$sql);
    if(!$Edit_query){
        die("Failed". mysqli_error($conn));
    }


}