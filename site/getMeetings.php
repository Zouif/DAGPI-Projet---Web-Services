<?php
require_once('init.php');

$_SESSION['companyId'];

$query = 'SELECT * FROM company_meeting WHERE id_company = :id_company';
$statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$result = $statement->execute(array(':id_company' => $_SESSION['companyId']));

echo json_encode($statement->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
?>