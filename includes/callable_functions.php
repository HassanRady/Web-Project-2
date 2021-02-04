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