<?php


namespace VacTelegram\Core;


use AYakovlev\Models\Vacancy;
use Telegram\Bot\Api;

class CategoryOfVacancies
{
    public static function getListVacancies(
        string $categoryVacancy,
        object $telegram,
        int $chat_id,
        string $name,
        string $first_name,
        string $last_name
    ): void
    {
        $telegram->sendMessage(['chat_id' => $chat_id, 'text' => 'Вы выбрали "' . $categoryVacancy . '"! Посмотрите вакансии:']);
        $vacancyPhp = Vacancy::where('category', '=', $categoryVacancy)->get();

        foreach ($vacancyPhp as $item) {
            $msg = View::tlgRender($item);
            $ref = "https://leffo.online/response/view/" . $item->id . "/" . $name. "/" . $first_name. "/" . $last_name;
            $telegram->sendMessage([
                'chat_id' => $chat_id,
                'text' => "\n\n" . $msg . "\n\n" . "[Откликнуться]($ref)",
                'parse_mode' => 'Markdown',
            ]);
        }
    }
}
