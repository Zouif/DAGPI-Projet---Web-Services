<h1>Index</h1>
<?php
include('init.php');

if (!isset($_SESSION['logged'])) {
			// Login form sent
				if( isset($_POST['login']) && isset($_POST['passsword']) ) {
					$query = 'SELECT count(1) AS COUNT FROM company WHERE login = :login';
					$statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
					$statement->execute(array(':login' => $_POST['login']));

					if ($var = $statement->fetch()) {
						var_dump($var);
					}
				}
		?>
	<form method="POST">
		<p>Identifiant : <input type="text" name="login"/></p>
		<p>Mot de passe : <input type="password" name="password"/></p>
		<input type="submit" value="Envoyer">
	</form>
	<?php
}
?>
