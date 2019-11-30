<header>
    
    <section id="logo">
        <!-- Home page linked through logo -->
<a href="index.php"><img src="Images/CDLogo.png" alt="Curated Dots Logo"></a><h1>Curated Dots</h1>
    </section>
    <section id="imNav">
        <a href="index.php"><img id="home" src="Images/transparentImage.png" alt="homeButton"></a>
    <a><img id="notification" src="Images/transparentImage.png" alt="notification"/></a>
    </section>
    <section id="dotSearch">
        <form name="showDots" method="GET" action="login.php">
        Show Dots: <input type="text" name="user" placeholder="username" /><br>
        <input type="submit" value="Show" />
        
    </form>
    </section>    
    <section id="curLogin">
        <form name="Login" style="display:inline;" action="index.php" method="post">
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if (!$logonSuccess){
                    echo "Invalid name and/or password<br>";
                }
            }
        ?>
            Username:
            
            Password:
            <br>
                    <input type="text" name="username" placeholder="username">
            <input type="password" name="password">
            <br>
        <input type="submit" value="Login">
        <input type="submit" formaction="createNewAccount.php" value="Create Curator">
        <a href="" name="forgot password">Forgot Password</a>
    </form>
    </section>

</header>