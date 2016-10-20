<?php

require_once ROOT . '/components/router.php';
require_once ROOT . '/components/exceptions/file_not_exists_exception.php';

class Application
{
    const COOKIE_EXPIRE_SESSION = null;
    const COOKIE_EXPIRE_YEAR = 60 * 60 * 24 * 365;

    public static $config;

    private $_router;
    private $_controller;
    private $_action;
    private $_args;


    public static function encryptCookie($value)
    {
        if (!$value) {
            return false;
        }

        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);

        $cryptText = mcrypt_encrypt(
            MCRYPT_RIJNDAEL_256,
            md5(self::$config['app']['cookieKey']),
            $value,
            MCRYPT_MODE_ECB,
            $iv
        );

        return trim(base64_encode($cryptText));
    }


    public static function decryptCookie($value)
    {
        if (!$value) {
            return false;
        }

        $cryptText = base64_decode($value);
        $ivSize = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($ivSize, MCRYPT_RAND);

        $decryptText = mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256,
            md5(self::$config['app']['cookieKey']),
            $cryptText,
            MCRYPT_MODE_ECB,
            $iv
        );

        return trim($decryptText);
    }


    public static function setSiteCookie(
        string $name, $value, $expire = self::COOKIE_EXPIRE_SESSION
    ) {
        setcookie($name, self::encryptCookie($value), time() + $expire, '/');
    }


    public static function getSiteCookie(string $name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
    }


    public static function eatCookie(string $name)
    {
        self::setSiteCookie($name, null);
    }


    public static function passwordHashCode(string $password) : string
    {
        return md5(
            self::$config['app']['passwordLeftSalt'] .
            $password .
            self::$config['app']['passwordRightSalt']
        );
    }


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
