<?php

require_once ROOT . '/components/router.php';
require_once ROOT . '/components/exceptions/file_not_exists_exception.php';

class Application
{
    public static $config;

    private $_router;
    private $_controller;
    private $_action;
    private $_args;


    public function __construct(&$config)
    {
        self::$config = $config;

        try {
            $this->_router = new Router(self::$config['router']);
        } catch (InvalidControllerFilenameException $e) {
            $e->getMessage();
        } catch (InvalidActionNameException $e) {
            $e->getMessage();
        }

        $this->_controller = $this->_router->getController();
        $this->_action = $this->_router->getActionName();
        $this->_args = $this->_router->getActionArgs();
    }


    public function run()
    {
        return $result = call_user_func_array(
            [
                $this->_controller,
                $this->_action
            ],
            $this->_args
        );
    }
}
