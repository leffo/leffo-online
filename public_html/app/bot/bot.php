<?php

use AYakovlev\Core\Database;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
use VacTelegram\Core\CategoryOfVacancies;
use VacTelegram\Core\ChatKeyboard;
use VacTelegram\Core\Poll;

//use Telegram\Core\Db;

require "../../../vendor/autoload.php";
require "../../../config/config.php";

$dbb        = new Database();
$telegram   = new Api((require '../../config/settings.php')['apitoken']);
$result     = $telegram->getWebhookUpdate();

$text       = $result["message"]["text"];
$chat_id    = $result["message"]["chat"]["id"];
$name       = $result["message"]["from"]["username"];
$first_name = $result["message"]["from"]["first_name"];
$last_name  = $result["message"]["from"]["last_name"];
$keyboard   = ChatKeyboard::getCategoryKeyboard();

if($text) {
    if ($text == "/start") {
        $reply = "Добро пожаловать в бота вакансий!";
        $reply_markup = new Keyboard(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

    } elseif ($text == "/help") {
        $reply = "Выберите необходимую категорию вакансий.";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);

    } elseif (ChatKeyboard::inArray2d($text, $keyboard) && $text != "Test") {
        CategoryOfVacancies::getListVacancies($text, $telegram, $chat_id, $name, $first_name, $last_name);

    } elseif ($text == "Test") {
        Poll::sendQuizPoll($telegram, $chat_id);
    }
} else {
    $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
}
