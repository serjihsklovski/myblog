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
            $this->_router = new Router($this->_config['routes']);
        } catch (InvalidControllerFilenameException $e) {
            $e->getMessage();
        } catch (InvalidActionNameException $e) {
            $e->getMessage();
        }
    }


    public function run()
    {
        $controllerFilename = $this->_router->getControllerFilename();

        if (!file_exists($controllerFilename)) {
            header('HTTP/1.1 404 Not Found');
            exit('<br><br><br><h1 align="center">404 Not Found</h1>');
        }

        include_once $controllerFilename;

        $controllerName = $this->_router->getControllerName();

        if (!class_exists($controllerName)) {
            header('HTTP/1.1 404 Not Found');
            exit('<br><br><br><h1 align="center">404 Not Found</h1>');
        }

        $actionName = $this->_router->getActionName();

        if (!method_exists($controllerName, $actionName)) {
            header('HTTP/1.1 404 Not Found');
            exit('<br><br><br><h1 align="center">404 Not Found</h1>');
        }

        $result = call_user_func_array(
            [
                new $controllerName,
                $actionName
            ],
            $this->_router->getActionArgs()
        );
    }
}
