<?php
require_once('init.php');

$currentPage = 'index';

if(isset($_POST['action'])) {
	// Login form sent
	if ( $_POST['action'] === 'login' ) {
		if( isset($_POST['login']) && isset($_POST['password']) ) {
			$query = 'SELECT * FROM company WHERE login = :login AND password = :password';
			$statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement->execute(array(':login' => $_POST['login'], ':password' => $_POST['password']));
			if ($result = $statement->fetch()) {
				$_SESSION['logged'] = true;
				$_SESSION['companyId'] = $result['id'];
				$_SESSION['spreadsheetId'] = $result['spreadsheet_id'];
			}
		}

	// DIsconnect form sent
	} else if ( $_POST['action'] === 'disconnect' ) {
		unset($_SESSION['logged']);
		unset($_SESSION['companyId']);
		unset($_SESSION['spreadsheetIds']);
		session_destroy();
	}
}
?>

<html>
	<head>
        <?php include('includes/header.php'); ?>
	</head>
	<body>
		<h1>Index</h1>
		<main>
			<?php include('includes/menu.php'); ?>
			<section>
                <?php
				// If logged, display disconnect button
				if (isset($_SESSION['logged'])) {
					if ($_SESSION['logged']) {
					?>
						<form method="POST">
							<input type="hidden" name="action" value="disconnect"/>
							<input type="submit" value="Déconnexion">
						</form>
					<?php
					}

				// If not logged, display connect form
				} else {
					?>
					<form method="POST" onsubmit="encryptPassword();">
						<p>Identifiant : <input type="text" name="login"/></p>
						<p>Mot de passe : <input id="rawPassword" type="password"/></p>
						<input id="password" type="hidden" name="password"/>
						<input type="hidden" name="action" value="login"/>
						<input type="submit" value="Envoyer">
					</form>
					<?php
				}
				?>
			</section>
		</main>
	</body>
</html>
