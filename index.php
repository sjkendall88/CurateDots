<?php
require_once 'Includes/db.php';
$logonSuccess = false;

// Verify user's credentials
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $logonSuccess = (CuratorDB::getInstance()->verify_curator_credentials($_POST['username'], $_POST['password']));
    if ($logonSuccess == true) {
        session_start();
        if (array_key_exists("user", $_SESSION)) {   
    } else {
        $_SESSION['user'] = $_POST['username'];
        header('Location: editDotList.php');
        exit;
    }
    }
}
?>
<?php include 'Includes/top.php'; ?>
            <title>CurateDots</title>
        </head>

        <body>
            <?php include 'Includes/header.php'; ?>
        </body>
    </html>
