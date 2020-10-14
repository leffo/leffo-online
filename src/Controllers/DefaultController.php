<?php


namespace AYakovlev\Controllers;

class DefaultController extends AbstractController
{
    public function index()
    {
        header('Location: /vacs/vacancies');
    }
}