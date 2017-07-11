<?php
require_once('init.php');

$_SESSION['companyId'];

$query = 'SELECT * FROM company_meeting';
$statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$pdo->query("SET CHARACTER SET utf8");
$result = $statement->execute();

//echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC));
echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
?>