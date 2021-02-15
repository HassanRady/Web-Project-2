<?php

// getting connection
include_once dirname(__FILE__, 2) . "\\db_conn.php";

// global variables
include_once dirname(__FILE__, 2) . "\\utils\\variables.php";

// helper functions
include_once dirname(__FILE__, 2) . "\\utils\\helper.php";

// printing functions
include_once dirname(__FILE__, 2) . "\\utils\\print_functions.php";

// form data retriever functions
include_once dirname(__FILE__, 2) . "\\utils\\form_functions.php";

include_once dirname(__FILE__, 2) . "\\utils\\all.php";


/**
 * @param string $pageName
 */
function showStudents($pageName)
{
    global $studentsType;
    $type = $studentsType;
    $data = getStudentsData();
    printStudentsData($data, $pageName);
}


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
 * @param array $data
 */
function getDataFromStudent($data)
{
    global $student_id, $arabic_name, $address, $guardian_mobile_number, $student_type;

    $student_id = $data['student_id'];
    $arabic_name = $data['arabic_name'];

    $address = $data['address'];
    $guardian_mobile_number = $data['guardian_mobile_number'];
    $student_type = $data['student_type'];
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

    mysqli_autocommit($dataBaseConnection, FALSE);
                        
    $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    $last_id = mysqli_insert_id($dataBaseConnection);

    // query for adding a student
    $secondSqlQuery = "INSERT INTO students (id_user, student_id, arabic_name, address, guardian_mobile_number, student_type)
                                    VALUES ($last_id, $student_id, '$arabic_name', '$address', '$guardian_mobile_number', '$student_type');";
    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}


function updateStudentData($id)
{

    list($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number) = NewUserDataForm();
    list($student_id, $arabic_name, $address, $guardian_mobile_number, $student_type) = NewStudentDataForm();

    // handling realescape
    $dataBaseConnection = connectToDataBase();
    $email = mysqli_real_escape_string($dataBaseConnection, $email);
    $address = mysqli_real_escape_string($dataBaseConnection, $address);

    $password = encrypt_password($password);

    // query for updating user in users table
    $firstSqlQuery = "UPDATE users
    SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}',
        last_name='{$last_name}', national_id={$national_id},
        email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
    WHERE id = {$id};";

    // query for updating student in students table
    $secondSqlQuery = "UPDATE students
    SET student_id={$student_id}, arabic_name='{$arabic_name}', 
        address='{$address}', guardian_mobile_number='{$guardian_mobile_number}',
        student_type='{$student_type}'
    WHERE id_user = {$id};";

    mysqli_autocommit($dataBaseConnection, FALSE);

    $result1 = mysqli_query($dataBaseConnection, $firstSqlQuery);
    check_result($result1, $dataBaseConnection, __FUNCTION__);

    $result2 = mysqli_query($dataBaseConnection, $secondSqlQuery);
    check_result($result2, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
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


/**
 * @param int $id
 */
function editStudentProfile($id)
{
    list($first_name, $middle_name, $last_name, $_, $_, $password, $_, $mobile_number, $home_number) = NewUserDataForm();
    list($_, $_, $address, $guardian_mobile_number, $_) = NewStudentDataForm();

    // handling realescape
    $dataBaseConnection = connectToDataBase();
    $address = mysqli_real_escape_string($dataBaseConnection, $address);

    $password = encrypt_password($password);

    $firstSqlQuery = "UPDATE users
             SET first_name='{$first_name}', password='{$password}', middle_name='{$middle_name}',
                 last_name='{$last_name}',  mobile_number='{$mobile_number}', home_number='{$home_number}'
             WHERE id = {$id};";
    // query for updating student in students table
    $secondSqlQuery = "UPDATE students
             SET address='{$address}', guardian_mobile_number='{$guardian_mobile_number}'
             WHERE id_user = {$id};";

    mysqli_autocommit($dataBaseConnection, FALSE);

    $result1 = mysqli_query($dataBaseConnection, $firstSqlQuery);
    check_result($result1, $dataBaseConnection, __FUNCTION__);

    $result2 = mysqli_query($dataBaseConnection, $secondSqlQuery);
    check_result($result2, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}
