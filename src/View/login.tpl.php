<?php
/**
 * @var object $data - ошибка приложения.
 */
?><?php include 'header.php'; ?>
<div style="text-align: center;">
    <h1>Вход</h1>
    <?php if (!empty($data)): ?>
        <div style="background-color: red;padding: 5px;margin: 15px"><?= $data->getMessage(); ?></div>
    <?php endif; ?>
    <form action="/users/login" method="post">
        <label>Email <input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>"></label>
        <br><br>
        <label>Пароль <input type="password" name="password" value="<?= $_POST['password'] ?? '' ?>"></label>
        <br><br>
        <input type="submit" value="Войти">
    </form>
</div>
<?php include 'footer.php'; ?>
