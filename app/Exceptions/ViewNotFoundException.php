<?php

namespace App\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'widoku ni ma';
    public function __construct()
    {
        echo $this->message;
    }
}