<?php
$db["db_host"] = "localhost";
$db["db_path"] = "root";
$db["db_password"] = "";
$db["db_name"] = "sim";

// making constants
foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}
// making the connection
$conn = mysqli_connect(DB_HOST, DB_PATH, DB_PASSWORD, DB_NAME) or die("FAILED TO CONNECT");