<?php
define('HOST', 'localhost');
define('DBNAME', 'company_web_service');
define('USERNAME', 'root');
define('PASSWORD', '');

$pdo = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, USERNAME, PASSWORD);

session_start();

$company = null;

if (isLogged()) {
	$query = 'SELECT * FROM company WHERE id = :id';
	$statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$statement->execute(array(':id' => $_SESSION['companyId']));
	$company = $statement->fetch();
}

function isLogged() {
    return isset($_SESSION['logged']) && isset($_SESSION['companyId']);
}
?>