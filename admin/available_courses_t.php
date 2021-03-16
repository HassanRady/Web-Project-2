<?php
ob_start();
include "../includes/functions.php";
include dirname(__FILE__, 2) . "\\includes\\Admin\\sas\\functions.php";
session_start();
?>

<?php 
if(isset($_POST['openCourse'])){
  $courseId = $_POST['courseId'];
  $level = $_POST['level'];
  $professor = $_POST['professor'];
  print_r($_POST);
  openCourse($courseId, $professor, $level);
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Available Courses</title>
  <?php include "../includes/bootstrap_styles_start.php"; ?>
  <link rel="stylesheet" href="css/available_courses.css">
  <link rel="stylesheet" href="css/table.css">
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar  -->
    <?php include "../includes/admin_sidebar.php"; ?>
    <!-- Page Content  -->
    <div id="content">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light shadow-sm">
        <div class="container-fluid">
        <button type="button" id="sidebarCollapse" class="btn btn-primary">
          <i class="fas fa-align-left"></i>
          <!-- <span id="nav-toggle-text">Navigation</span> -->
        </button>
        <a class="navbar-brand" id="page-title" href="#">Available Courses</a>
        <div class="ml-auto"></div>
      </nav>

      <!-- Body -->
      <div class="page-body">
        <!-- START HERE -->
        <div class="container-fluid">
          <div class="row justify-content-end">
              <a href="add_new_course.php" class=" btn btn-primary btn-block w-25 ml-auto">Add New</a>
          </div>
        </div>
        <hr class="mb-4">

        <!-- University Courses -->
        <br>
        <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">University Courses</h4>
        <hr class="mb-4">
        <div class="table-container table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credits</th>
                <th scope="col">Type</th>
                <th scope="col">Prerequisites</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $university_courses = getAvailableCourses('university');
                while ($row = mysqli_fetch_assoc($university_courses)) {
                  $cname = $row['name'];
                  $id = $row['course_id'];
                  $credits = $row['credits'];
                  $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
                  $has_preq = $row['has_preq'];
                  $prerequisite = getCoursePrerequisite($id);
              ?>
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $cname ?></td>
                  <td><?php echo $credits ?></td>
                  <td><?php echo $type ?></td>
                  <td><?php echo $prerequisite ?></td>
                  <td><a data-id='<?php echo $id ?>' class='btn btn-primary launch-modal' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
                  <td><a href='edit_course.php?course_id=<?php echo $id ?>' class='btn btn-outline-secondary'>Options</a></td>
                </tr>
              <?php } ?> 
            </tbody>
          </table>
        </div>

        <!-- Faculty Courses -->
        <br>
        <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">Faculty Courses</h4>
        <hr class="mb-4">
        <div class="table-container table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credits</th>
                <th scope="col">Type</th>
                <th scope="col">Prerequisites</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $faculty_courses = getAvailableCourses('faculty');
                while ($row = mysqli_fetch_assoc($faculty_courses)) {
                  $cname = $row['name'];
                  $id = $row['course_id'];
                  $credits = $row['credits'];
                  $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
                  $has_preq = $row['has_preq'];
                  $prerequisite = getCoursePrerequisite($id);
              ?>
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $cname ?></td>
                  <td><?php echo $credits ?></td>
                  <td><?php echo $type ?></td>
                  <td><?php echo $prerequisite ?></td>
                  <td><a data-id='<?php echo $id ?>' class='btn btn-primary launch-modal' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
                  <td><a href='edit_course.php?course_id=<?php echo $id ?>' class='btn btn-outline-secondary'>Options</a></td>
                </tr>
              <?php } ?> 
            </tbody>
          </table>
        </div>

        <!-- SIM Courses -->
        <br>
        <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">SIM Courses</h4>
        <hr class="mb-4">
        <div class="table-container table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credits</th>
                <th scope="col">Type</th>
                <th scope="col">Prerequisites</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $sim_courses = getAvailableCourses('sim');
                while ($row = mysqli_fetch_assoc($sim_courses)) {
                  $cname = $row['name'];
                  $id = $row['course_id'];
                  $credits = $row['credits'];
                  $type = $row['elective'] == "yes" ? "Elective" : "Mandatory";
                  $has_preq = $row['has_preq'];
                  $prerequisite = getCoursePrerequisite($id);
              ?>
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $cname ?></td>
                  <td><?php echo $credits ?></td>
                  <td><?php echo $type ?></td>
                  <td><?php echo $prerequisite ?></td>
                  <td><a data-id='<?php echo $id ?>' class='btn btn-primary launch-modal' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
                  <td><a href='edit_course.php?course_id=<?php echo $id ?>' class='btn btn-outline-secondary'>Options</a></td>
                </tr>
              <?php } ?> 
            </tbody> 
          </table>
        </div>

        <!-- Free Courses -->
        <br>
        <h4 class="font-weight-bold" style=" color:rgb(31,108,236);">Free Courses</h4>
        <hr class="mb-4">
        <div class="table-container table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Course ID</th>
                <th scope="col">Course Name</th>
                <th scope="col">Credits</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $free_courses = getAvailableCourses('free');
                while ($row = mysqli_fetch_assoc($free_courses)) {
                  $cname = $row['name'];
                  $credits = $row['credits'];
                  $id = $row['course_id'];
              ?>
                <tr>
                  <td><?php echo $id ?></td>
                  <td><?php echo $cname ?></td>
                  <td><?php echo $credits ?></td>
                  <td><a data-id='<?php echo $id ?>' class='btn btn-primary launch-modal' data-toggle='modal' data-target='#modalContactForm'>Open</a></td>
                  <td><a href='edit_course.php?course_id=<?php echo $id ?>' class='btn btn-outline-secondary'>Options</a></td>
                </tr>
              <?php } ?> 

            </tbody>
          </table>
        </div>
        <br>
        <a href="end_semester.php" class="btn btn-outline-danger btn-lg btn-block">END SEMESTER</a>

        <!-- Open Course Modal -->
        <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <form action="#" method="post" enctype="multipart/form-data">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalLabel">Open Course</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <label class="label" for="professor">Professor</label>
                  <select class="custom-select d-block w-100" name="professor" id="professor" required>
                    <option value="">Choose...</option>
                    <option value="2147483647">External Professor</option>
                    <?php 
                      $professors = getProfessorList();
                      while ($row = mysqli_fetch_assoc($professors)) {
                        $id = $row['instructor_id'];
                        $fname = $row['first_name'];
                        $mname = $row['middle_name'];
                        $lname = $row['last_name'];
                      ?>
                      <option value='<?php echo $id ?>'><?php echo "$fname $mname $lname"?></option>
                    <?php } ?>
                  </select>
                  <br />
                  <label class="label" for="level">Level</label>
                  <select class="custom-select d-block w-100" name="level" id="level" required>
                    <option value="1">Level 1</option>
                    <option value="2">Level 2</option>
                    <option value="3">Level 3</option>
                    <option value="4">Level 4</option>
                  </select>
                  <input type="text" class="form-control" name="courseId" id="courseId" style="display:none;">
                </div>
                <div class="modal-footer">
                  <button type="submit" name="openCourse" class="btn btn-primary">Confirm</button>
                </div>
              </div>
            </div>
          </form>
        </div>


      </div>

    </div>
  </div>


  <?php include "../includes/bootstrap_styles_end.php"; ?>
  <script type="text/javascript" src="../js/rootJS.js"></script>
  <script>
  $(document).on("click", ".launch-modal", function () {
    var id = $(this).data('id');
    console.log("clicked")
    $(".modal-body #courseId").val( id );
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    // $('#addBookDialog').modal('show');
});
  </script>
  
</body>

</html>
<?php ob_end_flush(); ?>