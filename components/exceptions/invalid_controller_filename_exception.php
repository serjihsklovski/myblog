<?php

class InvalidControllerFilenameException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            "Controller filename `$message` is incorrect",
            $code,
            $previous
        );
    }
}
