<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require_once ("Includes/db.php");

/** database connection credentials */
$dbHost="localhost";
$dbUsername="phpuser";
$dbPassword="phpuserpw";

/** other variables */
$userNameIsUnique = true;
$passwordIsValid = true;				
$userIsEmpty = false;					
$passwordIsEmpty = false;				
$password2IsEmpty = false;

/** Check that the page was requested from itself via the POST method. */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /** Check that the page was requested from itself via the POST method. */
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /** Check whether the user has filled in the Curator's name in the text field "user" */    
        if ($_POST["fName"]=="") {
        $userIsEmpty = true;
        }
    }
    
    /** Create database connection */
    $curatorID = CuratorDB::getInstance()->get_curator_id_by_name($_POST["user"]);
    
    
    //Password Validation?
    if ($_POST["password"]=="") {
    $passwordIsEmpty = true;
    }
    if ($_POST["password2"]=="") {
    $password2IsEmpty = true;
    }
    if ($_POST["password"]!=$_POST["password2"]) {
    $passwordIsValid = false;
    }
    
    $curatorID = CuratorDB::getInstance()->get_curator_id_by_name($_POST["user"]);
    if ($curatorID) {
        $userNameIsUnique = false;
    }

    /** Check whether the boolean values show that the input data was validated successfully.
     * If the data was validated successfully, add it as a new entry in the "wishers" database.
     * After adding the new entry, close the connection and redirect the application to editWishList.php.
     */
    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        CuratorDB::getInstance()->create_curator($_POST["user"], $_POST["password"]);
        session_start();
        $_SESSION['user'] = $_POST['user'];
        header('Location: editDotList.php');
        exit;
    }
}
?>
<?php include 'includes/top.php'; ?>
        <title>Add New User Account</title>
    </head>
    <body>
        <?php include 'includes/header.php'; ?>
        <form action="createNewAccount.php" method="POST">
            First Name: <input type="text" name="fName"/><br>
             <?php
    if ($userIsEmpty) {
        echo ("Enter your name, please!");
        echo ("<br/>");
    }                
    if (!$userNameIsUnique) {
        echo ("The person already exists. Please check the spelling and try again");
        echo ("<br/>");
    }
    ?> 
            Last Name: <input type="text" name="lName"/><br>
            Password: <input type="password" name="password"/><br>
            <?php
 if ($passwordIsEmpty) {
     echo ("Enter the password, please!");
     echo ("<br/>");
 }                
 ?>
            Confirm Password: <input type="password" name="password2"/><br>
            <?php
 if ($password2IsEmpty) {
     echo ("Confirm your password, please");
     echo ("<br/>");    
 }                
 if (!$password2IsEmpty && !$passwordIsValid) {
     echo  ("The passwords do not match!");
     echo ("<br/>");  
 }                 
?>
            <input type="submit" value="Register"/>
        </form>
    </body>
    <FOOTER>
            <?php
                $cwd = getcwd();
                include($cwd.'/includes/toMain.php');
            ?>
        </FOOTER>
</html>
