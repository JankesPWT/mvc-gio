<?php

namespace App\Exceptions;

class RouteNotFoundException extends \Exception
{
    protected $message = '404 ni ma';
    public function __construct()
    {
        echo $this->message;
    }
}