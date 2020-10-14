<?php


namespace AYakovlev\Controllers;


use AYakovlev\Core\Request;
use AYakovlev\Core\View;
use AYakovlev\Exception\InvalidArgumentException;
use AYakovlev\Exception\Forbidden;
use AYakovlev\Exception\NotFoundException;
use AYakovlev\Exception\UnauthorizedException;
use AYakovlev\Models\User;

use AYakovlev\Models\Vacancy;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VacancyController extends AbstractController
{
    private ?int $idVacancy;
    protected Vacancy $vacancy;
    protected const ID = 3;

    public function __construct()
    {
        parent::__construct();
        $this->vacancy = new Vacancy();
        if (isset(Request::$params[self::ID])) {
            $this->idVacancy = Request::$params[self::ID];
        }
    }

    /**
     * @return int
     */
    public function getIdVacancy(): int
    {
        return $this->idVacancy;
    }

    /**
     * @param int $idVacancy
     */
    public function setIdVacancy(int $idVacancy): void
    {
        $this->idVacancy = $idVacancy;
    }

    public function view(): void
    {
        try {
            $data = Vacancy::findOrFail($this->idVacancy);
        } catch (ModelNotFoundException $e) {
            View::render('error', $e, 404);
            return;
        }

        View::render("vacancy", $data);
    }

    public function add(): void
    {
        if ($this->user === null) {
            throw new Forbidden();
        }

        if($this->user->role !== 'admin') {
            throw new Forbidden('Для добавления статьи нужно обладать правами администратора');
        }

        if (!empty($_POST)) {
            try {
                if (empty($_POST['title'])) {
                    throw new InvalidArgumentException('Не передано название вакансии');
                }

                if (empty($_POST['price'])) {
                    throw new InvalidArgumentException('Не передана зарплата');
                }

                if (empty($_POST['organization'])) {
                    throw new InvalidArgumentException('Не передана организация');
                }

                if (empty($_POST['organization'])) {
                    throw new InvalidArgumentException('Не передана организация');
                }

                if (empty($_POST['address'])) {
                    throw new InvalidArgumentException('Не передан адрес');
                }

                if (empty($_POST['telephone'])) {
                    throw new InvalidArgumentException('Не передан телефон');
                }

                if (empty($_POST['experience'])) {
                    throw new InvalidArgumentException('Не передана опыт');
                }

                if (empty($_POST['technology'])) {
                    throw new InvalidArgumentException('Не передан стек технологий');
                }

                if (empty($_POST['skills'])) {
                    throw new InvalidArgumentException('Не переданы скиллсы');
                }

                if (empty($_POST['descriptions'])) {
                    throw new InvalidArgumentException('Не передано описание');
                }

                if (empty($_POST['category'])) {
                    throw new InvalidArgumentException('Не передана категория');
                }

            } catch (InvalidArgumentException $e) {
                View::render('addVacancy', $e);
                return;
            }

            $vacancy = Vacancy::create($_POST);

            header('Location: /vacancy/view/' . $vacancy->id, true, 302);
            exit();
        }


        View::render("addVacancy");
        //return;
    }

    public function edit(): void
    {
       $vacancy = Vacancy::findOrFail($this->idVacancy);

        if ($vacancy === null) {
            throw new NotFoundException();
        }

        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        if (!empty($_POST)) {
            try {
                $vacancy->fill($_POST);
                $vacancy->save();
            } catch (InvalidArgumentException $e) {
                View::render('editVacancy',  $e);
                return;
            }

            header('Location: /vacancy/view/' . $vacancy->id, true, 302);
            exit();
        }

        View::render('editVacancy', $vacancy);
    }

    public function delete(): void
    {
        if ($this->user === null) {
            throw new UnauthorizedException();
        }

        try {
            Vacancy::findOrFail($this->idVacancy)->delete();
        } catch (ModelNotFoundException $e) {
            View::render('error', $e, 404);
            return;
        }
        $this->idVacancy = null;
        View::render('delete');
    }
}
