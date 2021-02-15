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
        $email, $mobile_number, $home_number, $national_id, $gender;

    $first_name = $data['first_name'];
    $middle_name = $data['middle_name'];
    $last_name = $data['last_name'];
    $email = $data['email'];
    $mobile_number = $data['mobile_number'];
    $home_number = $data['home_number'];

    $national_id = $data['national_id'];
    $gender = $data['gender'];
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
    check_result($result, $dataBaseConnection, __FUNCTION__);
    $dataBaseConnection->close();

    $count = mysqli_num_rows($result);
    $count  = ceil($count / $per_page);

    return array($per_page, $page_1, $count, $page);
}
