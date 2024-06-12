<?php 

namespace webDirectory\api\core\services\departement;

class DepartementServiceNotFoundException extends \Exception {
    
    public function __construct($message) {
        parent::__construct($message);
    }
}