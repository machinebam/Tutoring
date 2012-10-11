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

}

?>