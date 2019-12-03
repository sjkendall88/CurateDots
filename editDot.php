<?php
session_start();
if (!array_key_exists("user", $_SESSION)) {
    header('Location: index.php');
    exit;
}

require_once 'Includes/db.php';
$curatorID = CuratorDB::getInstance()->get_curator_id_by_name($_SESSION['user']);

$dotNameIsEmpty = false;
if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(array_key_exists("back", $_POST)){
        header('Location: editDotList.php');
        exit;
    } else if ($_POST['dot_name'] == ""){
        $dotNameIsEmpty = true;
    } else if($_POST['dot_id'] == "") {
        CuratorDB::getInstance()->insert_dot($curatorID, $_POST['dot_name'], 
                $_POST['dot_description']);
        header('Location: editDotList.php');
        exit;
    } elseif ($_POST['dot_id'] != "") {
        CuratorDB::getInstance()->update_dot($_POST['dot_id'], $_POST['dot_name'], 
                $_POST['dot_description']);
        header('Location: editDotList.php');
        exit;
    }
    }
?>

<?php include 'Includes/top.php'; ?>
<title>Add New Dot</title>
    </head>
    <body>
        <?php 
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $dot = array("dots_id" => $_POST["dot_id"],
                "dots_name" => $_POST["dot_name"],
                "dots_description" => $_POST["dot_description"]);            
        } else if (array_key_exists("dot_ID", $_GET)) {
            $dot = mysqli_fetch_array(CuratorDB::getInstance()->get_dots_by_dots_id($_GET["dot_ID"]));
        } else {
            $dot = array("dots_id" => "",
                "dots_name" => "",
                "dots_description" => ""); 
        }
        ?>
        <?php include 'Includes/header.php'; ?>
        <h3>Welcome <?php echo $_SESSION['user']?> add new Dot Details</h3>
        <form name="editDot" action="editDot.php" method="POST">
            <input type="hidden" name="dot_id" value="<?php echo $dot["dots_id"];?>" />
            Dot Name: <input type="text" name="dot_name"  value="<?php echo $dot["dots_name"];?>" /><br/>
            Describe your dot: <input type="text" name="dot_description" value="<?php echo $dot["dots_description"];?>"/><br/>
            <?php
            if ($dotNameIsEmpty) {
                echo 'Please enter Dot name<br>';
            }
            ?>
            <input type="submit" name="saveDot" value="Save Changes"/>
            <input type="submit" name="back" value="Back to the List"/>
        </form>
    </body>
    <FOOTER>
            <?php include 'Includes/toMain.php';?>
        </FOOTER>
</html>
