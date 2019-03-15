<?php

namespace Order\Service;

use Core\Model\Status;

use Core\Service\DB as DBService;
use Order\Service\Comment as OrderCommentService;

class Core
{

    public function getCommentsFromIds($order_ids) {
        return (new OrderCommentService())->getCommentsFromIds($order_ids);
    }

    public function saveOrderCommentFromAjax($data) {
        $data['order_id'] = (int) $data['order_id'];
        if(!isset($data['order_id'])) {
            return new Status(Status::S_ERROR, "Нет идентификатора заказа");
        }
        $data['label_id'] = (int) $data['label_id'];
        if(!isset($data['label_id'])) {
            return new Status(Status::S_ERROR, "Не выбрвн Цвет");
        }

        $data['text'] = strip_tags($data['text']);
        if ((new OrderCommentService())->saveOrderComment($data['order_id'],$data['label_id'],$data['text']) === false) {
            return new Status(Status::S_ERROR, "Ошибка при сохранении");
        }

        return new Status(Status::S_SUCCESS, "Комментраий сохранен",'100');
    }

    /**
     * @param $order_id
     * @return bool
     */
    public function removeOrder($order_id) {
        $order_id = (int)$order_id;
        if (empty($order_id)) { return false; }

        $sql = "
            UPDATE
              `orders`
            SET
              `delete_status` = 1
            WHERE
              `id` = '{$order_id}'
        ";

        return DBService::inst()->exec($sql);
    }
    public function restoreOrder($order_id) {
        $order_id = (int)$order_id;
        if (empty($order_id)) { return false; }

        $sql = "
            UPDATE
              `orders`
            SET
              `delete_status` = 0
            WHERE
              `id` = '{$order_id}'
        ";

        return DBService::inst()->exec($sql);
    }
}