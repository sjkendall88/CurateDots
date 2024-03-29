<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CuratorDB extends mysqli {
    
    // single instance of self shared amoung all instances
    private static $instance = null;
    
    // db connection config vars
    private $user = "phpuser";
    private $pass = "phpuserpw";
    private $dbName = "curatedots";
    private $dbhost = "localhost";
    
    // this method must be static, and must return an 
    // instance of the object if the object does not already exit.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    // The clone and wakeup methods prevents external 
    // instantiation of copies of the single thus 
    // eliminating the possibility of duplicate objects.
    public function __clone(){
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function __wakeup(){
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }
    
    // private constructor
    public function __construct(){
        parent::__construct($this->dbhost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ')' . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }
    

    // This should be after wish DB function...MIA
    public function get_curator_id_by_name($name) {
        /* @var $name type */
        $iName = $this->real_escape_string($name);
        
        $curator = $this->query("SELECT curator_id FROM curator WHERE first_name = '" . $iName . "';");
        
        if ($curator->num_rows > 0) {
            $row = $curator->fetch_row();
            return $row[0];
        } else {
            return null;
        }
    }
    
    public function get_dots_by_curator_id($curatorID) {
        return $this->query("SELECT dots_id, dots_name, dots_description FROM dots WHERE curator_id ='" .$curatorID . "';");
    }
    
    public function get_dots_by_dots_id($dotID){
        $query = "SELECT dots_id, dots_name, dots_description FROM dots WHERE dots_id = ". $dotID . ";";
        return $this->query($query);
    }
    
    Public function create_curator($fName, $lName, $password) {
        $ifName = $this->real_escape_string($fName);
        $ilName = $this->real_escape_string($lName);
        $iPassword = $this->real_escape_string($password);
        $this->query("INSERT INTO curator (first_name, last_name, password) VALUES ('" . $ifName . "', '" . $ilName . "', '" . $iPassword . "');");
    }
    
    public function verify_curator_credentials($name, $password){
        $cname = $this->real_escape_string($name);
        $cpassword = $this->real_escape_string($password);
        $query = "SELECT 1 FROM curator WHERE first_name ='".$cname."' and password ='".$cpassword."';";
        $result = $this->query($query);
        return $result->data_seek(0);
    }
    
    public function insert_dot($curatorID, $dot_name, $dot_description){
        $dotI_name = $this->real_escape_string($dot_name);
        $dotI_description = $this->real_escape_string($dot_description);
        $query = "INSERT INTO dots (dots_name, dots_description, curator_id) "
                . "VALUES ('".$dotI_name."','".$dotI_description."',".$curatorID.");";
        $this->query($query);
    }
    
    public function update_dot($dotID, $dot_name, $dot_description){
        // $descriptionI = $this->real_escape_string($dot_description);
        $query = "UPDATE dots SET dots_name = '". $dot_name . "', dots_description = '". $dot_description . "' WHERE dots_id ='" . $dotID . "';";
        $this->query($query);
    }
    
    public function delete_dot($dotID){
        $query = "DELETE FROM dots WHERE dots_id ='". $dotID . "';";
        $this->query($query);
    }
}