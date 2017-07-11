<?php
require_once('init.php');

$currentPage = 'index';

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
?>

<html>
	<head>
        <?php include('includes/header.php');
        if (isset($_SESSION['logged'])) {
        ?>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCE772SsPKfuXNhvj-OPuoS63idOw2yu00&callback=initMap" async defer></script>
        <?php
        }
        ?>
    </head>
	<body>
		<h1>Index</h1>
		<main>
			<?php include('includes/menu.php'); ?>
			<section>
                <?php
                // If not logged, display connect form
				if (! isset($_SESSION['logged'])) {
					?>
					<form method="POST" onsubmit="encryptPassword();">
						<p>Identifiant : <input type="text" name="login"/></p>
						<p>Mot de passe : <input id="rawPassword" type="password"/></p>
						<input id="password" type="hidden" name="password"/>
						<input type="submit" value="Envoyer">
					</form>
					<?php
				} else {
					include('includes/map.php');
                } ?>
			</section>
		</main>
	</body>
</html>
