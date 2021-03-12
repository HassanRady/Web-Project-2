<?php

include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";


function showTas()
{
    $data = getTasData();
    printCommonData($data);
}


/**
 * @param int $id
 * @return array TA's data
 */
function getTa($id)
{
    global $tasTable;

    $mainSqlQuery = "SELECT t.*, u.* 
    FROM {$tasTable} t 
    join users u 
        on t.id_user = u.id
    WHERE u.id = $id";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);

    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $taData =  $result->fetch_assoc();
    return $taData;
}

/**
 * @param array $data
 */
function getDataFromTa($data)
{
    global $description;
    $description = $data['description'];
}


/**
 * @return array all TA's data
 */
function getTasData()
{
    global $tasTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($tasTable);

    $mainSqlQuery = "SELECT t.*, u.* 
                        FROM {$tasTable} t 
                        join users u 
                            on t.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $tasData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $tasData[$count++] = $row;
    }

    return $tasData;
}


function addTa()
{
    global $tasType;

    list($instructor_id, $description) = NewTaDataForm();

    $dataBaseConnection = connectToDataBase();

    mysqli_autocommit($dataBaseConnection, FALSE);
    addUser($tasType, $dataBaseConnection);

    $last_id = mysqli_insert_id($dataBaseConnection);

    $secondSqlQuery = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    $thirdSqlQuery = "INSERT INTO tas VALUES ($last_id, $instructor_id, '$description');";
    $result =  mysqli_query($dataBaseConnection, $thirdSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}


function updateTaData($id)
{
    list($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number) = NewUserDataForm();
    list($instructor_id, $description) = NewTaDataForm();

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
    $thirdSqlQuery = "UPDATE tas
    SET description='{$description}'
    WHERE id_user = {$id};";

    mysqli_autocommit($dataBaseConnection, FALSE);

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
 * @param int $id
 */
function taProfile($id)
{
    $data = getTa($id);
    getDataForProfile($data);
}

/**
 * @param int $id
 */
function editTaProfile($id)
{
    editProfileCommon($id);
}
