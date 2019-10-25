<header>
    <img src="" alt="Curated Dots Logo">
    <h1>Curated Dots</h1>
    <form name="Login" action="index.php" method="post">
        <label>
            Username
            <input type="text" name="username" placeholder="username">
        </label><br>root
        <label>
            Password
            <input type="password" name="password">
        </label><br>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (!$logonSuccess){
                    echo "Invalid name and/or password";
                }
            }
        ?>
        <br>
        <input type="submit" value="Login">
        <a href="" name="forgot password">Forgot Password</a>
    </form>
</header>

