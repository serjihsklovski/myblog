<?php

require_once ROOT . '/components/exceptions/invalid_name_exception.php';


class Router
{
    private $_uri;
    private $_controllerSubName;
    private $_controllerFilename;
    private $_controllerName;
    private $_controller;
    private $_actionName;
    private $_actionArgs;
    private $_routes;
    private $_segments;


    public function __construct(&$routes)
    {
        $this->_routes = $routes;
        $this->_uri = self::_getUri();
        $this->_searchRoute();

        $this->_segments = $this->getSegments();

        $this->_initControllerSubName();
        $this->_initControllerFilename();
        $this->_initControllerName();
        $this->_initController();
        $this->_initActionName();
        $this->_initArgs();
    }


    public function getSegments()
    {
        return explode('/', $this->_uri);
    }


    /**
     * @return string request uri without first '/' character
     */
    private static function _getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
//            return ltrim($_SERVER['REQUEST_URI'], '/');
            return trim(substr($_SERVER['REQUEST_URI'], strlen('/myblog/')), '/');
        }

        return '';
    }


    /**
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }


    /**
     * @return string
     */
    public function getControllerFilename()
    {
        return $this->_controllerFilename;
    }


    /**
     * @return string
     */
    public function getControllerName()
    {
        return $this->_controllerName;
    }


    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->_controller;
    }


    /**
     * @return string
     */
    public function getActionName()
    {
        return $this->_actionName;
    }


    /**
     * @return array
     */
    public function getActionArgs()
    {
        return $this->_actionArgs;
    }


    /**
     * Returns boolean value whether the $name is correct or not
     *
     * Correct name:
     * - correct-awesome-name
     * - i-have-23-dollars
     * - we-need-some-cola
     * - reload-apache2-please
     *
     * Incorrect filename:
     * - Incorrect-nAme
     * - -bad-name
     * - bad-name-
     * - 234-bad-name
     * - bad-name-%*$#
     * - bad--name
     *
     * Rules:
     * - correct name has to consist of one or more latin lowercase letter
     * - it may consist of digits too, but first character of name has to be a letter only
     * - if name consists of several words, they can be divided the hyphen character ('-')
     * - hyphen character can't appear between letters and digits more than once, as well as
     *   it can't begin and end the name
     *
     * @param $name string
     * @return bool
     */
    private static function _isValidName($name)
    {
        return preg_match('/^[a-z\d-]+$/', $name) &&    // consists of these characters
               preg_match('/^[a-z]+/', $name) &&        // begins with letter
               preg_match('/[a-z\d]+$/', $name) &&      // ends with letter or digit
               !preg_match('/-{2,}/', $name);           // hyphen can't appear in a row more than twice
    }


    private static function _toCamelCase($stringWithHyphens)
    {
        return implode('',
            array_map(function ($item) {
                return ucfirst($item);
            }, explode('-', $stringWithHyphens))
        );
    }


    /**
     * If returns false, than there are not exception routes in $this->_uri,
     * but if $this->_uri string is empty, than it becomes the default
     * controller name.
     *
     * if returns true, than there was found an exception route.
     *
     * @return bool
     */
    private function _searchRoute()
    {
        if ($this->_uri === '') {
            $this->_uri = $this->_routes['defaultController'];
            return false;
        }

        foreach ($this->_routes['exceptionRoutes'] as $uriPattern => $route) {
            if (preg_match("~$uriPattern~", $this->_uri)) {
                $this->_uri = preg_replace("~$uriPattern~", $route, $this->_uri);
                return true;
            }
        }

        return false;
    }


    private function _initControllerSubName()
    {
        $this->_controllerSubName = array_shift($this->_segments);
    }


    private function _initControllerFilename()
    {
        $this->_controllerFilename = ROOT . '/controllers/'
            . str_replace('-', '_', $this->_controllerSubName)
            . '_controller.php';
    }


    private function _initControllerName()
    {
        if (!self::_isValidName($this->_controllerSubName)) {
            throw new InvalidNameException(
                $this->_controllerSubName,
                'Controller filename does not match any rules.'
            );
        }

        $this->_controllerName = self::_toCamelCase($this->_controllerSubName)
            . 'Controller';
    }


    private function _initController()
    {
        if (!file_exists($this->_controllerFilename)) {
            throw new FileNotExistsException($this->_controllerFilename);
        }

        include $this->_controllerFilename;

        $this->_controller = new $this->_controllerName();
    }


    private function _initActionName()
    {
        if (!count($this->_segments)) {
            $actionName = $this->_controller->getDefaultAction();
        } else {
            $actionName = array_shift($this->_segments);
        }

        if (!self::_isValidName($actionName)) {
            throw new InvalidNameException(
                $actionName,
                'Action name does not match any rules.'
            );
        }

        $this->_actionName = 'action' . self::_toCamelCase($actionName);
    }


    private function _initArgs()
    {
        $this->_actionArgs = $this->_segments;
    }
}
