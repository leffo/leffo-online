<?php


namespace AYakovlev\Core;


use Exception;

class Request
{
    private string $controller = 'Default';
    private string $method = 'Index';
    public static array $params = [];

    public function __construct()
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $uri = array_diff($uri, ['']);

        // controller/method/id
        if (isset($uri[1])) {
            // TODO: debug profile - disconnect in production
            if (preg_match('~\?XDEBUG_SESSION_START=\d+~', $uri[1])) {
                $uri[1] = null;
            } else {
                $this->controller = $uri[1]; // this operator stay on
            }
            // end debug profile
        }

        if (isset($uri[2])) {
            $this->method = $uri[2];
        }

        $numberParams = count($uri);
        $i = 1;
        while ($i <= $numberParams) {
           self::$params[$i] = $uri[$i];
           $i++;
        }
//var_dump($uri);
        $this->validateCommand();
    }

    private function validateCommand(): bool
    {
        if (!class_exists("AYakovlev\Controllers\\" . ucfirst($this->controller) . "Controller")) {
            throw new Exception("AYakovlev\Controllers\\" . ucfirst($this->controller) . "Controller не существует<br>");
        }

        if (!method_exists("AYakovlev\Controllers\\" . $this->controller . "Controller", $this->method)) {
            throw new Exception("Метод AYakovlev\Controllers\\" . ucfirst($this->controller) . "Controller\\" . $this->method . " не существует<br>");
        }

        return true;
    }

    public function getController(): string
    {
        return "AYakovlev\Controllers\\" . ucfirst($this->controller) . "Controller";
    }

    public function getMethod(): string
    {
        return $this->method;
    }

}