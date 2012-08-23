<?php

class Robot1 {

    public $colour;
    public $eyeColour;
    public $name;

    public function dance() {
        for ($i = 0; $i < 10; $i++) {
            print "robot $this->name is doing the robo-boogie, dressed in a lovely shade of $this->colour ....<br/>";
        }
    }

}
?>