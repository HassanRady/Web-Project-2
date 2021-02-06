<?php
// getting connection
include_once "../db_conn.php";

// global variables
include "../variables.php";

// helper functions
include "../helper.php";

// printing functions
include "../print_functions.php";

// form data retriever functions
include "../form_functions.php";


/**
 * @param int $id
 * @return array student's data
 */
function getStudent($id)
{
    global $studentsTable;

    $mainSqlQuery = "SELECT s.*, u.* 
    FROM {$studentsTable} s 
    join users u 
        on s.id_user = u.id
    WHERE u.id = $id";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $studentData =  $result->fetch_assoc();
    return $studentData;
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


function addStudent()
{
    global $studentsType;

    list($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number) = NewUserDataForm();
    list($student_id, $arabic_name, $address, $guardian_mobile_number, $student_type) = NewStudentDataForm();

    // handling realescape
    $dataBaseConnection = connectToDataBase();
    $email = mysqli_real_escape_string($dataBaseConnection, $email);
    $address = mysqli_real_escape_string($dataBaseConnection, $address);

    $password = encrypt_password($password);

    // for users table
    $firstSqlQuery = "INSERT INTO users 
                        VALUES (default, '$first_name', '$middle_name', '$last_name', $national_id, '$studentsType', '$email', '$password', '$gender', '$mobile_number', '$home_number');";
    $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    $last_id = mysqli_insert_id($dataBaseConnection);

    // query for adding a student
    $secondSqlQuery = "INSERT INTO students (id_user, student_id, arabic_name, address, guardian_mobile_number, student_type)
                                    VALUES ($last_id, $student_id, '$arabic_name', '$address', '$guardian_mobile_number', '$student_type');";
    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();
}


/**
 * @param int $id
 */
function studentProfile($id)
{
    global  $address, $level, $guardian_mobile_number;

    $data = getStudent($id);

    getDataForProfile($data);

    $address = $data['address'];
    $level = $data['level'];
    $guardian_mobile_number = $data['guardian_mobile_number'];
}
