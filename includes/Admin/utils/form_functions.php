<?php

/**
 * @author Hassan
 * @return array new user's data
 */
function NewUserDataForm()
{
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $national_id = $_POST['national_id'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $mobile_number = $_POST['mobile_number'];
    $home_number = $_POST['home_number'];
    $password =  $national_id;         // tmp until user changes it

    return array($first_name, $middle_name, $last_name, $national_id, $email, $password, $gender, $mobile_number, $home_number);
}

/**
 * @author Hassan
 * @return array new student's data
 */
function NewStudentDataForm()
{
    $arabic_name = $_POST['arabic_name'];
    $address = $_POST["address"];
    $student_type = $_POST['student_type'];
    $student_id = $_POST['student_id'];
    $guardian_mobile_number = $_POST['guardian_mobile_number'];

    return array($student_id, $arabic_name, $address, $guardian_mobile_number, $student_type);
}

/**
 * @author Hassan
 * @return array new professor's data
 */
function NewProfessorDataForm()
{
    $description = $_POST['description'];
    $instructor_id = $_POST['instructor_id'];
    $is_admin = $_POST['isAdmin'];

    return array($instructor_id, $description, $is_admin);
}



/**
 * @author Hassan
 * @return array new TA's data
 */
function NewTaDataForm()
{
    $department = $_POST['department'];
    $instructor_id = $_POST['instructor_id'];

    return array($instructor_id, $department);
}



/**
 * @author Hassan
 * @return array new SA's data
 */
function NewSaDataForm()
{
    $instructor_id = $_POST['instructor_id'];
    $department = $_POST['department'];

    return array($instructor_id, $department);
}


/**
 * @author Hassan
 * @return array
 */
function editProfileForm() {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $mobile_number = $_POST['mobile_number'];
    $home_number = $_POST['home_number'];
    $password =  $_POST['password'];

    return array($first_name, $middle_name, $last_name, $password, $mobile_number, $home_number);
}


/**
 * @author Hassan
 * @return array
 */
function studentEditProfileForm() {
    $address = $_POST["address"];
    $guardian_mobile_number = $_POST['guardian_mobile_number'];

    return array($address, $guardian_mobile_number);
}