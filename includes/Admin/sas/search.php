<?php


include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";

function searchForSa()
{
    global $sasTable, $rowsPerPage, $sa_name, $sa_email, $sa_phone, $countRows;

    if (isset($_POST['submit'])) {
        $sa_name = $_POST['sa-name'];
        $sa_email = $_POST['sa-email'];
        $sa_phone = $_POST['sa-phone'];

        $mainSqlQuery = "SELECT t.*, u.* 
                FROM {$sasTable} t 
                join users u 
                    on t.id_user = u.id
                    WHERE u.first_name LIKE '%$sa_name%' AND u.email LIKE '%$sa_email%' AND u.mobile_number LIKE '%$sa_phone%'
                    ORDER BY u.first_name;";

        $dasaBaseConnection = connectToDaTaBase();
        $resultQuery = mysqli_query($dasaBaseConnection, $mainSqlQuery);
        checkResultQuery($resultQuery, $dasaBaseConnection, __FUNCTION__);
        $dasaBaseConnection->close();

        $sasDasa = array();
        $countRows = 0;

        while ($row = $resultQuery->fetch_assoc()) {
            $sasDasa[$countRows++] = $row;
        }

        $countRows  = ceil($countRows / $rowsPerPage);


        return $sasDasa;
    }
}




function showSaSearch($sasDasa)
{
    $pageName = basename($_SERVER['PHP_SELF']);
    printSasDaTa($sasDasa, $pageName);
}
