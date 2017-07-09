<nav>
    <button id="authorize-button" style="display: none;">Connexion à Google</button>
    <button id="signout-button" style="display: none;">Déconnexion de Google</button>
<?php
if ($currentPage != 'index')
	echo '<a href="index.php">Index</a>';
if ($currentPage != 'inscription' && !isLogged())
    echo '<a href="inscription.php">Inscription</a>';
if ($currentPage != 'meetingForm' && isLogged())
    echo '<a href="meetingForm.php">Ajouter un meeting</a>';
?>
</nav>