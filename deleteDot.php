<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("Includes/db.php");
CuratorDB::getInstance()->delete_dot($_POST["dot_ID"]);
header('Location: editDotList.php' );