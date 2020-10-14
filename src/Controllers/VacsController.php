<?php


namespace AYakovlev\Controllers;


use AYakovlev\Core\View;
use AYakovlev\Models\Vacancy;

class VacsController extends AbstractController
{

    public function index(): void
    {
        echo "Index";
    }

    public function vacancies()
    {
        $data = Vacancy::all();
        //var_dump($data);

        View::render("vacancies", $data);
    }

}