<?php
$db['db_name'] = "drink_base";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_host'] = "localhost";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
} catch (mysqli_sql_exception $e) {
    header("Location: " . strtok($_SERVER['HTTP_REFERER'], '?')."?message=connection_error");
    exit;
}
?>