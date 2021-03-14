<?php


include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";

/**
 * @author Hassan
 * @return void
 */
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
    global $tasType;
    printCommonData($tasData, $tasType);
}
