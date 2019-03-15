<?php

namespace Order\Model;

class CommentLabel
{
    public $id;
    public $color;
    public $name;

    function __construct($id, $color, $name = null)
    {
        $this->color = $color;
        $this->id = $id;
        $this->name = $name;
    }
}