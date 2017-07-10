<?php
require_once('init.php');

$currentPage = 'inscription';
$result = false;

if( isset($_POST) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['spreadsheet_id']) ) {
	$querytest = 'SELECT * FROM company WHERE login = :login';
	$statementtest = $pdo->prepare($querytest, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$statementtest->execute(array(':login' => $_POST['login']));
	$resulttest = $statementtest->fetch();
	if ( empty($resulttest['login']) ){
		$query = 'INSERT INTO company (login,password,spreadsheet_id) VALUES (:login,:password,:spreadsheet_id)';
		$statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$result = $statement->execute(array(
						':login' => $_POST['login'],
						':password' => $_POST['password'],
						':spreadsheet_id' => $_POST['spreadsheet_id']
						));
	}
}

?>

<html>
<head>
    <?php include('includes/header.php'); ?>
</head>
<body>
<h1>Inscription</h1>
<main>
    <?php
    include('includes/menu.php');
    ?>
    <section>
        <?php
        if ($result) {
            echo '<br><h1>Inscription Faite</h1>';
        ?>
		<?php
        }
		echo '<br>';
		?>
		<form method="POST" onsubmit="encryptPassword();">
			<p>Identifiant : <input type="text" name="login"/></p>
			<p>Mot de passe : <input id="rawPassword" type="password"/></p>
			<input id="password" type="hidden" name="password"/>
			<p>Id du Spreadsheet : <input type="text" name="spreadsheet_id"/></p>
			<input type="submit" value="Envoyer">
		</form>
    </section>
</main>
</body>
</html>
