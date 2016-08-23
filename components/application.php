<?php

require_once ROOT . '/components/router.php';
require_once ROOT . '/components/exceptions/file_not_exists_exception.php';

class Application
{
    private $_config;
    private $_router;


    public function __construct(&$config)
    {
        $this->_config = $config;
        
        try {
            $this->_router = new Router();
        } catch (InvalidControllerFilenameException $e) {
            $e->getMessage();
        } catch (InvalidActionNameException $e) {
            $e->getMessage();
        }
    }


    public function run()
    {
        //
    }
}