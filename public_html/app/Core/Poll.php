<?php


namespace VacTelegram\Core;


use Telegram\Bot\Api;

class Poll
{
    public static function sendQuizPoll(Api $telegram, int $chat_id): void
    {
        $codeForPoll =  '*Что выведет код?*
```php 
echo "Hello, world!";
$b = 3;
$b = $b + 1;
echo $b;
```';
        $telegram->sendMessage([
            'chat_id'               => $chat_id,
            'text'                  => $codeForPoll,
            'disable_notification'  => true,
            'parse_mode'            => 'Markdown',
        ]);

        $params = [
            'chat_id'                   => $chat_id,
            'question'                  => "Что выведет вышеуказанный код?",
            'options'                   => ['Hello, world!4', 'Здравствуй, мир!', 'ERROR! No helloworlds program in PHP!'],
            'disable_notification'      => '',
            'reply_to_message_id'       => '',
            'reply_markup'              => '',
            'type'                      => 'quiz',
            'allows_multiple_answers'   => false,
            'correct_option_id'         => 0,
            'explanation'               => 'Это просто хелловорлд!',
            'is_closed'                 => false,
            'is_anonymous'              => false,
            'open_period'               => 15,
        ];
        $msg = $telegram->sendPoll($params);
    }
}