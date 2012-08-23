<?php

class Robot {

    public $name = "Optimus";
    public $color = "Red";

    // method declaration
    public function displayVar() {
        print $this->$name;
    }

}

?>
