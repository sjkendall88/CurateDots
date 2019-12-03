<header>
    
    <section id="logo">
        <!-- Home page linked through logo -->
<a href="index.php"><img src="Images/CDLogo.png" alt="Curated Dots Logo"></a><h1>Curated Dots</h1>
    </section>
    <section id="imNav">
        <a href="index.php"><img id="home" src="Images/transparentImage.png" alt="homeButton"></a>
    <a><img id="notification" src="Images/transparentImage.png" alt="notification"/></a>
    </section>
    <?php
    if (array_key_exists("user", $_SESSION)) {
    } else {
        include 'includes/curatorLogin.php';
        exit;
    }
?>
</header>