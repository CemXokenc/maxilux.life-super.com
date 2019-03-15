<?php

namespace Product\Service;

use Core\Service\DB as DBService;

class Edit
{
    public function clearAllProductCountInStoreage() {
        $db = DBService::inst();
        $db->exec('UPDATE `products` SET `cnt` = \'0\'');
    }
}