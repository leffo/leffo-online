<?php

use AYakovlev\Models\Vacancy;
use Telegram\Bot\Api;
use Telegram\Bot\Keyboard\Keyboard;
//use Telegram\Core\Db;

include('../../vendor/autoload.php');                     //Подключаем библиотеку

$telegram = new Api('1386811624:AAEjyqPFSm9lzKDbjqqV43a7vJjFkMeJQsY'); //Устанавливаем токен, полученный у BotFather
$result = $telegram->getWebhookUpdate();           //Передаем в переменную $result полную информацию о сообщении пользователя

$text = $result["message"]["text"];                 //Текст сообщения
$chat_id = $result["message"]["chat"]["id"];        //Уникальный идентификатор пользователя
$name = $result["message"]["from"]["username"];     //Юзернейм пользователя
$keyboard = [["PHP"], ["C++"], ["Java"], ["DevOps"], ["Test"]];  //Клавиатура
$chatId = $result->getMessage()->getChat()->getId();
$poll_answer = $result['poll_answer']['option_ids'[0]];
//$db = Db::getInstance();

if($text) {
    if ($text == "/start") {
        $reply = "Добро пожаловать в бота вакансий!";
        //$reply_markup = $telegram->replyKeyboardMarkup(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $reply_markup = new Keyboard(['keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

    } elseif ($text == "/help") {
        $reply = "Выберите необходимую категорию вакансий.";
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => $reply]);

    } elseif ($text == "PHP") {
        $vacancyPhp = Vacancy::where('category', '=', 'PHP')->get();

        foreach ($vacancyPhp as $item) {
            $msg = view($item);
            //$msg = json_encode($msg);
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $msg,
                'parse_mode' => 'Markdown',
            ]);
        }

    } elseif ($text == "C++") {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Вы выбрали "C++"! Посмотрите вакансии:']);
        $vacancyPhp = Vacancy::where('category', '=', 'C++')->get();

        foreach ($vacancyPhp as $item) {
            $msg = view($item);
            //$msg = json_encode($msg);
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $msg,
                'parse_mode' => 'Markdown',
            ]);
        }

    } elseif ($text == "Java") {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Вы выбрали "Java"! Посмотрите вакансии:']);
        $vacancy = Vacancy::where('category', '=', 'Java')->get();

        foreach ($vacancy as $item) {
            $msg = view($item);
            //$msg = json_encode($msg);
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $msg,
                'parse_mode' => 'Markdown',
            ]);
        }
    } elseif ($text == "DevOps") {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Вы выбрали "DevOps"! Посмотрите вакансии:']);
        $vacancy = Vacancy::where('category', '=', 'DEVOPS')->get();

        foreach ($vacancy as $item) {
            $msg = view($item);
            //$msg = json_encode($msg);
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => $msg,
                'parse_mode' => 'Markdown',
            ]);
        }
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

        $pollAnswer = 'Опрос закончен! Ваш ответ: ' . $poll_answer;
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => json_encode($pollAnswer)]);

    }
} else {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение."]);
}



function view(array $item): string
{
    $outString = '';
    $outString = "*ID вакансии:* " . $item["id"] . "\n";
    $outString .= "*Наименование вакансии:* " . $item["title"] . "\n";
    $outString .= "*Зарплата:* " . $item["price"] . "\n";
    $outString .= "*Организация:* " . $item["organization"] . "\n";
    $outString .= "*Адрес: *" . $item["address"] . "\n";
    $outString .= "*Телефон:* " . $item["telephone"] . "\n";
    $outString .= "*Требуемый опыт:* " . $item["experience"] . "\n";
    $outString .= "*Технологии:* " . $item["technology"] . "\n";
    $outString .= "*Требуемые навыки:* " . $item["skills"] . "\n";
    $outString .= "*Описание вакансии:* " . $item["descriptions"] . "\n";
    $outString .= "*Дата создания вакансии;* " . $item["datecreation"] . "\n";
    
    return $outString;
}

