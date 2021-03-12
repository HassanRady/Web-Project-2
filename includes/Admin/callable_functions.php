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



function searchStudent()
{

    if (isset($_POST['submit'])) {
        $d = searchForStudent();
        showStudentSearch($d);
    } else {
        showStudentsList();
    }
}
function studentSearchEngine()
{
    searchForStudent();
}




function searchProfessor()
{

    if (isset($_POST['submit'])) {
        $d = searchForProfessor();
        showProfessorSearch($d);
    } else {
        showProfessorsList();
    }
}
function professorSearchEngine()
{
    searchForProfessor();
}



function searchTa()
{

    if (isset($_POST['submit'])) {
        $d = searchForTa();
        showTaSearch($d);
    } else {
        showTasList();
    }
}
function taSearchEngine()
{
    searchForTa();
}



function searchSa()
{

    if (isset($_POST['submit'])) {
        $d = searchForSa();
        showSaSearch($d);
    } else {
        showSasList();
    }
}
function saSearchEngine()
{
    searchForSa();
}



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

function showProfessorsList()
{
    showProfessors();
}

function showStudentsList()
{
    showStudents();
}

function showTasList()
{
    showTas();
}

function showSasList()
{
    showSas();
}



function addNewStudent()
{
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addStudent();
        header("Location:./{$pageName}?add=success");
    }
}


function addNewProfessor()
{
    global $professorsType;
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addProfessor();
        header("Location:./{$pageName}?add=success");
    }
}

function addNewTa()
{
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addTa();
        header("Location:./{$pageName}?add=success");
    }
}

function addNewSa()
{
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addSa();
        header("Location:./{$pageName}?add=success");
    }
}



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


function updateStudentProfile($id)
{
    studentProfile($id);
    if (isset($_POST['submit'])) {
        editStudentProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}


function updateProfessorProfile($id)
{
    professorProfile($id);
    if (isset($_POST['submit'])) {
        editProfessorProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

function updateTaProfile($id)
{
    taProfile($id);
    if (isset($_POST['submit'])) {
        editTaProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

function updateSaProfile($id)
{
    saProfile($id);
    if (isset($_POST['submit'])) {
        editSaProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

function updateAdminProfile($id)
{
    adminProfile($id);
    if (isset($_POST['submit'])) {
        editAdminProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

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
