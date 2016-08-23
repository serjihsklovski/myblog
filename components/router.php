<?php

require_once ROOT . '/components/exceptions/invalid_controller_filename_exception.php';
require_once ROOT . '/components/exceptions/invalid_action_name_exception.php';


class Router
{
    private $_uri;
    private $_controllerFilename;
    private $_controllerName;
    private $_actionName;
    private $_actionArgs;


    public function __construct()
    {
        $this->_uri = self::_getUri();
        $segments = explode('/', $this->_uri);
        $controllerFilename = array_shift($segments);
        $actionName = array_shift($segments);

        if (!self::_isValidName($controllerFilename)) {
            throw new InvalidControllerFilenameException($controllerFilename);
        }

        if (!self::_isValidName($actionName)) {
            throw new InvalidActionNameException($actionName);
        }

        $this->_controllerFilename = ROOT . '/controllers/'
            . str_replace('-', '_', $controllerFilename) . '_controller.php';

        $this->_controllerName = self::_toCamelCase($controllerFilename) . 'Controller';
        $this->_actionName = 'action' . self::_toCamelCase($actionName);
        $this->_actionArgs = $segments;
    }


    /**
     * @return string request uri without first '/' character
     */
    private static function _getUri()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
//            return ltrim($_SERVER['REQUEST_URI'], '/');
            return trim(substr($_SERVER['REQUEST_URI'], strlen('/myblog/')));
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
}
