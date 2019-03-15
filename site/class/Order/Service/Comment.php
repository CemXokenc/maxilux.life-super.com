<?php

namespace Order\Service;

use Core\Model\Status;
use PDO;

use Order\Model\Comment as CommentElement;
use Order\Model\CommentLabel as CommentLabelElement;

use Core\Service\DB as DBService;

class Comment
{

    const COMMENTS_FORMAT_DEFAULT = 'COMMENTS_FORMAT_DEFAULT';
    const COMMENTS_FORMAT_GROUPED_BY_ID = 'COMMENTS_FORMAT_GROUPED_BY_ID';
    const COMMENTS_FORMAT_GROUPED_BY_ORDER_ID = 'COMMENTS_FORMAT_GROUPED_BY_ORDER_ID';

    public function getCommentsFromIds($orders_ids) {
        $sql = "
            SELECT
              `order_comment_label`.*,
              `order_comment`.*
            FROM
              `order_comment`
              LEFT JOIN
                `order_comment_label` ON `order_comment_label`.`id` = `order_comment`.`label_id`
            WHERE
              `order_comment`.`order_id` IN (" . join(',', $orders_ids) .")
        ";

        $comments = DBService::inst()->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        if (empty($comments)) { return []; }

        $result = [];

        foreach($comments as $comment) {
            $comment_label = new CommentLabelElement($comment['label_id'], $comment['color'], $comment['name']);
            $comment = new CommentElement($comment['id'], $comment['order_id'], $comment_label, $comment['comment']);
            $result[] = $comment;
        }

        return $result;
    }

    public function saveOrderComment($order_id, $label_id, $comment = "") {

        $db = DBService::inst();

        $sql = "
          INSERT INTO `order_comment`
            (`order_id`,`label_id`,`comment`)
          VALUES ('{$order_id}','{$label_id}',:comment)
          ON DUPLICATE KEY
          UPDATE
            `comment` = :comment,
            `label_id` = '{$label_id}'
        ";

        $sth = $db->prepare($sql);
        return $sth->execute(array(':comment' => $comment));
    }

    public static function formatCommentsArray($comments_array, $format = self::COMMENTS_FORMAT_DEFAULT) {
        $result = [];
        switch($format) {
            case self::COMMENTS_FORMAT_GROUPED_BY_ID:
                /**
                 * @var CommentElement $comment
                 */
                foreach ($comments_array as $comment) {
                    $result[$comment->id] = $comment;
                }
                break;
            case self::COMMENTS_FORMAT_GROUPED_BY_ORDER_ID:
                /**
                 * @var CommentElement $comment
                 */
                foreach ($comments_array as $comment) {
                    $result[$comment->order_id] = $comment;
                }
                break;
            case self::COMMENTS_FORMAT_DEFAULT:
            default:
                $result = $comments_array;
        }
        return $result;
    }

    public function getAllCommentsLabels() {
        $sql = "
            SELECT
              *
            FROM
              `order_comment_label`
        ";

        $labels = DBService::inst()->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $result = [];
        foreach ($labels as $label) {
            $result[] = new CommentLabelElement($label['id'], $label['color'], $label['name']);
        }
        return $result;
    }
}