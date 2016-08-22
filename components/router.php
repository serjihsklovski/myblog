<?php

require_once 'exceptions/invalid_controller_filename_exception.php';
require_once 'exceptions/file_not_exists_exception.php';


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

        if (self::_isValidControllerFilename($controllerFilename)) {
            $this->_controllerFilename = ROOT . '/controllers/'
                . str_replace('-', '_', $controllerFilename) . '_controller.php';

            if (!file_exists($this->_controllerFilename)) {
                throw new FileNotExistsException($this->_controllerFilename);
            }

            // next steps of routing
        } else {
            throw new InvalidControllerFilenameException($controllerFilename);
        }

        echo $this->_controllerFilename;
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
     * Returns boolean value whether the $controllerFilename is correct or not
     *
     * Correct filename:
     * - correct-controller-filename
     * - i-have-23-dollars
     * - we-need-some-cola
     * - reload-apache2-please
     *
     * Incorrect filename:
     * - Incorrect-cOntroLler-filEname
     * - -bad-filename-
     * - 234-bad-filename
     * - bad-filename-%*$#
     *
     * Rules:
     * - correct controller filename has to consist of one or more latin lowercase letters
     * - it may consist of digits too, but first character of filename has to be a letter only
     * - if controller name consists of several words, they can be divided the hyphen character ('-')
     * - hyphen character can't appear between letters and digits more than once, as well as
     *   it can't begin and end the filename
     *
     * @param $controllerFilename string
     * @return bool
     */
    private static function _isValidControllerFilename($controllerFilename)
    {
        return preg_match('/[a-z\d-]+/', $controllerFilename) &&
               !preg_match('/-{2,}/', $controllerFilename) &&
               !preg_match('/[\d-]/', $controllerFilename[0]) &&
               !preg_match('/-+/', $controllerFilename[strlen($controllerFilename) - 1]);
    }
}
