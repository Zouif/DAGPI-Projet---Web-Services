<?php
define('HOST', 'localhost');
define('DBNAME', 'company_web_service');
define('USERNAME', 'root');
define('PASSWORD', '');

$pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USERNAME, PASSWORD);

session_start();
?>