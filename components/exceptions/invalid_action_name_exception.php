<?php

class InvalidActionNameException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            "Action name `$message` is incorrect",
            $code,
            $previous
        );
    }
}
