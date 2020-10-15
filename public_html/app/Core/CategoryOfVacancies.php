<?php


namespace Telegram\Core;


use AYakovlev\Models\Vacancy;

class CategoryOfVacancies
{
    public function getListVacancies(string $categoryVacancy):void
    {
        $vacancyPhp = Vacancy::where('category', '=', 'PHP')->get();

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
