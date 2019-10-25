<?php
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: index.php');
    exit;
}

require_once 'Includes/db.php';
$curatorID = CuratorDB::getInstance()->get_curator_id_by_name($_SESSION['user']);

$dotDescriptionIsEmpty = false;
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(array_key_exists("back", $_POST)){
        header('Location: editDotList.php');
        exit;
    } else {
        if ($_POST['dots_Name'] == ""){
            $dotDescriptionIsEmpty = true;
        } else {
            CuratorDB::getInstance()->insert_dot($_POST['dots_name'], 
                    $_POST['dots_description'], $curatorID);
            header('Location: editDotList.php');
            exit;
        }
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE HTML>

<html>
    <head>

       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <form name="editDot" action="editDot.php" method="POST">
            Dot Name: <input type="text" name="dots_Name"  value="" /><br/>
            Describe your dot: <input type="text" name="dots_Description" value=""/><br/>
            <?php
                if ($dotDescriptionIsEmpty) echo 'Please enter Dot name<br>';
            ?>
            <input type="submit" name="saveDot" value="Save Changes"/>
            <input type="submit" name="back" value="Back to the List"/>
        </form>
    </body>
</html>
