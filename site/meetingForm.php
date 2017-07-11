<?php
require_once('init.php');

$currentPage = 'meetingForm';
$result = false;
if(isset($_POST['title']) && isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['location'])) {
    $query = 'INSERT INTO company_meeting (id_company, title, date_start, date_end, location) VALUES (:id_company, :title, :date_start, :date_end, :location)';
    $statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $result = $statement->execute(array(':id_company' => $_SESSION['companyId'], ':title' => $_POST['title'], ':date_start' => $_POST['date_start'], ':date_end' => $_POST['date_end'], ':location' => $_POST['location']));
}

?>

<html>
<head>
    <?php include('includes/header.php'); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAleRREHV1WqKDgXRUwH5R5K1C909VpYm8&callback=initMap" async defer></script>
</head>
<body>
<h1>Ajout d'un meeting</h1>
<main>
    <?php
    if ($result) {
        ?>
        <script src="js/meetingToSpreadsheet.js"></script>
        <?php
    }
    include('includes/menu.php');
    ?>
    <section>
        <button id="authorize-button" style="display: none;">Authorize</button>
        <button id="signout-button" style="display: none;">Sign Out</button>

        <?php
        if ($result) {
            echo '<h1>Meeting ajouté</h1>';
            ?>
            <input name="post_title" id="post_title" type="hidden" value="<?php echo $_POST['title']; ?>"/>
            <input name="post_date_start" id="post_date_start" type="hidden" value="<?php echo $_POST['date_start']; ?>"/>
            <input name="post_date_end" id="post_date_end" type="hidden" value="<?php echo $_POST['date_end']; ?>"/>
            <input name="post_location" id="post_location" type="hidden" value="<?php echo $_POST['location']; ?>"/>
            <input name="post_sheetId" id="post_sheetId" type="hidden" value="<?php echo $_SESSION['spreadsheetId'] ?>"/>
            <input name="post_location" id="post_meetingId" type="hidden" value="<?php echo $pdo->lastInsertId() ?>"/>
            <?php
        }
        // If logged, display disconnect button
        if (isset($_SESSION['logged'])) {
            if ($_SESSION['logged']) {
                ?>
                <form method="POST">
                    <p>Ordre du jour : <input name="title" type="text" required/></p>
                    <p>Date de début : <input name="date_start" type="datetime" required/></p>
                    <p>Date de fin : <input name="date_end" type="datetime" required/></p>
                    <p>Lieu : <input name="location" type="text" required/></p>
                    <input type="submit" value="Envoyer">
                </form>
                <?php
				include('includes/map.php');
            }

        }
            ?>
    </section>
</main>
</body>
</html>
