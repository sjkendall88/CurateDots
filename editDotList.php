<?php
    session_start();
    if (array_key_exists("user", $_SESSION)) {
        echo "Hello " . $_SESSION['user'];
    } else {
        header('Location: index.php');
        exit;
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h3>Edit Dot Page</h3>
        <table border="black">
    <tr><th>Item</th><th>Due Date</th></tr>
    <?php
    require_once("Includes/db.php");
    $curatorID = CuratorDB::getInstance()->get_curator_id_by_name($_SESSION["user"]);
    $result = CuratorDB::getInstance()->get_dots_by_curator_id($curatorID);

                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>" . htmlentities($row["dots_name"]) . "</td>";
                    echo "<td>" . htmlentities($row["dots_description"]) . "</td></tr>\n";
                }               
    ?>
</table>
        <form action="editDot.php" name="addNewDot">
            <br><input type="submit" value="Add Dot">
        </form>
    </body>
</html>
