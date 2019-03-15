<?php

namespace Order\Model;

use Order\Model\CommentLabel as CommentLabelElement;

class Comment
{

    public $id;
    public $order_id;
    /**
     * @var CommentLabelElement $label
     */
    public $label;
    public $comment;

    /**
     * @param $id
     * @param $order_id
     * @param CommentLabel $label
     * @param null $comment
     */
    function __construct($id, $order_id, CommentLabelElement $label = null, $comment = null)
    {
        $this->comment = $comment;
        $this->id = $id;
        $this->label = $label;
        $this->order_id = $order_id;
    }
}