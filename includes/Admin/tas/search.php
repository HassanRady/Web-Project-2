<?php

// getting connection
include_once dirname(__FILE__, 3) . "\\db_conn.php";

// global variables
include_once dirname(__FILE__, 3) . "\\utils\\variables.php";

// helper functions
include_once dirname(__FILE__, 3) . "\\utils\\helper.php";

// printing functions
include_once dirname(__FILE__, 3) . "\\utils\\print_functions.php";

// form data retriever functions
include_once dirname(__FILE__, 3) . "\\utils\\form_functions.php";

include_once dirname(__FILE__, 3) . "\\utils\\all.php";


function searchForTa()
{
    global $tasTable, $rowsPerPage, $ta_name, $ta_email, $ta_phone, $countRows;

    if (isset($_POST['submit'])) {
        $ta_name = $_POST['ta-name'];
        $ta_email = $_POST['ta-email'];
        $ta_phone = $_POST['ta-phone'];

        $mainSqlQuery = "SELECT t.*, u.* 
                FROM {$tasTable} t 
                join users u 
                    on t.id_user = u.id
                    WHERE u.first_name LIKE '%$ta_name%' AND u.email LIKE '%$ta_email%' AND u.mobile_number LIKE '%$ta_phone%'
                    ORDER BY u.first_name;";

        $dataBaseConnection = connectToDataBase();
        $resultQuery = mysqli_query($dataBaseConnection, $mainSqlQuery);
        checkResultQuery($resultQuery, $dataBaseConnection, __FUNCTION__);
        $dataBaseConnection->close();

        $tasData = array();
        $countRows = 0;

        while ($row = $resultQuery->fetch_assoc()) {
            $tasData[$countRows++] = $row;
        }

        $countRows  = ceil($countRows / $rowsPerPage);


        return $tasData;
    }
}




function showTaSearch($tasData)
{
    $pageName = basename($_SERVER['PHP_SELF']);
    printTasData($tasData, $pageName);
}
