<?php

// function to make a link button
function aElement($class, $name, $value, $href, $text)
{
    $a = " <a class='$class' name='$name' value='$value' href='$href'>$text</a>";
    echo $a;
}

// function to crypt a password
function encrypt_password($password, $cost = 10)
{
    $options = ['cost' => $cost,];
    $password_encrypted = password_hash($password, PASSWORD_BCRYPT, $options);
    return $password_encrypted;
}

// function to compare if a substring from an array of substrings exists in a string
function which_type($haystack, $needle, $offset = 0)
{
    if (!is_array($needle)) $needle = array($needle);
    foreach ($needle as $query) {
        if (strpos($haystack, $query, $offset) !== false)
            return $query;   // stop on first true result
    }
    return false;
}


// function to check if the sql query was successful
function checkResultQuery($result, $conn, $source=null)
{
    if (!$result) {
        die("RESULT FAILED from {$source}\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
        return;
    }
    return true;
}

/** OMAR
 * get the last semester_id in the database;
 */

function getCurrentSemester()
{
    global $conn;
    $query = "SELECT semester_id FROM semesters ORDER BY semester_id DESC LIMIT 1";
    $query_result = mysqli_query($conn, $query);
    if ($query_result) {
        $result = mysqli_fetch_assoc($query_result);
        return $result['semester_id'];
    } else {
        return -1;
    }
}


function displayError($result) {

}
?>