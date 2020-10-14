<?php


namespace AYakovlev\Controllers;


use AYakovlev\Controllers\AbstractController;
use AYakovlev\Core\Request;
use AYakovlev\Core\View;
use AYakovlev\Exception\NotFoundJSONException;
use AYakovlev\Models\Vacancy;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ApiController extends AbstractController
{
    private const ID = 3;
    public function index()
    {
        $entity = [
            'тестирование API' => 'work',
            'numberTwo' => [
                'numberTwoOne' => 'dataOneOne',
                'numberTwoTwo' => 'dataOneTwo',
            ],
            'numberThree' => 'dataThree',
        ];

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($entity);
    }


    public function vacancy()
    {
        try {
            $vacancy = Vacancy::findOrFail(Request::$params[self::ID]);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundJSONException("404 - вакансия не существует");
        }

        $this->view->displayJson($vacancy, 200);
    }

    public function add()
    {
        $input = $this->getInputData();
        //var_dump($input);

        $vacancyFromRequest = $input['vacancy'][0];

        $vacancy = Vacancy::create($vacancyFromRequest);
        $vacancy->save();

        header('Location: /api/vacancy/' . $vacancy->id, true, 302);
        exit;
    }
}