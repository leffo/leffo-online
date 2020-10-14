<?php


namespace AYakovlev\Core;


use AYakovlev\Models\User;
use AYakovlev\Models\User_activation_code;

class UserActivationService
{
    public static function createActivationCode(User $user): string
    {
        // Генерируем случайную последовательность символов
        $code = bin2hex(random_bytes(16));
        User_activation_code::create(
            [
                'user_id' => $user->id,
                'code' => $code
            ]
        );

        return $code;
    }

    public static function checkActivationCode(User $user, string $code): bool
    {
         $result = User_activation_code::where(
             'user_id', '=', $user->id, 'and', 'code', '=',  $code
        )->get();
        return !empty($result);
    }
}