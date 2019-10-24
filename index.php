<?php
require_once 'Includes/db.php';
$logonSuccess = false;

// Verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $logonSuccess = (CuratorDB::getInstance()->verify_curator_credentials($_POST['username'], $_POST['password']));
    if ($logonSuccess == TRUE) {
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: editDotList.php');
        exit;
    }
}
?>
<DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>CurateDots</title>
            <link href="CSS/normalization.css" rel="stylesheet">
        </head>

        <body>
        <h4>Test title before php</h4>
            <?php
                $cwd = getcwd();
                include($cwd.'/includes/header.php');
            ?>
            <h4>Test title after php</h4>
            
            <form name="login" method="GET" action="login.php">
                Show Dots: <input type="text" name="user" value="" />
                <input type="submit" value="Go" />
            </form>
            <br>Still Don't have a wish list?! <a href="createNewAccount.php">Create Now</a>
            
        </body>
    </html>
</DOCTYPE>
