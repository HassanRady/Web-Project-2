<?php

include_once "iniclude_utils_files.php";

/**
 * @param string $type
 * @param mysqli $dataBaseConnection
 */
function addUser($type, $dataBaseConnection)
{
    list($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number) = NewUserDataForm();

    // handling realescape
    $dataBaseConnection = $dataBaseConnection;
    $email = mysqli_real_escape_string($dataBaseConnection, $email);

    $password = encrypt_password($password);

    $firstSqlQuery = "INSERT INTO users 
                        VALUES (default, '$first_name', '$middle_name', '$last_name', $national_id, '$type', '$email', '$password', '$gender', '$mobile_number', '$home_number', default);";

    $result =  mysqli_query($dataBaseConnection, $firstSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
}



/**
 * @param int $id
 * @return array
 */
function getUser($id)
{
    global $usersTable;
    $mainSqlQuery = "SELECT * 
                    FROM {$usersTable} 
                    WHERE id = $id";

    $dataBaseConnection = connectToDataBase();
    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $userData =  $result->fetch_assoc();
    return $userData;
}


/**
 * @return string
 */
function getTypeForData()
{
    global $userTypes;
    $pageName = basename($_SERVER['PHP_SELF']);

    if (isset($_GET["type"])) {
        $type = $_GET["type"];
    } else {
        // check the file name which it has any type of users
        $pageUrl = strtolower($pageName);
        $type = which_type($pageUrl, $userTypes);
    }

    return $type;
}


/**
 * @param array $data
 */
function getCommenDataFromUser($data)
{
    global $first_name, $middle_name, $last_name,
        $email, $mobile_number, $home_number, $national_id, $gender, $image_path, $password;

    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];

    $password = $data['password'];

    $national_id = $data['national_id'];
    $gender = $data['gender'];

    $image_path = $data['image_path'];
}



/**
 * @param array $data
 */
function getDataForProfile($data)
{
    getCommenDataFromUser($data);
    global  $first_name, $middle_name, $last_name, $full_name;
    $full_name = $first_name . " " . $middle_name . " " . $last_name;
}

/**
 * @param int $id
 * @param mysql $connection
 */
function editProfileCommon($id, $connection = NULL)
{
    list($first_name, $middle_name, $last_name, $password, $mobile_number, $home_number) = editProfileForm();

    if (empty($password)) {
        $userData = getUser($id);
        $password = $userData['password'];
    } else
        $password = encrypt_password($password);

    if ($connection != NULL)
        $dataBaseConnection = $connection;
    else
        $dataBaseConnection = connectToDataBase();

    $mainSqlQuery = "UPDATE users
         SET first_name='{$first_name}', password='{$password}', middle_name='{$middle_name}',
             last_name='{$last_name}',  mobile_number='{$mobile_number}', home_number='{$home_number}'
         WHERE id = {$id};";

    $result = mysqli_query($dataBaseConnection, $mainSqlQuery);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

    if ($connection == NULL)
        $dataBaseConnection->close();
}


/**
 * This function is getting the number of records to show in the list
 * @param string $table the table from the database that need to be shown
 * @return int  
 */
function getRowsPerPage($table)
{
    global $rowsPerPage;

    $per_page = $rowsPerPage;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "";
    }

    if ($page == "" || $page == 1) {
        $page_1 = 0;
    } else {
        $page_1 = ($page * $per_page) - $per_page;
    }

    $dataBaseConnection = connectToDataBase();
    $post_query_count = "SELECT * FROM {$table}";
    $result = mysqli_query($dataBaseConnection, $post_query_count);
    checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $count = mysqli_num_rows($result);
    $count  = ceil($count / $per_page);

    return array($per_page, $page_1, $count, $page);
}


/**
 * @param int $id
 */
function changeImage($id)
{
    global $profileImageDir;
    if (isset($_POST['submit'])) {

        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $image_dir = "$profileImageDir/$image";
        move_uploaded_file($imageTmp, $image_dir);

        $dataBaseConnection = connectToDataBase();
        mysqli_real_escape_string($dataBaseConnection, $image_dir);

        $imageSqlQuery = "UPDATE users SET image_path = '{$image_dir}' WHERE id = {$id};";

        $queryResult  = mysqli_query($dataBaseConnection, $imageSqlQuery);
        checkResultQuery($queryResult, $dataBaseConnection, __FUNCTION__);
        $dataBaseConnection->close();
    }
}
