<?php
/**
 *  @var array $data - массив входящих переменных
 *  @var object $author
 */
use AYakovlev\Core\Request;
?>

<?php include 'header.php'; ?>

    <h2><a href="/vacancy/view/<?= $data->id; ?>"><?= $data->title ?></a><br>
        (id #<?= $data->id; ?>)</h2>
    <h5>Создана: <?= $data->created_at; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
        Обновлена: <?= $data->updated_at; ?></h5>
    <p>
        <b>Зарплата:</b> <?= $data->price; ?><br>
        <b>Организация:</b> <?= $data->organization; ?><br>
        <b>Адрес: </b> <?= $data->address; ?><br>
        <b>Телефон:</b> <?= $data->telephone; ?><br>
        <b>Требуемый опыт:</b> <?= $data->experience; ?><br>
        <b>Технологии:</b> <?= $data->technology; ?><br>
        <b>Требуемые навыки:</b> <?= $data->skills; ?><br>
        <b>Описание вакансии:</b> <?= $data->descriptions; ?><br>
    </p>
    <br>
    <p>
        Здравствуте,
        <?= urldecode(Request::$params[5]) . ' ' . urldecode(Request::$params[6]) . '!';
        ?>
        <br>
        <a href="/vacancy/response/<?= $data->id; ?>">Отправить отклик на рассмотрение</a></p>
    <br>
<?php include 'footer.php'; ?>