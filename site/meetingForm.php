<?php
require_once('init.php');

$currentPage = 'meetingForm';
$result = false;
if(isset($_POST['title']) && isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['location'])) {
    $query = 'INSERT INTO company_meeting (id_company, title, date_start, date_end) VALUES (:id_company, :title, :date_start, :date_end)';
    $statement = $pdo->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $result = $statement->execute(array(':id_company' => $_SESSION['companyId'], ':title' => $_POST['title'], ':date_start' => $_POST['date_start'], ':date_end' => $_POST['date_end']));

//    $requestBody      = new Google_Service_Sheets_BatchUpdateValuesRequest();
//    $valueInputOption = 'USER_ENTERED';
//    $requestBody->setValueInputOption('USER_ENTERED');
//    $requestBody->setData(array(
//        'range' => 'A1:D1',
//        'values' => array($_POST['title'], $_POST['date_start'], $_POST['date_end'], $_POST['location'])
//    ));
//    $sheetsClient->spreadsheets_values->batchUpdate($sheetId, $requestBody);
}

?>

<html>
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <link rel="stylesheet" href="css/external/jquery.datetimepicker.css"/>
    <script src="js/external/jquery.js"></script>
    <script src="js/external/jquery.datetimepicker.min.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<h1>Ajout d'un meeting</h1>
<main>
    <?php include('includes/menu.php'); ?>
    <section>
        <button id="authorize-button" style="display: none;">Authorize</button>
        <button id="signout-button" style="display: none;">Sign Out</button>

        <?php
        if ($result) {
            echo '<h1>Meeting ajouté</h1>';
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
            }

            // If not logged, display connect form
        } else {
            ?>

            <?php
        }
        ?>
    </section>
</main>
</body>
</html>
