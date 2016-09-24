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
        } catch (FileNotExistsException $e) {
            echo $e->getMessage(); die;
        } catch (InvalidNameException $e) {
            echo $e->getMessage(); die;
        }

        $this->_controller = $this->_router->getController();
        $this->_action = $this->_router->getActionName();
        $this->_args = $this->_router->getActionArgs();
    }


    public function run()
    {
        if (!method_exists($this->_controller, $this->_action)) {
            // 404
            echo '404'; die;
        }

        if (count($this->_args) > (new ReflectionMethod(
            $this->_controller, $this->_action))->getNumberOfParameters())
        {
            // 40x
            echo '40x'; die;
        }

        return call_user_func_array(
            [
                $this->_controller,
                $this->_action
            ],
            $this->_args
        );
    }
}
