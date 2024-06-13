<?php 

namespace webDirectory\admin\core\services\departement;

class DepartementServiceBadDataException extends \Exception {
    
    public function __construct($message) {
        parent::__construct($message);
    }
}