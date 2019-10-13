<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
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

    $con = mysqli_connect($dbHost, $dbUsername, $dbPassword);
    if (!$con) {
        exit('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }
//set the default client character set 
    mysqli_set_charset($con, 'utf-8');
    
    /**set the default client character set */ 
    mysqli_set_charset($con, 'utf-8');
   /** Check whether a user whose name matches the "user" field already exists */

    mysqli_select_db($con, "curatedots");
    $user = mysqli_real_escape_string($con, $_POST["fName"]);
    $curator = mysqli_query($con, "SELECT curator_id FROM curator WHERE first_name='".$user."';");
    $curatorIDnum = mysqli_num_rows($curator);
    if ($curatorIDnum) {
        $userNameIsUnique = false;
    }
    
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

/** Check whether the boolean values show that the input data was validated successfully.
     * If the data was validated successfully, add it as a new entry in the "wishers" database.
     * After adding the new entry, close the connection and redirect the application to editWishList.php.
     */
    if (!$userIsEmpty && $userNameIsUnique && !$passwordIsEmpty && !$password2IsEmpty && $passwordIsValid) {
        $password = mysqli_real_escape_string($con, $_POST['password']);
        mysqli_select_db($con, "curatedots");
        mysqli_query($con, "INSERT curator (first_name, password) VALUES ('" . $user . "', '" . $password . "')");
        mysqli_free_result($curator);
        mysqli_close($con);
        header('Location: editDotList.php');
        exit;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add New User Account</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
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
</html>
