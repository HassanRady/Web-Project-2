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
function check_result($result, $conn, $source=null)
{
    if (!$result) {
        die("RESULT FAILED from {$source}\n: " . mysqli_error($conn) . " " . mysqli_errno($conn));
        return;
    }
}

function displayError($result) {

}
