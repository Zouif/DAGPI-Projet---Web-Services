<nav>
<?php
if (isLogged())
    echo '<a href="disconnect.php">Déconnexion</a><br>';
if ($currentPage != 'index')
	echo '<a href="index.php">Index</a><br>';
if ($currentPage != 'inscription' && !isLogged())
    echo '<a href="inscription.php">Inscription</a><br>';
if ($currentPage != 'meetingForm' && isLogged())
    echo '<a href="meetingForm.php">Ajouter un meeting</a><br>';
if (isLogged())
    echo '<a href="https://docs.google.com/spreadsheets/d/' . $_SESSION['spreadsheetId'] . '/edit#">Tableur</a><br>';
?>
    <a href="#" id="authorize-button" style="display: none;">Connexion à Google</a>
    <a href="#"  id="signout-button" style="display: none;">Déconnexion de Google</a>
</nav>