<?php


namespace AYakovlev\Core;



class App
{
    public function __construct()
    {
    }

    public function run()
    {
        // создаем соединение с Eloquent, Initialize Illuminate Database Connection
        require "../config/config.php";
        new Database();

        // разобрать запрос
        $request = new Request();

        // создать контроллер
        $controllerName = $request->getController();
        $controller = new $controllerName();

        // вызвать у него метод из команды
        $method = $request->getMethod();
        $controller->$method();
    }
}