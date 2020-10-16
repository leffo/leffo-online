<?php


namespace VacTelegram\Core;


use AYakovlev\Models\Vacancy;

class ChatKeyboard
{
    public static function getCategoryKeyboard(): array
    {
        $categoryList = Vacancy::groupBy('category')->pluck('category');

        $keyboard = [];
        $numberRow = count($categoryList) / 3;
        $i = 0;
        for($j = 0; $j < $numberRow; $j++) {
            for($k = 0; $k < 3; $k++, $i++) {
                if ($i == count($categoryList)) {
                    $keyboard[$j][$k] = 'Test';
                    break;
                }
                $keyboard[$j][$k] = $categoryList[$i];
            }
        }
        //$keyboard = [["PHP", "C++", "JavaScript"], ["DevOps", "GO", "MT"], ["QAE", "Test"]];
        return $keyboard;
    }
}
