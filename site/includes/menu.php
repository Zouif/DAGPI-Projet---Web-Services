<?php
echo '<nav>';
if ($currentPage != 'index')
	echo '<a href="index.php">Index</a>';
if ($currentPage != 'inscription' && !isLogged())
    echo '<a href="inscription.php">Inscription</a>';
if ($currentPage != 'meetingForm' && isLogged())
    echo '<a href="meetingForm.php">Ajouter un meeting</a>';
echo '</nav>';
?>