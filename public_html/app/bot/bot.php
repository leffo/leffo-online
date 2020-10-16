<?php

use AYakovlev\Core\Database;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use VacTelegram\Core\CategoryOfVacancies;
use VacTelegram\Core\ChatKeyboard;
use VacTelegram\Core\Poll;

//use Telegram\Core\Db;

require "../../../vendor/autoload.php";
require "../../../config/config.php";       //Подключаем bd
$dbb = new Database();

$telegram = new Api((require '../../config/settings.php')['apitoken']); //Устанавливаем токен, полученный у BotFather

$result = $telegram->getWebhookUpdate();           //Передаем в переменную $result полную информацию о сообщении пользователя

$text = $result["message"]["text"];                 //Текст сообщения
$chat_id = $result["message"]["chat"]["id"];        //Уникальный идентификатор пользователя
$name = $result["message"]["from"]["username"];     //Юзернейм пользователя

$keyboard = ChatKeyboard::getCategoryKeyboard();

if($text) {
    if ($text == "/start") {
        $reply = "Добро пожаловать в бота вакансий!";
        $reply_markup = new Keyboard(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

    } elseif ($text == "/help") {
        $reply = "Выберите необходимую категорию вакансий.";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);

    } elseif (ChatKeyboard::inArrayMultiDimensional($text, $keyboard) && $text != "Test") {
        CategoryOfVacancies::getListVacancies($text, $telegram, $chat_id);

    } elseif ($text == "Test") {
        Poll::sendQuizPoll($telegram, $chat_id);
    }
} else {
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
}
