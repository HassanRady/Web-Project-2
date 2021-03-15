
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>std-grades</title>

    <link rel="stylesheet" href="css/table.css">

    <?php include "../includes/bootstrap_styles_start.php"; ?>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php
        include_once dirname(__FILE__, 2) ."\\includes\\Professor\\functions.php";
        include_once dirname(__FILE__, 2) .DIRECTORY_SEPARATOR. "paths.php";

        include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "includes\\Admin\\all_types\\functions.php";

        session_start();
        $user_id = $_SESSION['id'];

        if (isHeProfessorAndAdmin($user_id))
            include $admin_sidebar_path;
        else
            include $professor_sidebar_path;
        $courseId = $_GET['course_id'];
    ?>
        
        <div id="content">
        <?php
        include_once $professor_navbar_path;
        ?>


            <div class="page-body">
                <!-- START HERE -->
                <h3 class="font-weight-bold" style=" color:rgb(31,108,236);">
                    Students Marks </h3>
                <div>
                    <hr class="mb-4">
                    <div class="container-fluid">
                        <div class="row table-container table-responsive ">
                            <table class="table ">
                                <thead>
                                    <tr style="color:rgb(31,108,236);">

                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Midterm</th>
                                        <th scope="col">Oral</th>
                                        <th scope="col">Practical</th>
                                        <th scope="col">CW</th>
                                        <th scope="col">Final</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Grade</th>
                                        <th scope="col">GPA</th>
                                    </tr>
                                </thead>
                                <tbody style="color: rgb(0,0,0,0.5);">
                                    <?php
                                        getRegisteredStudentsMarks($courseId);
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <input id="button" class="btn btn btn-primary btn-block" type="submit" value="Approve">
                    <a  href="edit_std_grades.php?<?php echo "course_id=" . $courseId . "&sem_id=" . $semester ?>" class="btn btn btn-outline-secondary btn-block" >Edit</a>
                    <br>
                </div>
                













                <!-- STOP HERE -->
            </div>


        </div>
    </div>

    <?php include "../includes/bootstrap_styles_end.php"; ?>
    <script type="text/javascript" src="../js/rootJS.js"></script>

</body>

</html>