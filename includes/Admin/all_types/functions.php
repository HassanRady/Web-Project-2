<?php


include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";

function deleteUser()
{
    if (isset($_POST['delete'])) {
        $dataBaseConnection = connectToDataBase();

        $id_user = $_POST['delete_id'];
        $pageName = basename($_SERVER['PHP_SELF']);

        $mainSqlQuery = "DELETE FROM users WHERE id = {$id_user};";
        $result = mysqli_query($dataBaseConnection, $mainSqlQuery);

        checkResultQuery($result, $dataBaseConnection, __FUNCTION__);
        $dataBaseConnection->close();

        header("Location:./{$pageName}");
    }
}