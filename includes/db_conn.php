<?php
$db["db_host"] = "localhost:3307";
$db["db_path"] = "root";
$db["db_password"] = "";
$db["db_name"] = "sim";

// making constants
foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}
// making the connection
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = mysqli_connect(DB_HOST, DB_PATH, DB_PASSWORD, DB_NAME) or die("FAILED TO CONNECT");




/**
 * @author Hassan
 * @return mysqli
 */
function reconnectToDataBase()
{
    global $conn;
    $conn = mysqli_connect(DB_HOST, DB_PATH, DB_PASSWORD, DB_NAME) or die("FAILED TO RECONNECT");
    return $conn;
}
/**
 * @author Hassan
 * @return mysqli
 */
function connectToDataBase()
{
    $conn = mysqli_connect(DB_HOST, DB_PATH, DB_PASSWORD, DB_NAME) or die("FAILED TO RECONNECT");
    return $conn;
}
