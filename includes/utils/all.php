<?php


// getting connection
include_once dirname(__FILE__, 2)."\\db_conn.php";

// global variables
include_once dirname(__FILE__, 1)."\\variables.php";

// helper functions
include_once dirname(__FILE__, 1)."\\helper.php";


// form data retriever functions
include_once dirname(__FILE__, 1)."\\form_functions.php";




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
        $email, $mobile_number, $home_number, $national_id, $gender, $image_path;

    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];

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



function changeImage($id) {
    if (isset($_POST['submit'])) {

        $image = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $image_dir = "profile_images/$image";
        move_uploaded_file($imageTmp, $image_dir);

        $dataBaseConnection = connectToDataBase();
        mysqli_real_escape_string($dataBaseConnection, $image_dir);

        $imageSqlQuery = "UPDATE users SET image_path = '{$image_dir}' WHERE id = {$id};";

        $queryResult  = mysqli_query($dataBaseConnection, $imageSqlQuery);
        checkResultQuery($queryResult, $dataBaseConnection, __FUNCTION__);
        $dataBaseConnection->close();
    }
}