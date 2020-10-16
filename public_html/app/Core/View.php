<?php


namespace VacTelegram\Core;


class View
{
    public static function tlgRender($item): string
    {
        $outString = '';
        $outString .= "*{$item->title}*" . "\n\n";
        $outString .= "*ID вакансии:* " . $item->id . "\n";
        $outString .= "*Зарплата:* " . $item->price . "\n";
        $outString .= "*Организация:* " . $item->organization . "\n";
        $outString .= "*Адрес: *" . $item->address . "\n";
        $outString .= "*Телефон:* " . $item->telephone . "\n";
        $outString .= "*Требуемый опыт:* " . $item->experience . "\n";
        $outString .= "*Технологии:* " . $item->technology . "\n";
        $outString .= "*Требуемые навыки:* " . $item->skills . "\n";
        $outString .= "*Описание вакансии:* " . $item->descriptions . "\n";
        $outString .= "*Дата создания вакансии:* " . $item->created_at;

        return $outString;
    }
}