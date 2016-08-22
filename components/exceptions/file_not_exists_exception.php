<?php

class FileNotExistsException extends Exception
{
    public function __construct($message, $code = 0, Exception $previous = null)
    {
        parent::__construct(
            "File `$message` does not exist",
            $code,
            $previous
        );
    }
}
