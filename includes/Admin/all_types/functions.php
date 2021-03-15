<?php


include_once dirname(__FILE__, 2) . "\\utils\\iniclude_utils_files.php";

/**
 * @author Hassan
 * @return void
 * 
 */
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

/**
 * @author Hassan
 * @return array
 * 
 */
function getProfessorAdmin() {

    global $adminsTable, $professorsTable;

    $mainSqlQuery = "SELECT p.id_user FROM {$adminsTable} a 
                        JOIN {$professorsTable} p ON a.id_instructor = p.id_instructor;";

$dataBaseConnection = connectToDataBase();
$result = mysqli_query($dataBaseConnection, $mainSqlQuery);
checkResultQuery($result, $dataBaseConnection, __FUNCTION__);

$professor_admins = mysqli_fetch_all($result);
$dataBaseConnection->close();

return $professor_admins;
}


function isHeProfessorAndAdmin($user_id) {
$professor_and_admins_id = getProfessorAdmin();

foreach($professor_and_admins_id as $id){
    if ($id[0] == $user_id)
    return true;
}
return false;
}