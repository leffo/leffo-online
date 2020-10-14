<?php


namespace AYakovlev\Controllers;


use AYakovlev\Core\View;

class AboutmeController extends AbstractController
{
    public function about()
    {
        View::render("about");
    }
}