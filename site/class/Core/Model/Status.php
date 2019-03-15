<?php

namespace Core\Model;

class Status
{
    public $status;
    public $message;
    public $code;

    const S_ERROR = 'error';
    const S_SUCCESS = 'success';

    function __construct($status, $message, $code = null)
    {
        $this->message = $message;
        $this->status = $status;
        $this->code = $code;
    }
}