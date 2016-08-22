<?php

require_once ROOT . '/components/router.php';

class Application
{
    private $_config;
    private $_router;


    public function __construct(&$config)
    {
        try {
            $this->_config = $config;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }


    public function run()
    {
        $this->_router = new Router();
    }
}