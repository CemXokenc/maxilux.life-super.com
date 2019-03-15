<?php

namespace Core\Service;

use Product\Service\Edit as ProductEditService;
use Order\Service\Core as OrderService;

class AjaxRoute
{
    /**
     * @param $data
     * @return string
     */
    public function route($data) {
        $result = '';
        switch ($data['action']) {
            case 'save_order_comment':
                $result = (new OrderService())->saveOrderCommentFromAjax($data);
                break;
        }
        return json_encode($result);
    }
}