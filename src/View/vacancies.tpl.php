<?php

/**
 *  @var array $data - массив входящих переменных
 */
?>
<?php include 'header.php'; ?>
<?php foreach ($data as $vacancy): ?>
    <h2><a href="/vacancy/view/<?= $vacancy->id; ?>"><?= $vacancy->title ?></a><br>
        (id #<?= $vacancy->id; ?>)</h2>
    <h5>Создана: <?= $vacancy->created_at; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
    Обновлена: <?= $vacancy->updated_at; ?></h5>

    <p>
        <b>Зарплата:</b> <?= $vacancy->price; ?><br>
        <b>Организация:</b> <?= $vacancy->organization; ?><br>
        <b>Адрес: </b> <?= $vacancy->address; ?><br>
        <b>Телефон:</b> <?= $vacancy->telephone; ?><br>
        <b>Требуемый опыт:</b> <?= $vacancy->experience; ?><br>
        <b>Технологии:</b> <?= $vacancy->technology; ?><br>
        <b>Требуемые навыки:</b> <?= $vacancy->skills; ?><br>
        <b>Описание вакансии:</b> <?= $vacancy->descriptions; ?><br>
    </p>

    <h5><a href="/vacancy/edit/<?= $vacancy->id; ?>">Редактировать</a>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="/vacancy/delete/<?= $vacancy->id; ?>">Удалить</a>
    </h5>

    <hr>
<?php endforeach; ?>
<?php include 'footer.php'; ?>
