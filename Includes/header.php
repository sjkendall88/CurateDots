<?php
echo    "<header>
            <img src=\"\" alt=\"Curated Dots Logo\">
            <h1>Curated Dots</h1>
            <form name=\"Login\" action=$cwd.\"/includes/index.php\" method=\"post\">
                <label>
                    Username
                    <input type=\"text\" name=\"username\" placeholder=\"username\">
                </label><br>
                <label>
                    Password
                    <input type=\"password\" name=\"password\">
                </label><br>" .
"                <?php " .
                    if($_SERVER["REQUEST_METHOD"] == "post"){
                        if (!$logonSuccess){
                            echo "Invalid name and/or password";
}
}
                + "?>" . "
                <input type=\"submit\" value=\"Login\">
                <a href=\"\" name=\"forgot password\">Forgot Password</a>
            </form>
        </header>";

