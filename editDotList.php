<?php
    session_start();
    if (array_key_exists("user", $_SESSION)) {
        // echo "Hello " . $_SESSION['user'];
    } else {
        header('Location: index.php');
        exit;
    }
?>

<?php include 'includes/top.php'; ?>

        <title>Welcome</title>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <h3><?php echo $_SESSION['user']?>'s Dot Page</h3>
        <table border="black">
    <tr><th>Dot</th><th>Description</th></tr>
    <?php
    require_once("Includes/db.php");
    $curatorID = CuratorDB::getInstance()->get_curator_id_by_name($_SESSION["user"]);
    $result = CuratorDB::getInstance()->get_dots_by_curator_id($curatorID);

                while ($row = mysqli_fetch_array($result)) :
                    echo "<tr><td>" . htmlentities($row["dots_name"]) . "</td>";
                    echo "<td>" . htmlentities($row["dots_description"]) . "</td>";
                    $dotID = $row["dots_id"];               
    ?>
    <td>
        <form name="editDot" action="editDot.php" method="GET">
            <input type="hidden" name="dot_ID" value="<?php echo $dotID; ?>">
            <input type="submit" name="editDot" value="Edit">
        </form>
    </td>
    <td>
        <form name="deleteDot" action="deleteDot.php" method="POST">
            <input type="hidden" name="dot_ID" value="<?php echo $dotID; ?>">
            <input type="submit" name="deleteDot" value="Delete">
        </form>
    </td>
    <?php 
    echo "</tr>\n";
    endwhile;
    mysqli_free_result($result);
    ?>
</table>
        <form action="editDot.php" name="addNewDot">
            <br><input type="submit" value="Add Dot">
        </form>
    </body>
    <FOOTER>
            <?php
                $cwd = getcwd();
                include($cwd.'/includes/toMain.php');
            ?>
        </FOOTER>
</html>
