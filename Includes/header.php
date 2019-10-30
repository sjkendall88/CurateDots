<header>
    <!-- anchor image as a hyper-link to home-page. -->
<a href="index.php"><img src="Images/home.jpg" alt="homeButton"></a>
<img src="Images/notification.jpg" alt="notification"/>
<!-- Home page linked through logo -->
<a href="index.php"><img src="Images/CD-Logo.jpg" alt="Curated Dots Logo" id="logo"></a>
    <h1 id="siteTitle">Curated Dots</h1>
    <form name="Login" action="index.php" method="post">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (!$logonSuccess){
                    echo "Invalid name and/or password<br>";
                }
            }
        ?>
        <label>
            Username:
            <input type="text" name="username" placeholder="username">
        </label><br>
        <label>
            Password:
            <input type="password" name="password">
        </label><br>
        <input type="submit" value="Login">
        <input type="submit" formaction="createNewAccount.php" value="Create Curator">
        <a href="" name="forgot password">Forgot Password</a>
    </form>
    <form name="showDots" method="GET" action="login.php">
        Show Dots: <input type="text" name="user" placeholder="username" /><br>
        <input type="submit" value="Show" />
        
    </form>
</header>