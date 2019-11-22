<?php
require_once 'Includes/db.php';
$logonSuccess = false;

// Verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $logonSuccess = (CuratorDB::getInstance()->verify_curator_credentials($_POST['username'], $_POST['password']));
    if ($logonSuccess == true) {
        session_start();
        $_SESSION['user'] = $_POST['username'];
        header('Location: editDotList.php');
        exit;
    }
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>CurateDots</title>
            <link rel="stylesheet" href="CSS/cssSmall.css"/>
            <link rel="stylesheet" href="CSS/cssMed.css"/>
            <link rel="stylesheet" href="CSS/css"/>
            <link href="CSS/normalization.css" rel="stylesheet">
        </head>

        <body>
            <?php
                $cwd = getcwd();
                include($cwd.'/includes/header.php');
            ?>
        </body>
    </html>
