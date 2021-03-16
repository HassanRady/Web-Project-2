<?php


include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";

/**
 * @author Hassan
 * @param int $id
 * @return array
 */
function searchForStudent()
{
    global $studentsTable, $rowsPerPage, $student_name, $student_email, $student_id, $student_level, $countRows;
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
                    WHERE u.email LIKE '%$student_email%' AND s.student_id LIKE '%$student_id%' AND u.first_name LIKE '%$student_name%'
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

/**
 * @author Hassan
 * @param array $studentsData
 * @return void
 */
function showStudentSearch($studentsData)
{
    // global $studentsData;
    printStudentsData($studentsData);
}
