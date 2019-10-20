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
    public function _clone(){
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }
    public function _wakeup(){
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
        $name = $this->real_escape_string($name);
        
        $curator = $this->query("SELECT curator_id FROM curator WHERE first_name = '" . $name . "';");
        
        if ($curator->num_rows > 0) {
            $row = $curator->fetch_row();
            return $row[0];
        } else {
            return null;
        }
    }
    
    public function get_dots_by_curator_id($curaterID) {
        return $this->query("SELECT dots_name, dots_description FROM dots WHERE curator_id ='" .$curatorID . "';");
    }
    
    Public function create_curator($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $this->query("INSERT INTO curator (first_name, password) VALUES ('" . $name . "', '" . $password . "');");

        /*
        $query = "INSERT INTO curator (first_name, password) VALUES (:user_bv, :pwd_bv)";
        $stid = oci_parse($this->con, $query);
        oci_bind_by_name($stid, ':user_bv', $query);
        oci_bind_by_name($stid, ':pwd_bv', $query);
        oci_execute($stid);
        */
    }
    
    
}