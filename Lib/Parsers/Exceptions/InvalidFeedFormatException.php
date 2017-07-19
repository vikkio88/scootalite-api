<?php

namespace App\Lib\Parsers\Exceptions;


use App\Lib\Slime\Exceptions\SlimeException;

class InvalidFeedFormatException extends SlimeException
{
    protected $code = 422;

    public function __construct()
    {
        parent::__construct("Invalid Feed Format");
    }


}