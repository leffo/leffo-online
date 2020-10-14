<?php
/**
 * @var object|null $data - ошибка приложения.
 */
?>
<?php include 'header.php'; ?>
<h3>Запрещенное действие!</h3>
<p><?= $data->getMessage(); ?></p>
<?php include 'footer.php'; ?>
