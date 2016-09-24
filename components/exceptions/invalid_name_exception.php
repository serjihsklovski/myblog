<?php

class InvalidNameException extends Exception
{
    public function __construct($name, $message, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            "Name `$name` is incorrect. $message",
            $code,
            $previous
        );
    }
}
