<?php
session_start();


if(isset($_POST['submit'])){
    for(){
        updateStudentGrades();
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
            $courseId = $_GET['course_id'];
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
                <div class="container-fluid">
                    <div class="row table-container table-responsive">
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
                            <tbody style="color: rgb(0,0,0,0.5);">
                                <form action= "" method="post">
                                    <?php
                                        $query_result = getRegisteredStudentsMarks($courseId); 
                                        while ($row = mysqli_fetch_assoc($query_result)) {
                                            $grade = $row['grade'] ? $row['grade'] : "F";
                                            $gpa = $row['gpa'];
                                            $oral = $row['oral'];
                                            $mid = $row['midterm'];
                                            $cw = $row['course_work'];
                                            $practical = $row['practical'];
                                            $final = $row['final'];
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['id_student']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row["arabic_name"]; ?>
                                                </td>
                                                <td><input type='number' name='midterm' value="<?php echo $row["midterm"]; ?>"></td>
                                                <td><input type='number' name='oral' value="<?php echo $row["oral"]; ?>"></td>
                                                <td><input type='number' name='practical' value="<?php echo $row["practical"]; ?>"></td>
                                                <td><input type='number' name='cw' value="<?php echo $row["course_work"]; ?>"></td>
                                                <td><input type='number' name='final' value="<?php echo $row["final"]; ?>"></td>
                                            </tr>
                                    <?php } 
                                    ?>
                                </form>

                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button class="btn btn-block btn-primary" type="submit" name="submit">Upload</button>
                </div>









                <!-- STOP HERE -->



            </div>
        </div>

        <?php include "../includes/bootstrap_styles_end.php"; ?>
        <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>