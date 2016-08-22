<?php

require_once ROOT . '/components/router.php';

class Application
{
    private $_config;
    private $_router;


    public function __construct(&$config)
    {
        $this->_config = $config;
    }


    public function run()
    {
        $this->_router = new Router();
    }
}