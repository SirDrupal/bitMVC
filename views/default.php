<?php

/**
 * Description of view
 *
 * @author lautarorosales
 */
class Default_view {
    
    public $_name;
    
    public function __construct($name) {
        $this->_name = $name;
    }
    
    public function load() {
        require_once './views/actions/' . $this->_name . '.php';
    }
}

?>
