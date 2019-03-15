<?php

namespace Core\Service;

use Product\Service\Edit as ProductEditService;
use Order\Service\Core as OrderService;

class ActionRoute
{
    public function route($action) {
        switch($action) {
            case 'clear_all_product_in_storage':
                $pes = new ProductEditService();
                $pes->clearAllProductCountInStoreage();
                break;
            case 'remove_order':
                (new OrderService())->removeOrder($_REQUEST['order_id']);
                break;
            case 'restore_order':
                (new OrderService())->restoreOrder($_REQUEST['order_id']);
                break;
        }
    }
}