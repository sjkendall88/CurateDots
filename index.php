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
            
            <form name="login" action="login.php">
                Show Dots: <input type="text" name="user" value="" />
                <input type="submit" value="Go" />
            </form>
        </body>
    </html>
</DOCTYPE>
