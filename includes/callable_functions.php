<?php

include "functions.php";



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
