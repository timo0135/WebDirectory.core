<?php 

namespace webDirectory\admin\core\services\departement;

class DepartementServiceNotFoundException extends \Exception {
    
    public function __construct($message) {
        parent::__construct($message);
    }
}