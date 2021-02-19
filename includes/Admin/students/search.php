<?php


include_once dirname(__FILE__, 3) . "\\utils\\iniclude_utils_files.php";


function searchForStudent()
{
    global $studentsTable, $rowsPerPage, $student_email, $student_id, $student_level, $countRows;
    $student_email = "";

    if (isset($_POST['submit'])) {
        $student_name = $_POST['student-name'];
        $student_id = $_POST['student-id'];
        $student_email = $_POST['student-email'];
        $student_level = $_POST['student-level'];

        $level_search = $student_level[6];

        $mainSqlQuery = "SELECT s.*, u.* 
                FROM {$studentsTable} s 
                join users u 
                    on s.id_user = u.id
                    WHERE u.email LIKE '%$student_email%' AND s.student_id LIKE '%$student_id%'
                    ORDER BY s.level = {$level_search} DESC, s.level DESC;";

        $dataBaseConnection = connectToDataBase();
        $resultQuery = mysqli_query($dataBaseConnection, $mainSqlQuery);
        checkResultQuery($resultQuery, $dataBaseConnection, __FUNCTION__);
        $dataBaseConnection->close();

        $studentsData = array();
        $countRows = 0;

        while ($row = $resultQuery->fetch_assoc()) {
            $studentsData[$countRows++] = $row;
        }

        $countRows  = ceil($countRows / $rowsPerPage);


        return $studentsData;
    }
}


function showStudentSearch($studentsData)
{
    $pageName = basename($_SERVER['PHP_SELF']);
    printStudentsData($studentsData, $pageName);
}
