<header>
    <?php if (!is_array($_SESSION)){
        session_start();
    } ?>
    <section id="logo">
        <!-- Home page linked through logo -->
<a href="index.php"><img src="Images/CDLogo.png" alt="Curated Dots Logo"></a><h1>Curated Dots</h1>
    </section>
    <section id="imNav">
        <a href="index.php"><img id="home" src="Images/transparentImage.png" alt="homeButton"></a>
        <a><img id="notification" src="Images/transparentImage.png" alt="notification"/></a>
        <a href="logOut.php"><img id="logOut" src="Images/transparentImage.png" alt="logOut"/></a>
        <?php if (!array_key_exists("user", $_SESSION)) {
        } else {
            echo '<a href="editDotList.php"><img id="userFrame" src="Images/transparentImage.png" alt="userFrame"/></a>';
        }
?>
        <a><img id="search" src="Images/transparentImage.png" alt="search"/></a>        
    </section>
    <?php
    if (!array_key_exists("user", $_SESSION)) {
        include 'Includes/dotSearch.php';
        include 'Includes/curatorLogin.php';
        exit;
    } else {
        include 'Includes/dotSearch.php';
    }
?>
</header>