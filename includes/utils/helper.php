<?php
include_once "variables.php";
//include_once dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . "includes\\db_conn.php";
// include_once 'includes\functions.php';

/**
 * @author Hassan
 */
function aElement($class, $name, $value, $href, $text)
{
    $a = " <a class='$class' name='$name' value='$value' href='$href'>$text</a>";
    echo $a;
}

/**
 * @author Hassan
 * @param string $password
 * @return string
 */
function encrypt_password($password, $cost = 10)
{
    $options = ['cost' => $cost,];
    $password_encrypted = password_hash($password, PASSWORD_BCRYPT, $options);
    return $password_encrypted;
}

/**
 * @author Hassan
 * @return boolean
 * */
function which_type($haystack, $needle, $offset = 0)
{
    if (!is_array($needle)) $needle = array($needle);
    foreach ($needle as $query) {
        if (strpos($haystack, $query, $offset) !== false)
            return $query;   // stop on first true result
    }
    return false;
}


/**
 * @author Hassan
 * @param mysqli $result
 * @return boolean
 */
function checkResultQuery($result, $conn, $source=null)
{

    global $developer;
    if (!$result) {
        if ($developer) {
        die("RESULT FAILED from {$source}\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));}
        else{
            die(mysqli_error($conn));
            // return;
        }
    }
    return true;
}

/** OMAR
 * get the last semester_id in the database;
 */

function getCurrentSemester()
{

        $conn = mysqli_connect( "localhost", "root", "","sim") or die("FAILED TO RECONNECT");


    $query = "SELECT semester_id FROM semesters ORDER BY semester_id DESC LIMIT 1";
    $query_result = mysqli_query($conn, $query);
    if ($query_result) {
        $result = mysqli_fetch_assoc($query_result);
        return $result['semester_id'];
    } else {
        return -1;
    }
}
