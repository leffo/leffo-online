<?php


namespace AYakovlev\Core;


class View
{
    public static array $extraVars = [];

    public function setVar(string $name, $value): void
    {
        self::$extraVars[$name] = $value;
    }

    public static function render(string $view, ?object $data = null, int $code = 200): void
    {
        http_response_code($code);
        extract(self::$extraVars);
        $viewPath = __DIR__ . "/../View/" . $view . ".tpl.php";

        if (file_exists($viewPath)) {

            ob_start();
            include $viewPath;
            $buffer = ob_get_contents();
            ob_end_clean();

            echo $buffer;
        }
    }

    public static function displayJson($data, int $code = 200)
    {
        header('Content-type: application/json; charset=utf-8');
        http_response_code($code);
        echo json_encode($data);
    }
}