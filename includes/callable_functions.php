<?php

include "functions.php";
include "students/functions.php";




function showWichData()
{
    global $studentsType, $professorsType, $tasType, $sasType, $adminsType;
    $pageName = basename($_SERVER['PHP_SELF']);
    $type = getTypeForData();

    switch ($type) {
        case $studentsType:
            showStudents($pageName);
            break;
        case $professorsType:
            showProfessors($pageName);
            break;
        case $tasType:
            showTas($pageName);
            break;
        case $sasType:
            showSas($pageName);
            break;
    }
}


function addNewStudent()
{
    global $studentsType;
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addStudent();
        header("Location:./{$pageName}?type={$studentsType}&add=success");
    }
}


function addNewProfessor()
{
    global $professorsType;
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addProfessor();
        header("Location:./{$pageName}?type={$professorsType}&add=success");
    }
}

function addNewTa()
{
    global $tasType;
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addTa();
        header("Location:./{$pageName}?type={$tasType}&add=success");
    }
}

function addNewSa()
{
    global $sasType;
    if (isset($_POST['submit'])) {
        $pageName = basename($_SERVER['PHP_SELF']);
        addSa();
        header("Location:./{$pageName}?type={$sasType}&add=success");
    }
}


function userProfile()
{
    global $studentsType, $professorsType, $tasType, $sasType, $type;

    // $id = $_SESSION['id'];
    // $type = $_SESSION['type'];

    $id = 1;
    $type = $studentsType;

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
    }
}


function updateStudentProfile($id)
{
    global $studentsType;
    studentProfile($id);
    if (isset($_POST['submit'])) {
        editStudentProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}


function updateProfessorProfile($id)
{
    global $professorsType;
    professorProfile($id);
    if (isset($_POST['submit'])) {
        editProfessorProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

function updateTaProfile($id)
{
    global $tasType;
    taProfile($id);
    if (isset($_POST['submit'])) {
        editTaProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

function updateSaProfile($id)
{
    global $sasType;
    saProfile($id);
    if (isset($_POST['submit'])) {
        editSaProfile($id);
        header("Location:./my_profile.php?update=success");
    }
}

function updateProfile()
{
    global $studentsType, $professorsType, $tasType, $sasType, $type;

    // $id = $_SESSION['id'];
    // $type = $_SESSION['type'];

    $id = 1;
    $type = $studentsType;

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
    }
}
