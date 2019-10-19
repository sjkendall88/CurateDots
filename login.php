<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- -->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Wish List of: 
            <?php 
                echo htmlentities($_GET["user"])."<br>"; 
            ?>
        <?php
        require_once("Includes/db.php");
            // Make connection to database
            $curatorID = CuratorDB::getInstance()->get_curator_id_by_name($_GET["user"]);
            if (!$curatorID) {
                exit("The person " . $_GET["user"] . " is not found. Please check the spelling and try again.");
            }
            
            
                    ?>
        
        <!-- Create output table for Dots -->
        <table border="black">
            <tr>
                <th>Dot</th>
                <th>Description</th>
            </tr>
            <?php
                require_once("Includes/db.php");
                $result = CuratorDB::getInstance()->get_dots_by_curator_id($curatorID);
                
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>" . htmlentities($row["dots_name"]) . "</td>";
                    echo "<td>" . htmlentities($row["dots_description"]) . "</td></tr>\n";
                }
                mysqli_free_result($result);
            ?>
        </table>

    </body>
</html>
