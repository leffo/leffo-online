<?php


namespace AYakovlev\Controllers;


use AYakovlev\Core\Request;
use AYakovlev\Core\View;
use AYakovlev\Models\Vacancy;

class ResponseController extends AbstractController
{
    private const ID = 3;
    public function index(): void
    {
        echo "Index";
    }

    public function view()
    {
        $data = Vacancy::findOrFail(Request::$params[self::ID]);
        View::render("response", $data);
        //var_dump($data);

        //View::render("vacancies", $data);
    }
}