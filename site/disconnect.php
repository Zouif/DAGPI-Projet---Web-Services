<?php
require_once('init.php');

unset($_SESSION['logged']);
unset($_SESSION['companyId']);
unset($_SESSION['spreadsheetIds']);
session_destroy();
header('Location: index.php');