<?php

require_once ROOT . '/controllers/controller.php';
require_once ROOT . '/models/user.php';


class UserController extends Controller
{
    private static $_patterns = [
        'email' => '/.+@.+\..+/i',
        'username' => '/[a-z]+[a-z0-9_]+/i'
    ];


    public function __construct()
    {
        parent::__construct(new User());
    }


    public function actionProfile($username)
    {
        require ROOT . '/views/user/profile.php';
    }


    public function actionLogin()
    {
        require ROOT . '/views/user/login.php';
    }


    public function actionSignUp()
    {
        if (
            isset($_REQUEST['username']) and $_REQUEST['username'] !== '' and
            isset($_REQUEST['password']) and $_REQUEST['password'] !== '' and
            isset($_REQUEST['confirm_password']) and
            $_REQUEST['confirm_password'] !== '' and
            isset($_REQUEST['answer']) and $_REQUEST['answer'] !== ''
        ) {
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            $confirmPassword = $_REQUEST['confirm_password'];
            $answer = $_REQUEST['answer'];
            $errors = [];

            // verify username
            if (strlen($username) < 8 or strlen($username) > 32) {
                $errors[] = 'Username can be 8-32 characters of length';
            } elseif (!preg_match(self::$_patterns['username'], $username)) {
                $errors[] = 'Username is incorrect!';
            } elseif ($this->_model->usernameExists($username)) {
                $errors[] = 'This username is already in use';
            }

            // verify password
            if (strlen($password) < 8 or strlen($password) > 32) {
                $errors[] = 'Password can be 8-32 characters of length';
            } elseif (
                strlen($password) != strlen($confirmPassword) or
                $password !== $confirmPassword
            ) {
                $errors[] = 'Passwords do not match!';
            }

            // verify answer
            if ($answer != 1988) {
                $errors[] = 'You gave the wrong answer';
            }

            // verify email address
            if (isset($_REQUEST['email']) and $_REQUEST['email'] !== '') {
                $email = $_REQUEST['email'];

                if (!preg_match(self::$_patterns['email'], $email)) {
                    $errors[] = 'E-mail address is incorrect!';
                } elseif ($this->_model->emailExists($email)) {
                    $errors[] = 'This e-mail address is already in use';
                }
            } else {
                $email = null;
            }

            if (count($errors) == 0) {
                $crypt_password = md5(
                    Application::$config['app']['passwordLeftSalt'] .
                    $password .
                    Application::$config['app']['passwordRightSalt']
                );

                $this->_model->addUser($username, $crypt_password, $email);

                if (isset($_REQUEST['remember_me']) and
                    $_REQUEST['remember_me'] == 'true')
                {
                    setcookie(
                        'username',
                        Application::encryptCookie($username),
                        time() + 60 * 60 * 24 + 30 * 12,
                        '/'
                    );

                    setcookie(
                        'password',
                        Application::encryptCookie($password),
                        time() + 60 * 60 * 24 + 30 * 12,
                        '/'
                    );
                } else {
                    setcookie(
                        'username',
                        Application::encryptCookie($username)
                    );

                    setcookie(
                        'password',
                        Application::encryptCookie($password)
                    );
                }

                require ROOT . '/views/user/sign_up_done.php';
            } else {
                require ROOT . '/views/user/sign_up.php';
            }
        } else {
            require ROOT . '/views/user/sign_up.php';
        }
    }


    public function actionSettings()
    {
        //
    }


    public function actionArticles()
    {
        //
    }
}
