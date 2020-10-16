<?php


namespace Telegram\Core;


use AYakovlev\Models\Vacancy;
use Telegram\Bot\Api;

class CategoryOfVacancies
{
    public static function getListVacancies(string $categoryVacancy, Api $telegram, int $chat_id): void
    {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Вы выбрали "C++"! Посмотрите вакансии:']);
        $vacancyPhp = Vacancy::where('category', '=', $categoryVacancy)->get();

        foreach ($vacancyPhp as $item) {
            $msg = view($item);
            $ref = "https://leffo.online/response/view/" . $item->id;
            // TODO: получить экземплярчик телеграмма
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => "\n\n" . $msg . "\n\n" . "[Откликнуться]($ref)",
                'parse_mode' => 'Markdown',
            ]);
        }
    }
}
