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
        Wish List of: <?php echo htmlentities($_GET["user"])."<br>";?>
        <?php
            // Make connection to database
            $con = mysqli_connect("localhost", "phpuser", "phpuserpw");
            if (!$con) {
                exit('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
            }
            
            // Set the default client character set
            mysqli_set_charset($con, 'uft-8');
            $dbname = "curatedots";
            
            // Retrieve User ID
            mysqli_select_db($con, $dbname);
            $user = mysqli_real_escape_string($con, htmlentities($_GET["user"]));
            $curator = mysqli_query($con, "SELECT curator_id FROM curator WHERE first_name=\"" . $user . "\";");
            
            if (mysqli_num_rows($curator) < 1) {
                exit("The person ".htmlentities($_GET["user"])." is not found. Please check the spelling and try again.");                
            }
            
            $row = mysqli_fetch_row($curator);
            $curatorID = $row[0];
            mysqli_free_result($curator);            
        ?>
        
        <!-- Create output table for Dots -->
        <table border="black">
            <tr>
                <th>Dot</th>
                <th>Description</th>
            </tr>
            <?php
                $result = mysqli_query($con, "SELECT dots_name, dots_description FROM dots WHERE curator_id =\"" .$curatorID ."\";");
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td>" . htmlentities($row["dots_name"]) . "</td>";
                    echo "<td>" . htmlentities($row["dots_description"]) . "</td></tr>\n";
                }
                mysqli_free_result($result);
                mysqli_close($con);
            ?>
        </table>

    </body>
</html>
