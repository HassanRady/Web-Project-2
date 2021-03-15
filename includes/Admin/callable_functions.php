<?php
include_once dirname(__FILE__, 2) . "\\utils\\variables.php";
include_once "all_types/functions.php";
include_once "students/functions.php";
include_once "students/search.php";
include_once "professors/functions.php";
include_once "professors/search.php";
include_once "tas/functions.php";
include_once "tas/search.php";
include_once "sas/functions.php";
include_once "sas/search.php";
include_once "utils" . DIRECTORY_SEPARATOR . "all.php";


/**
 * @author Hassan
 * @return void
 */
function searchStudent()
{
    global $isSearched;
    $isSearched = false;

    if (isset($_POST['submit'])) {
        $d = searchForStudent();
        $isSearched = true;
        showStudentSearch($d);
    } else {
        showStudentsList();
    }
}
/**
 * @author Hassan
 * @return void
 */
function studentSearchEngine()
{
    searchForStudent();
}



/**
 * @author Hassan
 * @return void
 */
function searchProfessor()
{

    if (isset($_POST['submit'])) {
        $d = searchForProfessor();
        showProfessorSearch($d);
    } else {
        showProfessorsList();
    }
}
/**
 * @author Hassan
 * @return void
 */
function professorSearchEngine()
{
    searchForProfessor();
}


/**
 * @author Hassan
 * @return void
 */
function searchTa()
{

    if (isset($_POST['submit'])) {
        $d = searchForTa();
        showTaSearch($d);
    } else {
        showTasList();
    }
}
/**
 * @author Hassan
 * @return void
 */
function taSearchEngine()
{
    searchForTa();
}


/**
 * @author Hassan
 * @return void
 */
function searchSa()
{

    if (isset($_POST['submit'])) {
        $d = searchForSa();
        showSaSearch($d);
    } else {
        showSasList();
    }
}
/**
 * @author Hassan
 * @return void
 */
function saSearchEngine()
{
    searchForSa();
}


/**
 * @author Hassan
 * @return void
 */
function updateStudent()
{
    $id = $_GET['id'];

    $data = getStudent($id);
    getCommenDataFromUser($data);
    getDataFromStudent($data);
    if (isset($_POST['submit'])) {
        updateStudentData($id);
        header("Location:./Students.php?update=success");
    }
}


/**
 * @author Hassan
 * @return void
 */
function updateProfessor()
{
    $id = $_GET['id'];


    $data = getProfessor($id);
    getCommenDataFromUser($data);
    getDataFromProfessor($data);
    if (isset($_POST['submit'])) {
        updateProfessorData($id);
        header("Location:./Professors.php?update=success");
    }
}

/**
 * @author Hassan
 * @return void
 */
function updateTa()
{
    $id = $_GET['id'];

    $data = getTa($id);
    getCommenDataFromUser($data);
    getDataFromTa($data);
    if (isset($_POST['submit'])) {
        updateTaData($id);
        header("Location:./ta_list.php?update=success");
    }
}

/**
 * @author Hassan
 * @return void
 */
function updateSa()
{
    $id = $_GET['id'];

    $data = getSa($id);
    getCommenDataFromUser($data);
    getDataFromSa($data);
    if (isset($_POST['submit'])) {
        updateSaData($id);
        header("Location:./sa_list.php?update=success");
    }
}
/**
 * @author Hassan
 * @return void
 */
function showProfessorsList()
{
    showProfessors();
}
/**
 * @author Hassan
 * @return void
 */
function showStudentsList()
{
    showStudents();
}
/**
 * @author Hassan
 * @return void
 */
function showTasList()
{
    showTas();
}
/**
 * @author Hassan
 * @return void
 */
function showSasList()
{
    showSas();
}


/**
 * @author Hassan
 * @return void
 */
function addNewStudent()
{
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addStudent();
        header("Location:./{$pageName}?add=success");
    }
}

/**
 * @author Hassan
 * @return void
 */
function addNewProfessor()
{
    global $professorsType;
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addProfessor();
        header("Location:./{$pageName}?add=success");
    }
}
/**
 * @author Hassan
 * @return void
 */
function addNewTa()
{
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addTa();
        header("Location:./{$pageName}?add=success");
    }
}
/**
 * @author Hassan
 * @return void
 */
function addNewSa()
{
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addSa();
        header("Location:./{$pageName}?add=success");
    }
}


/**
 * @author Hassan
 * @return void
 */
function userProfile()
{
    global $studentsType, $professorsType, $tasType, $sasType, $adminsType, $type;

    session_start();
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];

    changeImage($id);

    switch ($type) {
        case $studentsType:
            studentProfile($id);
            break;
        case $professorsType:
            professorProfile($id);
            break;
        case $tasType:
            taProfile($id);
            break;
        case $sasType:
            saProfile($id);
            break;
        case $adminsType:
            adminProfile($id);
            break;
    }
}

/**
 * @author Hassan
 * @param int $id
 * @return void
 */
function updateStudentProfile($id)
{
    studentProfile($id);
    if (isset($_POST['submit'])) {
        editStudentProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

/**
 * @author Hassan
 * @param int $id
 * @return void
 */
function updateProfessorProfile($id)
{
    professorProfile($id);
    if (isset($_POST['submit'])) {
        editProfessorProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}
/**
 * @author Hassan
 * @param int $id
 * @return void
 */
function updateTaProfile($id)
{
    taProfile($id);
    if (isset($_POST['submit'])) {
        editTaProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}
/**
 * @author Hassan
 * @param int $id
 * @return void
 */
function updateSaProfile($id)
{
    saProfile($id);
    if (isset($_POST['submit'])) {
        editSaProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}
/**
 * @author Hassan
 * @param int $id
 * @return void
 */
function updateAdminProfile($id)
{
    adminProfile($id);
    if (isset($_POST['submit'])) {
        editAdminProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}
/**
 * @author Hassan
 * @return void
 */
function updateProfile()
{
    global $studentsType, $professorsType, $tasType, $sasType, $adminsType, $type;

    session_start();
    $id = $_SESSION['id'];
    $type = $_SESSION['type'];

    switch ($type) {
        case $studentsType:
            updateStudentProfile($id);
            break;
        case $professorsType:
            updateProfessorProfile($id);
            break;
        case $tasType:
            updateTaProfile($id);
            break;
        case $sasType:
            updateSaProfile($id);
            break;
        case $adminsType:
            updateAdminProfile($id);
            break;
    }
}
