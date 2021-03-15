<?php

include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";


/**
 * @author Hassan
 * @return void
 */
function showSas()
{
    global $sasType;
    $data = getSasData();
    printCommonData($data, $sasType);
}


/**
 * @author Hassan
 * @param int $id
 * @return array SA's data
 */
function getSa($id)
{
    global $sasTable;

    $mainSqlQuery = "SELECT s.*, u.* 
    FROM {$sasTable} s 
    join users u 
        on s.id_user = u.id
    WHERE u.id = $id";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $saData =  $result->fetch_assoc();
    return $saData;
}


/**
 * @author Hassan
 * @param int $id
 * @return array admin's data
 */
function getAdmin($id)
{
    global $adminsTable;

    $mainSqlQuery = "SELECT a.*, u.* 
    FROM {$adminsTable} a 
    join users u 
        on a.id_user = u.id
    WHERE u.id = $id";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $saData =  $result->fetch_assoc();
    return $saData;
}
/**
 * @author Hassan
 * @param int $id
 */
function adminProfile($id)
{
    $data = getAdmin($id);
    getDataForProfile($data);
}
/**
 * @author Hassan
 * @param int $id
 */
function editAdminProfile($id)
{
    editProfileCommon($id);
}



/**
 * @author Hassan
 * @param array $data
 */
function getDataFromSa($data)
{
    global $department, $instructor_id;
    $department = $data['department'];
    $instructor_id = $data['id_instructor'];
}


/**
 * @author Hassan
 * @return array all SA's data
 */
function getSasData()
{
    global $sasTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($sasTable);

    $mainSqlQuery = "SELECT s.*, u.* 
                        FROM {$sasTable} s 
                        join users u 
                            on s.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $sasData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $sasData[$count++] = $row;
    }

    return $sasData;
}


/**
 * @author Hassan
 * @return array all admins data
 */
function getAdminsData()
{
    global $adminsTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($adminsTable);

    $mainSqlQuery = "SELECT a.*, u.* 
                        FROM {$adminsTable} a 
                        join users u 
                            on a.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $adminsData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $adminsData[$count++] = $row;
    }

    return $adminsData;
}

/**
 * @author Hassan
 * @return void
 */
function addsa()
{
    global $sasType;

    list($instructor_id, $department) = NewSaDataForm();

    $dataBaseConnection = connectToDataBase();

    mysqli_autocommit($dataBaseConnection, false);
    addUser($sasType, $dataBaseConnection);

    $last_id = mysqli_insert_id($dataBaseConnection);

    $secondSqlQuery = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    $thirdSqlQuery = "INSERT INTO sas VALUES ($last_id, '$department', $instructor_id);";
    $result =  mysqli_query($dataBaseConnection, $thirdSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}

/**
 * @author Hassan
 * @param int $id 
 * @return void
 */
function updateSaData($id)
{
    list($first_name, $middle_name, $last_name, $national_id, $email, $_, $gender, $mobile_number, $home_number) = NewUserDataForm();
    list($instructor_id, $department) = NewSaDataForm();

    // handling realescape
    $dataBaseConnection = connectToDataBase();
    $email = mysqli_real_escape_string($dataBaseConnection, $email);


    // query for updating user in users table
    $firstSqlQuery = "UPDATE users
    SET first_name='{$first_name}', middle_name='{$middle_name}',  
        last_name='{$last_name}', national_id={$national_id},
        email='{$email}', gender='{$gender}', mobile_number='{$mobile_number}', home_number='{$home_number}'
    WHERE id = {$id};";
    // query for updating instructor in instructors table
    $secondSqlQuery = "UPDATE instructors
    SET instructor_id='{$instructor_id}'
    WHERE id_user = {$id};";
    // query for updating professor in professors table
    $thirdSqlQuery = "UPDATE sas
    SET department='{$department}'
    WHERE id_user = {$id};";

    mysqli_autocommit($dataBaseConnection, false);

    $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    $result =  mysqli_query($dataBaseConnection, $thirdSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}


/**
 * @author Hassan
 * @param int $id
 */
function saProfile($id)
{
    $data = getSa($id);
    getDataForProfile($data);
}


/**
 * @author Hassan
 * @param int $id
 */
function editSaProfile($id)
{
    editProfileCommon($id);
}






function getAvailableCourses($category)
{
    global $conn;
    $query = "SELECT * FROM courses WHERE category='{$category}'";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    return $query_result;
}


function getCoursePrerequisite($courseId)
{
    global $conn;
    $prerequisite = "-";
    $preq_query = "SELECT name from prerequisites p
    INNER JOIN courses c on p.prerequisite_id = c.course_id
    WHERE p.id_course = $courseId";
    $preq_query_result = mysqli_query($conn, $preq_query);
    $data = mysqli_fetch_assoc($preq_query_result);
    if (mysqli_num_rows($preq_query_result)) {
        $prerequisite = $data['name'];
    }
    return $prerequisite;
}



function checkIfCourseIsOpen($courseId)
{
    global $conn;
    $query = "SELECT EXISTS (SELECT * FROM open_courses WHERE course_id = $courseId)";
    $query_result = mysqli_query($conn, $query);
    checkQuery($query_result);
    if (mysqli_num_rows($query_result) == 1) {
        return true;
    }
    return false;
}


function openCourse($courseId, $professorId, $level)
{
    global $conn;

    if (checkIfCourseIsOpen($courseId)) {
        // open_courses table
        $open_course_query = "INSERT INTO open_courses(level, student_count, course_id) VALUES ('$level', '0', '$courseId');";
        $open_course_query_result = mysqli_query($conn, $open_course_query);
        checkQuery($open_course_query_result);

        // open_courses_instructors table 
        $instructor_query = "INSERT INTO open_courses_instructors(instructor_id, course_id) VALUES ('$professorId', '$courseId');";
        $instructor_query_result = mysqli_query($conn, $instructor_query);
        checkQuery($instructor_query_result);
    }
}
