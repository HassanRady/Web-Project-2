<?php
session_start();
include_once "../includes/utils/helper.php";
include_once "../includes/db_conn.php";
include_once "../includes/Professor/functions.php";

$courseId = $_GET['course_id'];
$success = null;
if(isset($_POST['submit'])){

    if(updateStudentGrades($courseId)){
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Edit Student Marks</title>

    <link rel="stylesheet" href="css/table.css">

    <?php include "../includes/bootstrap_styles_start.php"; ?>


</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php
            include_once dirname(__FILE__, 2) .DIRECTORY_SEPARATOR. "paths.php";

            include_once $professor_sidebar_path;
        ?>
        <!-- Page Content  -->
        <div id="content">

        <?php
        include_once $professor_navbar_path;
        ?>


            <div class="page-body">
                <!-- START HERE -->
                <h3 class="font-weight-bold" style=" color:rgb(31,108,236);">
                    Course Grades
                </h3>
                <hr class="mb-4">
                <?php if($success){ ?>
                    <div class="alert alert-primary" role="alert">
                        Student marks successfully updated.
                    </div>
                <?php } ?>
                <div class="container-fluid">
                    <div class="row table-container table-responsive w-100">
                        <table class="table">
                            <thead>
                                <tr style="color:rgb(31,108,236);">
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Midterm</th>
                                    <th scope="col">Oral</th>
                                    <th scope="col">Practical</th>
                                    <th scope="col">Coursework</th>
                                    <th scope="col">Final</th>
                                </tr>
                            </thead>
                            <form id="marks" action="" method="post">
                                <tbody style="color: rgb(0,0,0,0.5);">
                                    <?php
                                        $query_result = getRegisteredStudentsMarks($courseId);
                                        $i = 0;
                                        while ($row = mysqli_fetch_assoc($query_result)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['id_student']; ?>
                                                    <input type='number' style="display:none;" name=<?php echo "grade[$i][id]" ?> value="<?php echo $row["id_student"]; ?>">
                                                </td>
                                                <td>
                                                    <?php echo $row["arabic_name"]; ?>
                                                </td>
                                                <td><input type='number' name=<?php echo "grade[$i][midterm]" ?> value="<?php echo $row["midterm"]; ?>"></td>
                                                <td><input type='number' name=<?php echo "grade[$i][oral]" ?> value="<?php echo $row["oral"]; ?>"></td>
                                                <td><input type='number' name=<?php echo "grade[$i][practical]" ?> value="<?php echo $row["practical"]; ?>"></td>
                                                <td><input type='number' name=<?php echo "grade[$i][cw]" ?> value="<?php echo $row["course_work"]; ?>"></td>
                                                <td><input type='number' name=<?php echo "grade[$i][final]" ?> value="<?php echo $row["final"]; ?>"></td>
                                            </tr>
                                    <?php 
                                            $i++;
                                        } 
                                    ?>
                                </tbody>
                            </form>
                        </table>
                    </div>
                    <br>
                    <button class="btn btn-block btn-primary" form="marks" type="submit" name="submit">Upload</button>
                    
                </div>









                <!-- STOP HERE -->



            </div>
        </div>

        <?php include "../includes/bootstrap_styles_end.php"; ?>
        <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>