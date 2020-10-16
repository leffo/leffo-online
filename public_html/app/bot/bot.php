<?php

use AYakovlev\Core\Database;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use VacTelegram\Core\CategoryOfVacancies;
use VacTelegram\Core\ChatKeyboard;

//use Telegram\Core\Db;

require "../../../vendor/autoload.php";
require "../../../config/config.php";       //Подключаем bd
$dbb = new Database();
$telegram = new Api('1386811624:AAEjyqPFSm9lzKDbjqqV43a7vJjFkMeJQsY'); //Устанавливаем токен, полученный у BotFather

$result = $telegram->getWebhookUpdate();           //Передаем в переменную $result полную информацию о сообщении пользователя

$text = $result["message"]["text"];                 //Текст сообщения
$chat_id = $result["message"]["chat"]["id"];        //Уникальный идентификатор пользователя
$name = $result["message"]["from"]["username"];     //Юзернейм пользователя



/*
$poll_answer = $result['poll_answer']['option_ids'];

if ($poll_answer[0]) {
    $pollAnswer = 'Опрос закончен! Ваш ответ: ' . $poll_answer[0];
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => json_encode($pollAnswer)]);
}
*/
$keyboard = ChatKeyboard::getCategoryKeyboard();

if($text) {
    if ($text == "/start") {
        $reply = "Добро пожаловать в бота вакансий!";
        $reply_markup = new Keyboard(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

    } elseif ($text == "/help") {
        $reply = "Выберите необходимую категорию вакансий.";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);

    } elseif ($text == "PHP") {
        CategoryOfVacancies::getListVacancies($text, $telegram, $chat_id);

    } elseif ($text == "C++") {
        CategoryOfVacancies::getListVacancies($text, $telegram, $chat_id);

    } elseif ($text == "Test") {
        $codeForPoll =  '*Что выведет код?*
```php 
echo "Hello, world!";
$b = 3;
$b = $b + 1;
echo $b;
```';
        $telegram->sendMessage([
            'chat_id' => $chat_id,
            'text' => $codeForPoll,
            'disable_notification' => true,
            'parse_mode' => 'Markdown',
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
    } else {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
    }
}
