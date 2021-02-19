<?php


include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";

/**
 * @param string $pageName
 */
function showStudents($pageName)
{
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
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
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
    global $studentsTable, $countRows;

    list($per_page, $page_1, $countRows, $_) = getRowsPerPage($studentsTable);

    $mainSqlQuery = "SELECT s.*, u.* 
                FROM {$studentsTable} s 
                join users u 
                    on s.id_user = u.id
                ORDER BY s.level DESC limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
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
                        VALUES (default, '$first_name', '$middle_name', '$last_name', $national_id, '$studentsType', '$email', '$password', '$gender', '$mobile_number', '$home_number', default);";

    mysqli_autocommit($dataBaseConnection, FALSE);
                        
    $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    $last_id = mysqli_insert_id($dataBaseConnection);

    // query for adding a student
    $secondSqlQuery = "INSERT INTO students (id_user, student_id, arabic_name, address, guardian_mobile_number, student_type)
                                    VALUES ($last_id, $student_id, '$arabic_name', '$address', '$guardian_mobile_number', '$student_type');";
    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

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
    checkResultQuery($result1, $dataBaseConnection, __FUNCTION__);

    $result3 = mysqli_query($dataBaseConnection, $secondSqlQuery);
    checkResultQuery($result3, $dataBaseConnection, __FUNCTION__);

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
    list($address, $guardian_mobile_number) = studentEditProfileForm();

    // handling realescape
    $dataBaseConnection = connectToDataBase();
    $address = mysqli_real_escape_string($dataBaseConnection, $address);

    $mainSqlQuery = "UPDATE students
             SET address='{$address}', guardian_mobile_number='{$guardian_mobile_number}'
             WHERE id_user = {$id};";

    mysqli_autocommit($dataBaseConnection, FALSE);

    editProfileCommon($id, $dataBaseConnection);

    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}
