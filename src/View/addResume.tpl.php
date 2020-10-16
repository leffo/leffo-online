<?php
/**
 *  @var object|null $data - объект входящих переменных
 */
?>

<?php include 'header.php'; ?>
    <h1>Заполните, пожалуйста свои данные:</h1>

<?php if(!empty($data)): ?>
    <div style="color: red;"><?= "ВНИМАНИЕ! " . $data->getMessage() ?></div><br><br>

<?php endif; ?>
    <form action="/vacancy/response/" method="post">
        <p><label for="vacancy_id">Наименование вакансии:</label><br>
            <input type="text" name=vacancy_id"" id="vacancy_id" value="<?= $_POST['vacancy_id'] ?? ''; ?>" size="50"><br>
            <br></p>
        
        <p><label for="firstname">Имя:</label><br>
            <input type="text" name="firstname" id="firstname" value="<?= $_POST['firstname'] ?? '' ?>" size="50"><br>
            <br></p>
        
        <p><label for="secondname">Отчество:</label><br>
            <input type="text" name="secondname" id="secondname" value="<?= $_POST['secondname'] ?? '' ?>" size="50" <br>
            <br></p>
        
        <p><label for="lastname">Фамилия:</label><br>
            <input type="text" name="lastname" id="lastname" value="<?= $_POST['lastname'] ?? '' ?>" size="50" <br>
            <br></p>
        
        <p><label for="birthdate">Дата рождения (например 24.10.1985):</label><br>
            <input type="text" name="birthdate" id="birthdate" value="<?= $_POST['birthdate'] ?? '' ?>" size="50" <br>
            <br></p>
        
        <p><label for="address_fact">Адрес фактический:</label><br>
            <input type="text" name="address_fact" id="address_fact" value="<?= $_POST['address_fact'] ?? '' ?>" size="50" <br>
            <br></p>
        
        <p><label for="address_registration">Адрес регистрации:</label><br>
            <input type="text" name="address_registration" id="address_registration" value="<?= $_POST['address_registration'] ?? '' ?>" size="50" <br>
            <br></p>

        <p><label for="phone">Телефон:</label><br>
            <input type="text" name="phone" id="phone" value="<?= $_POST['phone'] ?? '' ?>" size="50" <br>
            <br></p>

        <p><label for="email">Email:</label><br>
            <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>" size="50" <br>
            <br></p>

        <p><label for="family_status">Семейное положение:</label><br>
            <input type="text" name="family_status" id="family_status" value="<?= $_POST['family_status'] ?? '' ?>" size="50" <br>
            <br></p>

        <p><label for="experience">Профессиональный опыт:</label><br>
        <textarea name="experience" id="experience" rows="10" cols="80"><?= $_POST['experience'] ?? '' ?></textarea><br>
        <br></p>

        <p><label for="education">Образование:</label><br>
        <textarea name="education" id="education" rows="10" cols="80"><?= $_POST['education'] ?? '' ?></textarea> <br>
        <br></p>

        <p><label for="about">Дополнительное описание:</label><br>
        <textarea name="about" id="about" rows="10" cols="80"><?= $_POST['about'] ?? '' ?></textarea><br>
        </p>
        <br><br><br>

        <input type="submit" value="Создать отклик">
    </form>
<?php include 'footer.php'; ?>