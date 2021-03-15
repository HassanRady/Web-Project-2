<?php

include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";


/**
 * @author Hassan
 * @return void
 * 
 */
function showProfessors()
{
    global $professorsType;
    $data = getProfessorsData();
    printCommonData($data, $professorsType);
}


/**
 * @author Hassan
 * @param int $id
 * @return array professor's data
 */
function getProfessor($id)
{
    global $professorsTable;

    $mainSqlQuery = "SELECT p.*, u.* 
    FROM {$professorsTable} p 
    join users u 
        on p.id_user = u.id
    WHERE u.id = $id";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $professorsData =  $result->fetch_assoc();
    return $professorsData;
}

/**
 * @author Hassan
 * @param array $data
 */
function getDataFromProfessor($data)
{
    global $description, $instructor_id;
    $description = $data['description'];
    $instructor_id = $data['id_instructor'];


}


/**
 * @author Hassan
 * @return array all professors data
 */
function getProfessorsData()
{
    global $professorsTable;

    list($per_page, $page_1, $_, $_) = getRowsPerPage($professorsTable);

    $mainSqlQuery = "SELECT p.*, u.* 
                        FROM {$professorsTable} p 
                        join users u 
                            on p.id_user = u.id
                        limit {$page_1}, {$per_page}";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $professorsData = array();
    $count = 0;

    while ($row = $result->fetch_assoc()) {
        $professorsData[$count++] = $row;
    }

    return $professorsData;
}

/**
 * @author Hassan
 * @return void
 * 
 */
function addProfessor()
{
    global $professorsType, $adminsType, $professorsTable, $adminsTable;

    list($instructor_id, $description, $is_admin) = NewProfessorDataForm();

    $dataBaseConnection = connectToDataBase();

    $type = $is_admin == '1' ? $adminsType : $professorsType;

    mysqli_autocommit($dataBaseConnection, FALSE);
    addUser($type, $dataBaseConnection);

    $last_id = mysqli_insert_id($dataBaseConnection);

    $secondSqlQuery = "INSERT INTO instructors VALUES ($last_id, $instructor_id);";
    $result =  mysqli_query($dataBaseConnection, $secondSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    $thirdSqlQuery = "INSERT INTO {$professorsTable} VALUES ($last_id, $instructor_id, '$description');";
    $result =  mysqli_query($dataBaseConnection, $thirdSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    if ($type == $adminsType) {
        $fourthSqlQuery = "INSERT INTO {$adminsTable} VALUES ($last_id, $instructor_id);";
        $result =  mysqli_query($dataBaseConnection, $fourthSqlQuery);
        checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    }

    mysqli_commit($dataBaseConnection);
    $dataBaseConnection->close();
}

/**
 * @author Hassan
 * @param $id
 * @return void
 * 
 */
function updateProfessorData($id)
{
    list($first_name, $middle_name, $last_name, $national_id, $email, $_, $gender, $mobile_number, $home_number) = NewUserDataForm();
    list($instructor_id, $description) = NewProfessorDataForm();

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
    $thirdSqlQuery = "UPDATE professors
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
 * @author Hassan
 * @param int $id
 */
function professorProfile($id)
{
    $data = getProfessor($id);
    getDataForProfile($data);
}


/**
 * @author Hassan
 * @param int $id
 */
function editProfessorProfile($id)
{
    editProfileCommon($id);
}
