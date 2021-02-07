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
function showSas($pageName)
{
    global $SasType;
    $type = $SasType;
    $data = getSasData();
    printSasData($data, $pageName);
}


/**
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
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $saData =  $result->fetch_assoc();
    return $saData;
}


/**
 * @param array $data
 */
function getDataFromSa($data)
{
    global $department;
    $department = $data['department'];
}


/**
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
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $sasData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $sasData[$count++] = $row;
    }

    return $sasData;
}


/**
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
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $adminsData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $adminsData[$count++] = $row;
    }

    return $adminsData;
}


function addsa()
{
    global $sasType;

    list($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number) = NewUserDataForm();
    list($instructor_id, $department) = NewSaDataForm();

    // handling realescape
    $dataBaseConnection = connectToDataBase();
    $email = mysqli_real_escape_string($dataBaseConnection, $email);

    $password = encrypt_password($password);

    // for users table
    $firstSqlQuery = "INSERT INTO users 
                        VALUES (default, '$first_name', '$middle_name', '$last_name', $national_id, '$sasType', '$email', '$password', '$gender', '$mobile_number', '$home_number');";

    mysqli_autocommit($dataBaseConnection, FALSE);

    $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    $last_id = mysqli_insert_id($dataBaseConnection);

    $secondSqlQuery = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    $thirdSqlQuery = "INSERT INTO sas VALUES ($last_id, '$department');";
    $result =  mysqli_query($dataBaseConnection, $thirdSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}


function updateSaData($id)
{
    list($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number) = NewUserDataForm();
    list($instructor_id, $department) = NewSaDataForm();

    // handling realescape
    $dataBaseConnection = connectToDataBase();
    $email = mysqli_real_escape_string($dataBaseConnection, $email);

    $password = encrypt_password($password);

    // query for updating user in users table
    $firstSqlQuery = "UPDATE users
    SET first_name='{$first_name}', middle_name='{$middle_name}', password='{$password}', 
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

    mysqli_autocommit($dataBaseConnection, FALSE);

    $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    $result =  mysqli_query($dataBaseConnection, $thirdSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}


/**
 * @param int $id
 */
function saProfile($id)
{
    $data = getSa($id);
    getDataForProfile($data);
}


/**
 * @param int $id
 */
function editSaProfile($id)
{
    list($first_name, $middle_name, $last_name, $_, $_, $password, $_, $mobile_number, $home_number) = NewUserDataForm();

    $dataBaseConnection = connectToDataBase();
    $password = encrypt_password($password);

    $mainSqlQuery = "UPDATE users
         SET first_name='{$first_name}', password='{$password}', middle_name='{$middle_name}',
             last_name='{$last_name}',  mobile_number='{$mobile_number}', home_number='{$home_number}'
         WHERE id = {$id};";

    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();
}
