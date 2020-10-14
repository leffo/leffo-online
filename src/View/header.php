<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>All you need is ...!</title>
    <link rel="stylesheet" href="/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital@0;1&display=swap" rel="stylesheet">
</head>
<body>

<table class="layout">
    <tr>
        <td colspan="2" class="header">
            Vacancy!
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: right">
            <?php if(!empty($user)): ?>
                Привет, <?= $user->nickname ?>  | <a href="/users/logOut">Выйти</a>
            <?php else: ?>
                <a href="/users/login">Войти</a> | <a href="/users/signup">Зарегестрироваться</a>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <td>