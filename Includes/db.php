<?php

class WishDB extends mysqli {

    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "phpuser";
    private $pass = "phpuserpw";
    private $dbName = "wishlist";
    private $dbHost = "localhost";

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function get_wisher_id_by_name($name) {
        $name = $this->real_escape_string($name);
        $wisher = $this->query("SELECT id FROM wishers WHERE name = '"
                        . $name . "'");

        if ($wisher->num_rows > 0){
            $row = $wisher->fetch_row();
            return $row[0];
        } else
            return null;
    }

    public function get_wishes_by_wisher_id($wisherID) {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
    }

    public function create_wisher($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $this->query("INSERT INTO wishers (name, password) VALUES ('" . $name
                . "', '" . $password . "')");
    }

    public function verify_wisher_credentials($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $result = $this->query("SELECT 1 FROM wishers WHERE name = '"
                        . $name . "' AND password = '" . $password . "'");
        return $result->data_seek(0);
    }

    function insert_wish($wisherID, $description, $duedate) {
        $description = $this->real_escape_string($description);
        if ($this->format_date_for_sql($duedate)==null){
           $this->query("INSERT INTO wishes (wisher_id, description)" .
                " VALUES (" . $wisherID . ", '" . $description . "')");
        } else
        $this->query("INSERT INTO wishes (wisher_id, description, due_date)" .
                " VALUES (" . $wisherID . ", '" . $description . "', "
                . $this->format_date_for_sql($duedate) . ")");
    }

    function format_date_for_sql($date) {
        if ($date == "")
            return null;
        else {
            $dateParts = date_parse($date);
            return $dateParts['year'] * 10000 + $dateParts['month'] * 100 + $dateParts['day'];
        }
    }

    public function update_wish($wishID, $description, $duedate) {
        $description = $this->real_escape_string($description);
        $this->query("UPDATE wishes SET description = '" . $description .
                "', due_date = " . $this->format_date_for_sql($duedate)
                . " WHERE id =" . $wishID);
    }

    public function get_wish_by_wish_id($wishID) {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE id = " . $wishID);
    }

    public function delete_wish($wishID) {
        $this->query("DELETE FROM wishes WHERE id = " . $wishID);
    }
    
    public function delete_wishes($wishID) {
        $this->query("DELETE FROM wishes");
    }

    
    
    
    
   
}

class WishersDB extends mysqli {
    
    

    // single instance of self shared among all instances
    private static $instance = null;
    // db connection config vars
    private $user = "phpuser";
    private $pass = "phpuserpw";
    private $dbName = "wishlist";
    private $dbHost = "localhost";

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {
        trigger_error('Deserializing is not allowed.', E_USER_ERROR);
    }

    // private constructor
    private function __construct() {
        parent::__construct($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit('Connect Error (' . mysqli_connect_errno() . ') '
                    . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }

    public function get_wisher_id_by_name($name) {
        $name = $this->real_escape_string($name);
        $wisher = $this->query("SELECT id FROM wishers WHERE name = '"
                        . $name . "'");

        if ($wisher->num_rows > 0){
            $row = $wisher->fetch_row();
            return $row[0];
        } else
            return null;
    }

    public function get_wishes_by_wisher_id($wisherID) {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
    }

    public function create_wisher($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $this->query("INSERT INTO wishers (name, password) VALUES ('" . $name
                . "', '" . $password . "')");
    }

    public function verify_wisher_credentials($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $result = $this->query("SELECT 1 FROM wishers WHERE name = '"
                        . $name . "' AND password = '" . $password . "'");
        return $result->data_seek(0);
    }

    function insert_wish($wisherID, $description, $duedate) {
        $description = $this->real_escape_string($description);
        if ($this->format_date_for_sql($duedate)==null){
           $this->query("INSERT INTO wishes (wisher_id, description)" .
                " VALUES (" . $wisherID . ", '" . $description . "')");
        } else
        $this->query("INSERT INTO wishes (wisher_id, description, due_date)" .
                " VALUES (" . $wisherID . ", '" . $description . "', "
                . $this->format_date_for_sql($duedate) . ")");
    }

    function format_date_for_sql($date) {
        if ($date == "")
            return null;
        else {
            $dateParts = date_parse($date);
            return $dateParts['year'] * 10000 + $dateParts['month'] * 100 + $dateParts['day'];
        }
    }

    public function update_wish($wishID, $description, $duedate) {
        $description = $this->real_escape_string($description);
        $this->query("UPDATE wishes SET description = '" . $description .
                "', due_date = " . $this->format_date_for_sql($duedate)
                . " WHERE id =" . $wishID);
    }

    public function get_wish_by_wish_id($wishID) {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE id = " . $wishID);
    }

    public function delete_wish($wishID) {
        $this->query("DELETE FROM wishes WHERE id = " . $wishID);
    }
    
    public function delete_wishes($wishersID) {
        $this->query("DELETE FROM wishes WHERE id = " . $wishersID);
    }
    
    
     public function delete_wisher($wishersID) {
        $this->query("DELETE FROM wishers WHERE id - " . $wishersID);
    }

}
?>