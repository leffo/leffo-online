<?php


namespace AYakovlev\Controllers;


use AYakovlev\Core\EmailSender;
use AYakovlev\Core\Request;
use AYakovlev\Core\UserActivationService;
use AYakovlev\Core\UsersAuthService;
use AYakovlev\Core\View;
use AYakovlev\Exception\InvalidArgumentException;
use AYakovlev\Models\User;


class UsersController extends AbstractController
{
    public const ID = 3;
    public const TOKEN = 4;

    public function signUp()
    {
        if (!empty($_POST)) {
            try {
                if (empty($_POST['nickname'])) {
                    throw new InvalidArgumentException('Не передан nickname');
                }

                if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['nickname'])) {
                    throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита и цифр');
                }

                if (empty($_POST['email'])) {
                    throw new InvalidArgumentException('Не передан email');
                }

                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidArgumentException('Email некорректен');
                }

                if (empty($_POST['password'])) {
                    throw new InvalidArgumentException('Не передан password');
                }

                if (mb_strlen($_POST['password']) < 8) {
                    throw new InvalidArgumentException('Пароль должен быть не менее 8 символов');
                }

                if (User::where('nickname', '=', $_POST['nickname'])->first() !== null) {
                    throw new InvalidArgumentException('Пользователь с таким nickname уже существует');
                }

                if (User::where('email', '=', $_POST['email'])->first() !== null) {
                    throw new InvalidArgumentException('Пользователь с таким email уже существует');
                }


                $user = User::create(
                    [
                        'nickname' => $_POST['nickname'],
                        'email' => $_POST['email'],
                        'is_confirmed' => false,
                        'role' => 'user',
                        'password_hash' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        'auth_token' => sha1(random_bytes(100)) . sha1(random_bytes(100)),
                    ]
                );
                //var_dump($user);
                
            } catch (InvalidArgumentException $e) {
                View::render('signup', $e);
                return;
            }

            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);
                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->id,
                    'code' => $code
                ]);

                View::render('signUpSuccessful');
                return;
            }
        }

        View::render('signup', null);
    }

    public function activate()
    {
        $user = User::findOrFail(Request::$params[self::ID]);
        $isCodeValid = UserActivationService::checkActivationCode($user, Request::$params[self::TOKEN]);
        if ($isCodeValid) {
            $user->is_confirmed = 1;
            $user->save();
            View::render('activateSuccessful');
        }
    }

    public function login()
    {
        if (!empty($_POST)) {
            try {
                if (empty($_POST['email'])) {
                    throw new InvalidArgumentException('Не передан email');
                }

                if (empty($_POST['password'])) {
                    throw new InvalidArgumentException('Не передан password');
                }

                $user = User::where('email', '=', $_POST['email'])->first();
                if ($user === null) {
                    throw new InvalidArgumentException('Нет пользователя с таким email');
                }

                if (!password_verify($_POST['password'], $user->password_hash)) {
                    throw new InvalidArgumentException('Неправильный пароль');
                }

                if (!$user->is_confirmed) {
                    throw new InvalidArgumentException('Пользователь не подтверждён');
                }

                $user->auth_token = sha1(random_bytes(100)) . sha1(random_bytes(100));
                $user->save();

                UsersAuthService::createToken($user);
                header('Location: /');
                exit();

            } catch (InvalidArgumentException $e) {
                View::render('login', $e);
                return;
            }
        }

        View::render('login');
    }

    public function logOut()
    {
        setcookie('token', '', -1, '/', '', false, true);
        header('Location: /');
    }

}
