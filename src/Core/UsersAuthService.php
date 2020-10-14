<?php


namespace AYakovlev\Core;


use AYakovlev\Models\User;

class UsersAuthService
{
    public static function createToken(User $user): void
    {
        $token = $user->id . ':' . $user->auth_token;

        // имя
        // значение
        // срок действия: 0 - при закрытии браузера
        // путь: / - куки доступны во всем домене
        // домен
        // secure: false - можно передавать по http
        // Если задано TRUE, cookie будут доступны только через HTTP-протокол
        setcookie('token', $token, 0, '/', '', false, true);
    }

    public static function getUserByToken(): ?User
    {
        $token = $_COOKIE['token'] ?? '';

        if (empty($token)) {
            return null;
        }

        [$userId, $authToken] = explode(':', $token, 2);

        $user = User::findOrFail($userId);

        if ($user === null) {
            return null;
        }

        if ($user->auth_token !== $authToken) {
            return null;
        }

        return $user;
    }
}