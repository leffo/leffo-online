<?php
/**
 *  @var object|null $data - объект входящих переменных
 */
?>

<?php include 'header.php'; ?>
    <h1>Редактирование вакансии</h1>

    <form action="/vacancy/edit/<?= $data->id; ?>"  method="post">
        <p><label for="title">Наименование вакансии:</label><br>
        <input type="text" name="title" id="title" value="<?= $_POST['title'] ?? $data->title ?>" size="50"><br>
        <br></p>
        <p><label for="price">Зарплата:</label><br>
        <input type="text" name="price" id="price" value="<?= $_POST['price'] ?? $data->price ?>" size="50" <br>
        <br></p>
        <p><label for="organization">Организация:</label><br>
        <input type="text" name="organization" id="organization" value="<?= $_POST['organization'] ?? $data->organization ?>" size="50" <br>
        <br></p>
        <p><label for="address">Адрес:</label><br>
        <input type="text" name="address" id="address" value="<?= $_POST['address'] ?? $data->address ?>" size="50" <br>
        <br></p>
        <p><label for="telephone">Телефон:</label><br>
        <input type="text" name="telephone" id="telephone" value="<?= $_POST['telephone'] ?? $data->telephone ?>" size="50" <br>
        <br></p>
        <p><label for="experience">Требуемый опыт:</label><br>
        <input type="text" name="experience" id="experience" value="<?= $_POST['experience'] ?? $data->experience ?>" size="50" <br>
        <br></p>
        <p><label for="technology">Технологии:</label><br>
        <input type="text" name="technology" id="technology" value="<?= $_POST['technology'] ?? $data->technology ?>" size="50" <br>
        <br></p>
        <p><label for="skills">Требуемые навыки:</label><br>
        <input type="text" name="skills" id="skills" value="<?= $_POST['skills'] ?? $data->skills ?>" size="50" <br>
        <br></p>
        <p><label for="descriptions">Описание вакансии:</label><br>
        <textarea name="descriptions" id="descriptions" rows="10" cols="80"><?= $_POST['descriptions'] ?? $data->descriptions ?></textarea><br>
        <br><br><br></p>
        <p><label for="category">Категория:</label><br></p>
        <input type="text" name="category" id="category" value="<?= $_POST['category'] ?? $data->category ?>" size="50" <br>
        <br><br><br>

        <input type="submit" value="Обновить вакансию">
    </form>
<?php include 'footer.php'; ?>